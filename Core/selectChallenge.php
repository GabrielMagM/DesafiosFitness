<?php
include_once '../Core/functions.php';

session_start();
$userId = $_SESSION['id_user']; // Asegúrate de tener el ID del usuario en la sesión
$idChallenge = $_POST['id_challenge'];

$funciones = new Functions();

// Registrar el desafío en la tabla user_challenges
$result = $funciones->addUserChallenge($userId, $idChallenge);

if ($result) {
    header("Location: ../desafios.php?success=1"); // Redirigir con éxito
    exit();
} else {
    header("Location: ../desafios.php?error=1"); // Redirigir con error
    exit();
}
?>