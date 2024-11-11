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
            background-image: url('../assets/pexels-wallpaper.webp'); /* Ruta de tu imagen */
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

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Algunos desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Desafíos Recientes</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                    <h4 class="text-blue-600 font-semibold">Desafío de Cardio</h4>
                    <p class="text-gray-700">Corre 5 kilómetros diarios durante una semana.</p>
                    <img src="../assets/runing.webp" alt="" class="h-64 w-52 self-center" >
                    
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                    <h4 class="text-blue-600 font-semibold">Desafío de Fuerza</h4>
                    <p class="text-gray-700">Haz abdominales cada día durante un mes.</p>
                    <img src="../assets/peso_muerto.webp" alt="" class="h-64 w-52 self-center" >
                    <!-- aqui va el gif de LettieFiles -->
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                    <h4 class="text-blue-600 font-semibold">Desafío de Flexibilidad</h4>
                    <p class="text-gray-700">Practica yoga durante 30 minutos cada mañana.</p>
                    <img src="../assets/estiramiento.webp" alt="" class="h-64 w-52 self-center">
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include 'views/footer.php'; ?>

    <script src="JS/carrusel.js"></script>
    <script src="JS/lottiefiles.js"></script>
</body>
</html>
