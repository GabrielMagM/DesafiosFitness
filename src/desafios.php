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

    <?php
    // Conexión a la base de datos
    require_once 'components/Conexion.php'; // Asegúrate de tener la conexión a la base de datos
    $conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión
    // Consulta para obtener todos los desafíos
    $sql = "SELECT titulo, descripcion, imagen_url FROM desafios";
    $result = $conn->query($sql);
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
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                    <h4 class="text-blue-600 font-semibold">Desafío de Cardio</h4>
                    <p class="text-gray-700">Corre 5 kilómetros diarios durante una semana.</p>
                    <img src="../assets/desafio_img/runing.webp" alt="" class="h-64 w-52 self-center" >
                    
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                    <h4 class="text-blue-600 font-semibold">Desafío de Fuerza</h4>
                    <p class="text-gray-700">Haz abdominales cada día durante un mes.</p>
                    <img src="../assets/desafio_img/peso_muerto.webp" alt="" class="h-64 w-52 self-center" >
                    <!-- aqui va el gif de LettieFiles -->
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                    <h4 class="text-blue-600 font-semibold">Desafío de Flexibilidad</h4>
                    <p class="text-gray-700">Practica yoga durante 30 minutos cada mañana.</p>
                    <img src="../assets/desafio_img/estiramiento.webp" alt="" class="h-64 w-52 self-center">
                </div>
                <?php
                // Verifica si se encontraron resultados
                if ($result->rowCount() > 0) {
                    // Recorre cada desafío y genera el HTML
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                            <h4 class="text-blue-600 font-semibold"><?php echo htmlspecialchars($row['titulo']); ?></h4>
                            <p class="text-gray-700"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                            <img src="../assets/desafio_img/<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="" class="h-64 w-52 self-center">
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No hay desafíos disponibles en este momento.</p>";
                }
                ?>

            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include 'views/footer.php'; ?>

    <script src="JS/carrusel.js"></script>
    <script src="JS/lottiefiles.js"></script>
</body>
</html>
