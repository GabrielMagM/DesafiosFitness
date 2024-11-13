<?php
session_start(); // Inicia la sesión para poder usar $_SESSION

include 'Conexion.php'; // Incluye la clase de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Conectar a la base de datos
    $conexion = Conexion::Conectar();

    if ($conexion) {
        // Insertar el usuario en la base de datos
        $stmt = $conexion->prepare("INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // Guardar el mensaje en la sesión
            $_SESSION['mensaje_registro'] = "Registro exitoso. Ahora debe logearse.";
            echo "<script>
                    alert('Registro exitoso. Ahora debe logearse.');
                    window.location.href = 'login.php';
                </script>";
            exit;
        } else {
            echo "Error en el registro.";
        }
    } else {
        echo "No se pudo conectar a la base de datos.";
    }
}
?>