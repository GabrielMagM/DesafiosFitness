<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../assets/css/Tailwind.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
   <style>
        body {
           /* background-image: url('../assets/wallpaper/pexels-wallpaper.webp'); /* Ruta de tu imagen */
            background-size: cover; /* Cubre toda el área */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* La imagen no se mueve al hacer scroll */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            min-height: 100vh; /* Asegura que el fondo cubra toda la pantalla */
            color: white;
        }
        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-slate-800 font-sans leading-normal tracking-normal text-white">
    <?php include '../includes/header_prueba.php';?>
    <!-- Contenido Principal -->
    <main class="mt-4 m-0">
        <section class="flex flex-col p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 ">Bienvenido a los Desafíos Fitness</h2>        
            <p class="mt-4">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
            <br>
            <!-- Carrusel -->
            <div class="relative w-full h-[500px] overflow-hidden rounded-lg shadow-md">
                    <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100">
                        <img src="../assets/images/wallpaper.webp" alt="Desafío 1" class="w-full h-full object-cover" />
                    </div>
                    <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0">
                        <img src="../assets/images/wallpaper1.webp" alt="Desafío 2" class="w-full h-full object-cover" />
                    </div>
            </div>
        </section>
    </main> 
    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>
    <script src="assets/JS/carrusel.js"></script>
</body>
</html>
