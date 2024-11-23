<?php
session_start();

// Lógica para cerrar sesión directamente en esta página
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Destruir todas las variables de sesión
    session_unset();
    // Destruir la sesión
    session_destroy();
    // Redirigir al index.php después de cerrar sesión
    header("Location: index.php");
    exit();
}
?>
<nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        <style>
            .bebas-neue-regular {
                font-family: "Bebas Neue", serif;
                font-weight: 400;
                font-style: normal;
            }
        </style>
        <header class="bg-gray-900 text-white shadow-md mt-3 mx-6 rounded-md py-1">
            <div class="flex flex-wrap justify-between items-center px-12">
                <img src="../assets/Siiiu.png" alt="Logo" class="h-14">
                <nav class="flex justify-between gap-6">
                    <a href="index.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Inicio</a>
                    <a href="desafios.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Desafíos</a>
                    <a href="#" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Informe</a>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="relative group">
                        <img src="../assets/svg/personsvg.svg" class="w-6 h-6 cursor-pointer " alt="Perfil">
                        <div class="hidden group-hover:block absolute right-0 pt-4 bg-slate-100 text-gray-500 rounded shadow-lg">
                        <div class="flex flex-col gap-2 w-36 py-3 px-5">
                                <!-- Mostrar nombre del usuario -->
                                <p class="cursor-pointer hover:text-blue-700">Mi Perfil: <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
                                <!-- Enlace para cerrar sesión -->
                                <a href="index.php?logout=1" class="cursor-pointer hover:text-red-500">
                                    Cerrar Sesion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php else: ?>
        <header class="bg-gray-900 text-white shadow-md mt-3 mx-6 rounded-md py-1">
            <div class="flex flex-wrap justify-between items-center px-12">
                <img src="../assets/Siiiu.png" alt="Logo" class="h-14">
                <nav class="flex justify-between gap-6 mx-3">
                    <a href="index.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Inicio</a>
                    <a href="desafios.php" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Desafíos</a>
                    <a href="#" class="text-white hover:underline bebas-neue-regular text-2xl m-3">Informe</a>
                </nav>
                <div class="flex items-center gap-4">
                    <!-- Se agregó el id="openModal" aquí -->
                    <button onclick="window.location.href='Login.php'" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">
                        Iniciar Sesion
                    </button>
                    <button onclick="window.location.href='Register.php'" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">
                        Registrarse
                    </button>
                </div>
            </div>
        </header>
    <?php endif; ?>
</nav>