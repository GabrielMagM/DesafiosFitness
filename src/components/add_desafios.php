<?php
include 'Conexion.php'; // Asegúrate de iniciar la sesión para acceder a $_SESSION

// Asegúrate de que la sesión esté iniciada

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php"); // Redirige si no está autenticado
    exit();
}

$conn = Conexion::Conectar(); // Conexión a la base de datos usando PDO

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la entrada de $_POST
    $user_id = $_SESSION['user_id'];  // Aquí tomamos el ID del usuario de la sesión
    $tittle = isset($_POST['tittle']) ? $_POST['tittle'] : null;
    $total_stages = isset($_POST['total_stages']) ? $_POST['total_stages'] : null;
    $imagen_url = isset($_POST['imagen_url']) ? $_POST['imagen_url'] : null;

    // Verificar que todos los campos requeridos están presentes
    if ($tittle && $total_stages && $imagen_url) {
        // Preparar e insertar el desafío en la base de datos
        $sql = "INSERT INTO challenges (user_id, tittle, total_stages, imagen_url) 
                VALUES (:user_id, :tittle, :total_stages, :imagen_url)";
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindValue(':user_id', $user_id);  // Usamos el user_id de la sesión
        $stmt->bindValue(':tittle', $tittle);
        $stmt->bindValue(':total_stages', $total_stages);
        $stmt->bindValue(':imagen_url', $imagen_url);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el id del desafío insertado
            $challenge_id = $conn->lastInsertId();

            // Insertar las etapas en la tabla stages
            for ($i = 1; $i <= $total_stages; $i++) {
                // Obtener los datos de cada etapa del formulario
                $stage_name = isset($_POST['stage_name'][$i]) ? $_POST['stage_name'][$i] : null;
                $stage_goal = isset($_POST['stage_goal'][$i]) ? $_POST['stage_goal'][$i] : null;

                // Verificar que ambos campos de la etapa estén presentes
                if ($stage_name && $stage_goal) {
                    // Insertar las etapas en la base de datos
                    $sql_stages = "INSERT INTO stages (user_id, challenge_id, stage_num, stage_name, stage_goal) 
                                  VALUES (:user_id, :challenge_id, :stage_num, :stage_name, :stage_goal)";
                    $stmt_stages = $conn->prepare($sql_stages);
                    $stmt_stages->bindValue(':user_id', $user_id);  // El mismo user_id
                    $stmt_stages->bindValue(':challenge_id', $challenge_id); // El ID del desafío insertado
                    $stmt_stages->bindValue(':stage_num', $i); // Establecer el número de la etapa
                    $stmt_stages->bindValue(':stage_name', $stage_name);
                    $stmt_stages->bindValue(':stage_goal', $stage_goal);
                    $stmt_stages->execute();
                } else {
                    echo "Error: Todos los campos de la etapa son obligatorios.";
                    exit;
                }
            }

            echo "Desafío creado exitosamente.";
            header("Location: desafios.php");
            exit;
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
}

?>
