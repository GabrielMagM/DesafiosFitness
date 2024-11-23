<?php
include 'Conexion.php'; // Asegúrate de iniciar la sesión para acceder a $_SESSION

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    die("Error: Debes iniciar sesión para crear un desafío.");
}

$conn = Conexion::Conectar(); // Conexión a la base de datos usando PDO

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la entrada de $_POST
    $id_usuario = $_SESSION['id_usuario'];
    //Validamos a el usuario y despues obtenems sus desafios y etapas
    $titulo_desafio = isset($_POST['titulo_desafio']) ? $_POST['titulo_desafio'] : null;
    $imagen_url = isset($_POST['imagen_url']) ? $_POST['imagen_url'] : null;
    $cantidad_etapas = isset($_POST['cantidad_etapas']) ? $_POST['cantidad_etapas'] : null;
    // Verificar que todos los campos requeridos están presentes
    if ($titulo_desafio && $imagen_url) {
        // Preparar e insertar el desafío en la base de datos
        $sql = "INSERT INTO desafios (id_usuario, titulo_desafio, imagen_url, cantidad_etapas) 
                VALUES (:id_desafio, :titulo_desafio, :imagen_url :cantidad_etapas)";
        $stmt = $conn->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->bindValue(':titulo_desafio', $titulo_desafio);
        $stmt->bindValue(':imagen_url', $imagen_url);
        $stmt->bindValue(':cantidad_etapas', $cantidad_etapas);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el id del desafío insertado
            $id_desafio = $conn->lastInsertId();

            // Insertar las etapas en la tabla desafio_etapas
            for ($i = 1; $i <= $etapas; $i++) {
                // Obtener los datos de cada etapa del formulario
                $accion_etapa = isset($_POST['accion_etapa' . $i]) ? $_POST['accion_etapa' . $i] : null;
                $descripcion_etapa = isset($_POST['descripcion_etapa' . $i]) ? $_POST['descripcion_etapa' . $i] : null;

                // Verificar que ambos campos de la etapa estén presentes
                if ($accion_etapa && $descripcion_etapa) {
                    // Insertar las etapas en la base de datos
                    $sql_etapa = "INSERT INTO etapas (id_desafio, accion_etapa, descripcion_etapa) 
                                  VALUES (:id_desafio, :accion_etapa, :descripcion_etapa)";
                    $stmt_etapa = $conn->prepare($sql_etapa);
                    $stmt_etapa->bindValue(':id_desafio', $id_desafio);
                    $stmt_etapa->bindValue(':accion_etapa', $accion_etapa);
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