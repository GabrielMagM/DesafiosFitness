<?php
require_once 'components/Conexion.php';  // Incluir la clase de conexión
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y limpiar los datos del formulario
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    // Obtener la conexión a la base de datos
    $pdo = Conexion::Conectar();  // Usamos el método estático para obtener la conexión

    try {
        // Buscar al usuario por el nombre en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name LIMIT 1");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user && password_verify($password, $user['password'])) {
            // Establecer variables de sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
        
            // Redirigir a la página de inicio de la sesión
            header("Location: inicio.php");
            exit();
        } else {
            var_dump($user);  // Esto te muestra lo que devuelve la consulta
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>
<div id="modalLogin" class="flex fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div id="modalContent" class="bg-white p-8 rounded-lg w-96 shadow-lg relative">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Iniciar sesión</h2>
            <form action="inicio.php" method="POST">
                <div class="mb-4">
                    <label for="username_login" class="block text-gray-700">Nombre de usuario</label>
                    <input type="text" id="username_login" name="name" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu nombre de usuario" required>
                </div>
                <div class="mb-4">
                    <label for="password_login" class="block text-gray-700">Contraseña</label>
                    <input type="password" id="password_login" name="password" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu contraseña" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-cyan-800 text-white rounded hover:bg-cyan-700">Entrar</button>
                </div>
            </form>
            <!-- Botón de cerrar (X) -->
            <button id="closeModalLogin" class="absolute top-2 right-2 text-2xl text-gray-700 bg-transparent border-none hover:text-cyan-800 mr-4">X</button>
        </div>
    </div>


