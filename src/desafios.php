<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <!-- Enlace al archivo CSS de Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.6/lottie.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <header class="bg-cyan-800 text-white shadow-md ">
        <div class="container flex justify-between items-center px-12">
            <img src="../assets/Logo.png" alt="Logo" class="h-14">
            <nav>
                <a href="index.php" class="ml-6 text-white hover:underline">Inicio</a>
                <a href="#" class="ml-6 text-white hover:underline">Desafíos</a>
                <a href="#" class="ml-6 text-white hover:underline">Contacto</a>
            </nav>
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <img src="../assets/personsvg.svg" class="w-6 h-6 cursor-pointer " alt="Perfil">
                    <div class="hidden group-hover:block absolute right-0 pt-4 bg-slate-100 text-gray-500 rounded shadow-lg">
                        <div class="flex flex-col gap-2 w-36 py-3 px-5">
                            <p class="cursor-pointer hover:text-blue-700">Mi Perfil</p>
                            <p class="cursor-pointer hover:text-green-500">Órdenes</p>
                            <p class="cursor-pointer hover:text-red-500">Salir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Desafíos Recientes</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="text-blue-600 font-semibold">Desafío de Cardio</h4>
                    <p class="text-gray-700">Corre 5 kilómetros diarios durante una semana.</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-start">
                    <h4 class="text-blue-600 font-semibold">Desafío de Fuerza</h4>
                    <p class="text-gray-700">Haz abdominales cada día durante un mes.</p>
                    <div id="Animation1" style="width: 300px; height: 300px;"></div>
                    <!-- aqui va el gif de LettieFiles -->
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="text-blue-600 font-semibold">Desafío de Flexibilidad</h4>
                    <p class="text-gray-700">Practica yoga durante 30 minutos cada mañana.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer class="bg-gray-800 text-gray-200 p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Desafíos Fitness. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- JavaScript del Carrusel -->
    <script src="./JS/lottiefiles.js"></script>
</body>
</html>
