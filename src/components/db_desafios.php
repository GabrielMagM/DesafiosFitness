<?php
include 'Conexion.php';
require_once 'Conexion.php'; // Asegúrate de iniciar la sesión para acceder a $_SESSION

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    die("Error: Debes iniciar sesión para crear un desafío.");
}

$conn = Conexion::Conectar(); // Conexión a la base de datos usando PDO

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar la entrada de $_POST
    $user_id = $_SESSION['user_id'];
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    $duracion_dias = isset($_POST['duracion_dias']) ? $_POST['duracion_dias'] : null;
    $etapas = isset($_POST['etapas']) ? $_POST['etapas'] : null;
    $imagen_url = isset($_POST['imagen_url']) ? $_POST['imagen_url'] : null;

    // Verificar que todos los campos requeridos están presentes
    if ($titulo && $descripcion && $duracion_dias && $etapas && $imagen_url) {
        // Preparar e insertar el desafío en la base de datos con PDO
        $sql = "INSERT INTO desafios (user_id, titulo, descripcion, duracion_dias, etapas, imagen_url) VALUES (:user_id, :titulo, :descripcion, :duracion_dias, :etapas, :imagen_url)";
        $stmt = $conn->prepare($sql);
        
        // Asociar parámetros usando bindValue para PDO
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':duracion_dias', $duracion_dias);
        $stmt->bindValue(':etapas', $etapas);
        $stmt->bindValue(':imagen_url', $imagen_url);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            echo "Desafío creado exitosamente.";
            // Redireccionar al usuario a la página de desafíos
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
