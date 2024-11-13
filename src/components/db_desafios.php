<?php
session_start();
require_once 'conexion.php'; // Asegúrate de incluir tu archivo de conexión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    die("Error: Debes iniciar sesión para crear un desafío.");
}

$user_id = $_SESSION['user_id']; // ID del usuario desde la sesión
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$duracion_dias = $_POST['duracion_dias'];
$etapas = $_POST['etapas'];
$imagen_url = $_POST['imagen_url'];

// Preparar e insertar el desafío en la base de datos
$sql = "INSERT INTO desafios (user_id, titulo, descripcion, duracion_dias, etapas, imagen_url) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssis", $user_id, $titulo, $descripcion, $duracion_dias, $etapas, $imagen_url);

if ($stmt->execute()) {
    echo "Desafío creado exitosamente.";
    // Redireccionar al usuario a la página de desafíos
    header("Location: desafios.php");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
