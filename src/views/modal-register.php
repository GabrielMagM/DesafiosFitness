<?php
    require_once 'components/Conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener y limpiar los datos del formulario
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        // Verificar que las contraseñas coinciden
        if ($password !== $confirmPassword) {
            $_SESSION['message'] = "<p style='color: red;'>Las contraseñas no coinciden.</p>";
            return; // Detener la ejecución
        }

        // Hashear la contraseña para mayor seguridad
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Obtener la conexión a la base de datos
            $pdo = Conexion::Conectar();

            // Preparar e insertar el usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

            $_SESSION['message'] = "<p style='color: green;'>Registro exitoso. Ahora puedes iniciar sesión.</p>";
        } catch (PDOException $e) {
            // Verificar si el error es de duplicado de correo electrónico
            if ($e->getCode() == 23505) { // Código 23505 en PostgreSQL para duplicados
                $_SESSION['message'] = "<p style='color: red;'>Este correo ya está registrado. Usa otro correo.</p>";
            } else {
                $_SESSION['message'] = "<p style='color: red;'>Error al registrar el usuario: " . $e->getMessage() . "</p>";
            }
        }
    }
?>

<div id="modalRegister" class="flex fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div id="modalContentRegister" class="bg-white p-8 rounded-lg w-96 shadow-lg relative">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Registrarse</h2>
                <form>
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700">Usuario</label>
                        <input type="text" id="username_register" name="name" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Ingrese Usuario" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Correo</label>
                        <input type="email" id="email_register" name="email" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Ingrese Correo" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Contraseña</label>
                        <input type="password" id="password_register" name="password" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Ingrese Contraseña" required>
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="block text-gray-700">Repetir Contraseña</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Repetia la Contraseña" required>
                    </div>
                    <div class="flex justify-end">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];  // Imprimir el mensaje
                        }
                        ?>
                        <button type="submit" class="px-4 py-2 bg-cyan-800 text-white rounded hover:bg-cyan-700">Registrarse</button>
                    </div>
                </form>
            <!-- Botón de cerrar (X) -->
            <button id="closeModalRegister" class="absolute top-2 right-2 text-2xl text-gray-700 bg-transparent border-none hover:text-cyan-800 mr-4">X</button>
        </div>
    </div>



