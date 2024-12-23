<?php
session_start();
include_once '../Core/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $functions = new Functions();
    $functions->registerUser($username, $email, $password);

    // Mensaje de registro exitoso y redirección
    $_SESSION['registro_exitoso'] = "Registro exitoso. Redirigiendo a la página de inicio de sesión...";
    header("Location: Register.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--<link rel="preconnect" href="../assets/css/register.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Prata&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

</head>
<body class="flex flex-col h-3/4 bg-slate-800 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <header class="flex items-center justify-center bg-emerald-600 text-white shadow-md py-2"> 
            <b>Aqui debes registrarte.</b>
            &nbsp&nbsp&nbsp
            <a>Al Registrarte encontrarás los Mejores Desafios</a>
    </header>
    <!-- Contenido Principal -->
    <main class="flex justify-center items-center h-3/4 bg-slate-800 pb-36 pt-14">
        <section class="flex w-3/4 h-2/4 shadow-lg rounded-lg overflow-hidden bg-slate-800 mb-20">
            <!-- Sección Izquierda: Logo y textos -->
            <div class="w-1/2 bg-slate-800 flex flex-col justify-center p-8 text-white">
                <a href="index.php">
                    <!-- Logo centrado -->
                    <img src="../assets/images/Siiiu.png" alt="Logo" class="mb-4 w-30 h-26">
                </a> 
                <h1 class="text-3xl font-bold mb-4">Become a Member</h1>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <p>Track your progress</p>
                    </li>
                    <li class="flex items-center">
                        <p>Set your goals</p>
                    </li>
                    <li class="flex items-center">
                        <p>Get a personalized path</p>
                    </li>
                    <li class="flex items-center">
                        <p>Practice coding</p>
                    </li>
                    <li class="flex items-center">
                        <p>Build projects</p>
                    </li>
                </ul>
            </div>
            <!-- Sección Derecha: Cuadro de Login -->
            <div class="w-1/2 bg-slate-800 flex flex-col justify-center items-center ">
                <div class="flex flex-col justify-around p-8 bg-white rounded-lg w-3/4 mt-10">
                    <h2 class="text-2xl font-semibold mb-4">Sign Up</h2>
                    <p class="text-sm mb-4 self-end">Don't have an account? 
                    <a href="login.php" class="text-blue-500">Log in</a></p>
                    <p class="text-center text-gray-500 my-2">OR</p>
                <?php if (isset($_SESSION['registro_exitoso'])): ?>
                    <p style="color: white;"><?php echo $_SESSION['registro_exitoso']; ?></p>
                <?php unset($_SESSION['registro_exitoso']); ?>
                    <!-- Redirección automática usando JavaScript -->
                <script>
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 3000);
                </script>
                <?php else: ?>   
                    <form action="Register.php" method="POST">
                        <div class="mb-4">
                            <input type="text" placeholder="Usuario" name="username" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Usuario" required>
                        </div>
                        <div class="mb-4">
                            <input type="text" placeholder="Email" name="email" class="w-full p-1 border rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <input type="password" placeholder="Contraseña" name="password" class="w-full p-1 border rounded-md" required>
                        </div>
                       <!--  <div class="mb-4">
                              <input type="password" placeholder="Confirmar Contraseña" name="confirm_password" class="w-full p-1 border rounded-md" required>
                        </div>-->
                        <button type="submit" class="w-full bg-green-500 text-white p-3 rounded-md hover:bg-green-600">Registrarte</button>
                    </form>
                    <?php endif; ?>
                </div>    
            </div>
        </section>
    </main>
    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>

</body>
</html>