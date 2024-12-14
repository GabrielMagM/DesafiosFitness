<?php

session_start();
include_once '../Core/functions.php';

$user = new Functions();
// Lógica para cerrar sesión
include '../Core/logout.php'
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        *{
           
        }
       
        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>

<body class="bg-slate-800 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
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
            <?php include '../includes/header_log.php';?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php';?>
        <?php endif; ?>
    </nav>

    <!-- Contenido Principal -->
    <main class="mx-6 mb-2 mt-2 text-white">
        <section id="txt_welcome" class="bg-gray-900 p-6 rounded-lg shadow-md">
            <h2 class=" text-xl font-semibold mb-4 ">Bienvenido a los Desafíos Fitness</h2>        
            <p class="mt-4 ">Algunos desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="flex mt-4 gap-5 rounded-md">
            
            <?php include '../includes/sidebar.php';?>

            <div id="desafios_container" class="flex flex-col bg-gray-900 rounded-md w-full">
                <div id="crear_desafios" class="flex justify-between items-center my-2 px-12 border-b border-gray-300 pb-2" >
                    <h3 class="text-lg font-semibold ">Desafíos Recientes</h3>
                    <?php if (isset($_SESSION['email'])): ?>
            <!-- Si el usuario está registrado, permite crear un desafío -->
                        <button id="button" onclick="window.location.href='crear_desafio.php'" class="bg-indigo-500 font-bold rounded-lg px-4 py-2">Crear un Desafío</button>
                    <?php else: ?>
                        <!-- Si el usuario no está registrado, muestra el mensaje de alerta y redirige a login.php -->
                        <button id="button" onclick="alertaIniciarSesion()" class="bg-indigo-500 font-bold rounded-lg px-4 py-1">Crear un Desafío</button>
                        <script>
                            function alertaIniciarSesion() {
                                alert('Para Crear un Desafío debe Iniciar Sesión.');
                                window.location.href = 'login.php';
                            }
                        </script>
                    <?php endif; ?>
                </div>
                <!--Desafios Creados or la Pagina-->
                <div id="pag_desafios" class="grid grid-cols-1 md:grid-cols-4 items-center gap-y-6 justify-center place-items-center">
                    <?php include '../includes/desafio_start.php' ?>
                </div>


                <!-- Desafios creados por el usuario -->
                <div id="crear_desafios" class="flex justify-between items-center my-2 px-12 border-b border-gray-300 pb-2" >
                    <h3 class="text-lg font-semibold self-center">Tus Desafios</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-y-6 justify-center place-items-center">
                <?php include '../includes/desafio_user.php' ?>
                </div>
                <!-- Desafios creados por Otros Usuarios -->
                <div id="crear_desafios" class="flex justify-between items-center my-2 px-12 border-b border-gray-300 pb-2">
                    <h3 class="text-lg font-semibold  self-center">Desafíos Creados</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    
                </div>
            </div>    
        </section>
    </main>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/JS/carrusel.js"></script>
    <script src="../assets/JS/lottiefiles.js"></script>
</body>
</html>
