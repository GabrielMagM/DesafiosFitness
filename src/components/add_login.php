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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor ingrese su correo electrónico y contraseña.";
    } else {
        // Consultar si el correo existe en la base de datos
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificar si el usuario existe
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión y redirigir al usuario
                $_SESSION['user_id'] = $user['id'];          // Almacenar el ID del usuario
                $_SESSION['user_name'] = $user['name'];      // Almacenar el nombre del usuario
                $_SESSION['user_email'] = $user['email'];   // Almacenar el correo del usuario (si es necesario)

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