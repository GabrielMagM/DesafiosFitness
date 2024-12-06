<?php
// Lógica para cerrar sesión
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Limpiar y destruir la sesión
    session_unset();
    session_destroy();
    // Redirigir al index.php después del logout
    header("Location: index.php");
    exit();
}
?>
<nav>
    <style>
        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <?php if (isset($_SESSION['email'])): ?>
        <?php
        // Obtener el nombre del usuario basado en su correo electrónico
        $userName = $user->searchUser($_SESSION['email']);
        ?>
        <header class="bg-gray-900 text-white shadow-md mt-3 mx-6 rounded-md py-1">
            <div class="flex flex-wrap justify-between items-center px-12">
                <img src="../assets/images/Siiiu.png" alt="Logo" class="h-14">
                <nav class="flex justify-between gap-6">
                    <a href="index.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Inicio</a>
                    <a href="desafios.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Desafíos</a>
                    <a href="#" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Informe</a>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="relative group">
                        <img src="../assets/svg/personsvg.svg" class="w-6 h-6 cursor-pointer" alt="Perfil">
                        <div class="hidden group-hover:block absolute right-0 pt-4 bg-slate-100 text-gray-500 rounded shadow-lg">
                            <div class="flex flex-col gap-2 w-36 py-3 px-5">
                                <!-- Mostrar el nombre del usuario escapado para mayor seguridad -->
                                <p class="cursor-pointer hover:text-blue-700">Mi Perfil: <?php echo htmlspecialchars($userName); ?></p>
                                <!-- Enlace para cerrar sesión -->
                                <a href="index.php?logout=1" class="cursor-pointer hover:text-red-500">Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php else: ?>
        <header class="bg-gray-900 text-white shadow-md mt-3 mx-6 rounded-md py-1">
            <div class="flex flex-wrap justify-between items-center px-12">
                <img src="../assets/images/Siiiu.png" alt="Logo" class="h-14">
                <nav class="flex justify-between gap-6 mx-3">
                    <a href="index.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Inicio</a>
                    <a href="desafios.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Desafíos</a>
                    <a href="#" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Informe</a>
                </nav>
                <div class="flex items-center gap-4">
                    <button onclick="window.location.href='../views/Login.php'" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">
                        Iniciar Sesión
                    </button>
                    <button onclick="window.location.href='../views/Register.php'" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">
                        Registrarse
                    </button>
                </div>
            </div>
        </header>
    <?php endif; ?>
</nav>
