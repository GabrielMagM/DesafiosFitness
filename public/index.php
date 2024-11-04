<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <!-- Enlace al archivo CSS de Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <img src="../assets/Logo.png" alt="Logo" class="h-16 ml-6">
            <nav>
                <a href="#" class="ml-4 text-white hover:underline">Inicio</a>
                <a href="#" class="ml-4 text-white hover:underline">Desafíos</a>
                <a href="#" class="ml-4 text-white hover:underline">Contacto</a>
            </nav>
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <img src="../assets/personsvg.svg" class="w-6 h-6 cursor-pointer" alt="Perfil">
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
            <!-- Carrusel de Imágenes -->
            <div class="relative w-full max-w-lg mx-auto overflow-hidden">
                <div id="fitness-carousel" class="flex transition-transform duration-700 ease-in-out">
                    <img src="../assets/cr1.jpg" alt="Imagen 1" class="w-full h-auto object-cover">
                    <img src="../assets/palco.jpg" alt="Imagen 2" class="w-full h-auto object-cover">
                </div>
                <!-- Indicadores del Carrusel -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
                    <button onclick="setSlide(0)" class="w-3 h-3 bg-gray-500 rounded-full"></button>
                    <button onclick="setSlide(1)" class="w-3 h-3 bg-gray-500 rounded-full"></button>
                </div>
            </div>
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
                    <img src="../assets/Abdominales.gif" alt="Animación de Fuerza" class="mt-3 w-full rounded-lg" />
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
    <script src="carousel.js"></script>
</body>
</html>
