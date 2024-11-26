<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.6/lottie.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        *{
            
        }
        body {
            /* background-image: url('../assets/wallpaper/pexels-wallpaper.webp'); Ruta de tu imagen */
            background-size: cover; /* Cubre toda el área */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* La imagen no se mueve al hacer scroll */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            min-height: 100vh; /*Asegura que el fondo cubra toda la pantalla */
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
    <?php include '../includes/header_prueba.php';?>

    <?php
    // Conexión a la base de datos
    require_once 'config/Conexion.php'; // Asegúrate de tener la conexión a la base de datos
    $conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión
    // Consulta para obtener todos los desafíos
    
    ?>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4 text-white">
        <section class="bg-gray-900 p-6 rounded-lg shadow-md ">
            <h2 class=" text-xl font-semibold mb-4 ">Bienvenido a los Desafíos Fitness</h2>        
            <p class="mt-4 ">Algunos desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="mt-4">
            <div class="flex justify-between items-center my-4 px-4 border-b border-gray-300 pb-2" >
                <h3 class="text-lg font-semibold ">Desafíos Recientes</h3>
                <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Si el usuario está registrado, permite crear un desafío -->
                    <button onclick="window.location.href='crear_desafio.php'" class="bg-indigo-500 font-bold rounded-lg px-4 py-2">Crear un Desafío</button>
                <?php else: ?>
                    <!-- Si el usuario no está registrado, muestra el mensaje de alerta y redirige a login.php -->
                    <button onclick="alertaIniciarSesion()" class="bg-indigo-500 font-bold rounded-lg px-4 py-2">Crear un Desafío</button>
                    <script>
                        function alertaIniciarSesion() {
                            alert('Para Crear un Desafío debe Iniciar Sesión.');
                            window.location.href = 'login.php';
                        }
                    </script>
                <?php endif; ?>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-y-6 justify-center place-items-center">
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1">Desafío de Cardio</h4>
                        <p class=" font-bold break-all self-center">Etapa 1/5: Correr</p>
                        <p class=" font-bold break-all">Corre por 20min y sin parar</p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/desafio_img/runing.webp" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                </div>
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->
                <!--Aqui se crea el primer desafio-->

                <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1">Desafío de Cardio</h4>
                        <p class=" font-bold break-all self-center">Etapa 1/5: Correr</p>
                        <p class=" font-bold break-all">Corre por 20min y sin parar</p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/desafio_img/runing.webp" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                    <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                </div>

                <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1">Desafío de Fuerza</h4>
                        <p class=" font-bold break-all self-center">Etapa 1/5: Press Banca</p>
                        <p class=" font-bold break-all">20 Repeticiones, hasta llegar al fallo</p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/desafio_img/peso_muerto.webp" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                    <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                </div>

                <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1">Desafío de Flexibilidad</h4>
                        <p class=" font-bold break-all self-center">Etapa 1/5: yoga</p>
                        <p class=" font-bold break-all">durante 30 minutos estiramiento completo de piernas</p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/images/estiramiento.webp" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                    <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                </div>

            </div>
            <!-- Desafios creados por el usuario -->
            <div class="flex justify-between items-center my-4 px-4 border-b border-gray-300" >
                <h3 class="text-lg font-semibold   self-center">Tus Desafios</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-y-6 justify-center place-items-center">
                <?php include '../actions/db_desafios_user.php'?>
                
            </div>
            <!-- Desafios creados por Otros Usuarios -->
            <div class="flex justify-between items-center my-4 px-4 border-b border-gray-300">
                <h3 class="text-lg font-semibold  self-center">Desafíos Creados</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/JS/carrusel.js"></script>
    <script src="../assets/JS/lottiefiles.js"></script>
</body>
</html>
