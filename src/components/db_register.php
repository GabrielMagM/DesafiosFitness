<?php
session_start(); // Inicia la sesión para poder usar $_SESSION

include 'Conexion.php'; // Incluye la clase de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $confirm_contrasena = $_POST['confirm_contrasena'];

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirm_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Conectar a la base de datos
    $conexion = Conexion::Conectar();

    if ($conexion) {
        // Verificar si el email ya está registrado
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Si el email ya existe
        if ($stmt->fetchColumn() > 0) {
            echo "<script>
                    alert('Este correo electrónico ya está registrado. Por favor, usa otro.');
                    window.location.href = 'register.php'; // Redirige a la página de registro
                </script>";
            exit;
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $stmt = $conexion->prepare("INSERT INTO usuarios (usuario, correo, contrasena, fecha_registro) VALUES (:usuario, :correo, :contrasena, NOW())");
        $stmt->bindParam(':usuario', $usaurio);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $hashed_password);

        if ($stmt->execute()) {
            // Guardar el mensaje en la sesión
            $_SESSION['mensaje_registro'] = "Registro exitoso. Ahora debe logearse.";
            echo "<script>
                    alert('Registro exitoso. Ahora debe logearse.');
                    window.location.href = 'login.php'; // Redirige al login
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
