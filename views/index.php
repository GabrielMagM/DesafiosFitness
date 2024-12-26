<?php
session_start();
include_once '../Core/functions.php';
$user = new Functions();
// Lógica para cerrar sesión
include '../Core/logout.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
   <style>
        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body id="body" class="bg-slate-800 font-sans leading-normal tracking-normal text-white">
    <!-- Header parte Superior de la Página -->
    <nav id="nav">
        <?php if (isset($_SESSION['email'])): ?>
            <?php
            // Obtener el nombre del usuario basado en su correo electrónico
            $userName = $user->searchUser($_SESSION['email']);
            ?>
            <?php include '../includes/header_log.php';?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php';?>
        <?php endif; ?>
    </nav>

    <!-- Contenido Principal -->
    <main id="main" class="mt-4 m-0">
        <section id="section" class="flex flex-col p-6 rounded-lg shadow-md text-md">
            <h2 id="h2_titulo" class="font-semibold px-2">Bienvenido a los Desafíos Fitness</h2>        
            <p id="txt_welcome" class="mt-4 px-2">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
            <br>
            <!-- Carrusel -->
            <div id="carousel_container" class="relative w-full h-[500px] overflow-hidden rounded-lg shadow-md">
                    <div id="carousel-item" class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100">
                        <img id="carousel-img" src="../assets/images/wallpaper.webp" alt="Desafío 1" class="w-full h-full object-cover" />
                    </div>
                    <div id="carousel-item" class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0">
                        <img id="carousel-img" src="../assets/images/wallpaper1.webp" alt="Desafío 2" class="w-full h-full object-cover" />
                    </div>
            </div>
        </section>
    </main> 
    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>
    <script src="../assets/JS/carrusel.js"></script>
</body>
</html>
