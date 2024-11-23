<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.6/lottie.min.js"></script>
    <link href="colors/Tailwind.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Prata&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('../assets/wallpaper/pexels-wallpaper.webp'); /* Ruta de tu imagen */
            background-size: cover; /* Cubre toda el área */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* La imagen no se mueve al hacer scroll */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            min-height: 100vh; /* Asegura que el fondo cubra toda la pantalla */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <?php include 'views/header_prueba.php';?>

    <?php
    // Conexión a la base de datos
    require_once 'components/Conexion.php'; // Asegúrate de tener la conexión a la base de datos
    $conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión
    // Consulta para obtener todos los desafíos
    
    ?>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Algunos desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="mt-4">
            <div class="flex justify-between items-center mb-4 px-4" >
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Desafíos Recientes</h3>
                <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Si el usuario está registrado, permite crear un desafío -->
                    <button onclick="window.location.href='crear_desafio.php'" class="bg-green-600 font-bold rounded-lg px-4 py-2">Crear un Desafío</button>
                <?php else: ?>
                    <!-- Si el usuario no está registrado, muestra el mensaje de alerta y redirige a login.php -->
                    <button onclick="alertaIniciarSesion()" class="bg-green-600 font-bold rounded-lg px-4 py-2">Crear un Desafío</button>
                    <script>
                        function alertaIniciarSesion() {
                            alert('Para Crear un Desafío debe Iniciar Sesión.');
                            window.location.href = 'login.php';
                        }
                    </script>
                <?php endif; ?>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <div class="bg-white rounded-lg shadow-md flex flex-col w-4/5 p-2 items-center">
                    <div class="flex flex-col w-10/12">
                        <h4 class="text-blue-600 font-semibold">Desafío de Cardio</h4>
                        <p class="text-gray-700 break-words">Corre 5 kilómetros diarios durante una semana.</p>
                    </div>
                    <div class="flex gap-1">
                        <div class="flex border-cyan-600 border-2">
                            <img src="../assets/desafio_img/runing.webp" alt="" class="h-56 w-42 object-cover">
                        </div>
                        <div class="flex flex-col border-cyan-600 border-2">
                            <div class="flex-wrap px-2 gap-1 ">
                                <p class="text-gray-700 font-bold">Etapa 1 : </p>
                                <p class="self-start text-blue-500 ">Correr 4km</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 mt-1 ">
                        <button class="bg-green-500 p-1 rounded-md">Unirse al Desafio</button>
                        <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md flex flex-col w-4/5 p-2 items-center">
                    <div class="flex flex-col w-10/12">
                        <h4 class="text-blue-600 font-semibold">Desafío de Fuerza</h4>
                        <p class="text-gray-700 flex">Haz abdominales cada día durante 3dias.</p>
                    </div>
                    <div class="flex gap-1">
                        <div class="flex border-cyan-600 border-2">
                            <img src="../assets/desafio_img/peso_muerto.webp" alt="" class="h-56 w-42 object-cover">
                        </div>
                        <div class="flex flex-col border-cyan-600 border-2">
                            <div class="flex-wrap px-2 gap-1 ">
                                <p class="text-gray-700 font-bold">Etapa 1 : </p>
                                <p class="self-start text-blue-500 ">Correr 4km</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5 mt-1 ">
                        <button class="bg-green-500 p-1 rounded-md">Unirse al Desafio</button>
                        <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md flex flex-col w-4/5 p-2 items-center">
                    <div class="flex flex-col w-10/12">
                        <h4 class="text-blue-600 font-semibold flex">Desafío de Flexibilidad</h4>
                        <p class="text-gray-700 flex">Practica yoga durante 30 minutos cada mañana.</p>
                    </div>
                    <div class="flex gap-1">
                        <div class="flex border-cyan-600 border-2">
                            <img src="../assets/desafio_img/estiramiento.webp" alt="" class="h-56 w-42 object-cover">
                        </div>
                        <div class="flex flex-col border-cyan-600 border-2">
                            <div class="flex-wrap px-2 gap-1 ">
                                <p class="text-gray-700 font-bold">Etapa 1 : </p>
                                <p class="self-start text-blue-500 ">Correr 4km</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="flex gap-5 mt-1 ">
                        <button class="bg-green-500 p-1 rounded-md">Unirse al Desafio</button>
                        <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                    </div>
                </div>


            </div>
            <!-- Desafios creados por el usuario -->
            <div class="flex justify-between items-center my-4 px-4" >
                <h3 class="text-lg font-semibold text-gray-800  self-center">Tus Desafios</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
            </div>
            <!-- Desafios creados por Otros Usuarios -->
            <div class="flex justify-between items-center my-4 px-4" >
                <h3 class="text-lg font-semibold text-gray-800  self-center">Desafíos Creados</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include 'views/footer.php'; ?>

    <script src="JS/carrusel.js"></script>
    <script src="JS/lottiefiles.js"></script>
</body>
</html>
