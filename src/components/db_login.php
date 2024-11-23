<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include 'Conexion.php';  // Asegúrate de que la ruta sea correcta

// Obtener la conexión a la base de datos utilizando la clase Conexion
$conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $email = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Validar que los campos no estén vacíos
    if (empty($correo) || empty($contrasena)) {
        echo "Por favor ingrese su correo electrónico y contraseña.";
    } else {
        // Consultar si el correo existe en la base de datos
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Verificar si el usuario existe
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar la contraseña
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // Iniciar sesión y redirigir al usuario
                $_SESSION['id_usuario'] = $usuario['id'];          // Almacenar el ID del usuario
                $_SESSION['usuario'] = $usuario['usuario'];      // Almacenar el nombre del usuario
                $_SESSION['correo'] = $usuario['correo'];   // Almacenar el correo del usuario (si es necesario)

                // Redirigir al usuario a la página principal (index.php)
                header("Location: index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }
}
?>