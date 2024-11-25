<?php
session_start();
include 'Conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo "Debes iniciar sesión para unirte a un desafío.";
    exit();
}

// Obtener los parámetros
if (!isset($_GET['challenge_id'])) {
    echo "ID del desafío no especificado.";
    exit();
}

$challengeId = (int)$_GET['challenge_id'];
$userId = (int)$_SESSION['user_id'];

try {
    // Conexión a la base de datos
    $conn = Conexion::Conectar();

    // Verificar si ya está inscrito en el desafío
    $sqlCheck = "SELECT 1 FROM user_stages WHERE user_id = :user_id AND challenge_id = :challenge_id";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtCheck->bindParam(':challenge_id', $challengeId, PDO::PARAM_INT);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        echo "Ya estás participando en este desafío.";
        exit();
    }

    // Insertar registro en user_stages para la primera etapa
    $sqlInsert = "INSERT INTO user_stages (user_id, challenge_id, stage_id, completed) 
                  VALUES (:user_id, :challenge_id, 1, 0)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtInsert->bindParam(':challenge_id', $challengeId, PDO::PARAM_INT);
    $stmtInsert->execute();

    echo "Te has unido al desafío con éxito.";
    // Redirigir al usuario si es necesario
    header("Location: dashboard.php"); // Cambia `dashboard.php` según tu estructura
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>