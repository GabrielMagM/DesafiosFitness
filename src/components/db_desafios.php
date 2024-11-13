<?php
include 'Conexion.php'; // Asegúrate de iniciar la sesión para acceder a $_SESSION

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    die("Error: Debes iniciar sesión para crear un desafío.");
}

$conn = Conexion::Conectar(); // Conexión a la base de datos usando PDO

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la entrada de $_POST
    $user_id = $_SESSION['user_id'];
    $titulo = isset($_POST['titulo_desafio']) ? $_POST['titulo_desafio'] : null;
    $duracion_dias = isset($_POST['duracion_dias']) ? $_POST['duracion_dias'] : null;
    $etapas = isset($_POST['etapas']) ? $_POST['etapas'] : null;
    $imagen_url = isset($_POST['imagen_url']) ? $_POST['imagen_url'] : null;

    // Verificar que todos los campos requeridos están presentes
    if ($titulo && $duracion_dias && $etapas && $imagen_url) {
        // Preparar e insertar el desafío en la base de datos
        $sql = "INSERT INTO desafios (user_id, titulo, duracion_dias, etapas, imagen_url) 
                VALUES (:user_id, :titulo, :duracion_dias, :etapas, :imagen_url)";
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':duracion_dias', $duracion_dias);
        $stmt->bindValue(':etapas', $etapas);
        $stmt->bindValue(':imagen_url', $imagen_url);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el id del desafío insertado
            $desafio_id = $conn->lastInsertId();

            // Insertar las etapas en la tabla desafio_etapas
            for ($i = 1; $i <= $etapas; $i++) {
                // Obtener los datos de cada etapa del formulario
                $titulo_etapa = isset($_POST['titulo_etapa_' . $i]) ? $_POST['titulo_etapa_' . $i] : null;
                $descripcion_etapa = isset($_POST['descripcion_etapa_' . $i]) ? $_POST['descripcion_etapa_' . $i] : null;

                // Verificar que ambos campos de la etapa estén presentes
                if ($titulo_etapa && $descripcion_etapa) {
                    // Insertar las etapas en la base de datos
                    $sql_etapa = "INSERT INTO desafio_etapas (desafio_id, titulo_etapa, descripcion_etapa) 
                                  VALUES (:desafio_id, :titulo_etapa, :descripcion_etapa)";
                    $stmt_etapa = $conn->prepare($sql_etapa);
                    $stmt_etapa->bindValue(':desafio_id', $desafio_id);
                    $stmt_etapa->bindValue(':titulo_etapa', $titulo_etapa);
                    $stmt_etapa->bindValue(':descripcion_etapa', $descripcion_etapa);
                    $stmt_etapa->execute();
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