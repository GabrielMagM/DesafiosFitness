<?php 
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Limpiar y destruir la sesión
    session_unset();
    session_destroy();
    // Redirigir al index.php después del logout
    header("Location: login.php");
    exit();
}

?>