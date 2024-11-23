<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include 'Conexion.php';  // Asegúrate de que la ruta sea correcta

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("No estás logueado. Por favor, inicia sesión.");
}

// Obtener la conexión a la base de datos
$conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $tittle = $_POST['tittle'];
    $imagen_url = $_POST['imagen_url'];
    $total_stages = $_POST['total_stages'];
    $user_id = $_SESSION['user_id'];  // Obtener el user_id de la sesión

    // Validar que los campos no estén vacíos
    if (empty($tittle) || empty($imagen_url) || empty($total_stages)) {
        echo "Por favor, completa todos los campos.";
    } else {
        // Preparar la consulta SQL para insertar el desafío
        $sql = "INSERT INTO challenges (user_id, tittle, total_stages, imagen_url) 
                VALUES (:user_id, :tittle, :total_stages, :imagen_url)";
        
        // Preparar la sentencia SQL
        $stmt = $conn->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':tittle', $tittle);
        $stmt->bindParam(':total_stages', $total_stages, PDO::PARAM_INT);
        $stmt->bindParam(':imagen_url', $imagen_url);

        try {
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Desafío creado exitosamente.";
            } else {
                echo "Error al crear el desafío.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
