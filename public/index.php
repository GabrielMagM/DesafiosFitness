<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <!-- Enlace al archivo CSS de Tailwind -->
    <link href="/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Desafíos Fitness</h1>
            <nav>
                <a href="#" class="ml-4 text-white hover:underline">Inicio</a>
                <a href="#" class="ml-4 text-white hover:underline">Desafíos</a>
                <a href="#" class="ml-4 text-white hover:underline">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>
            <p class="text-gray-700">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <!-- Sección de Desafíos -->
        <section class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Desafíos Recientes</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="text-blue-600 font-semibold">Desafío de Cardio</h4>
                    <p class="text-gray-700">Corre 5 kilómetros diarios durante una semana.</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="text-blue-600 font-semibold">Desafío de Fuerza</h4>
                    <p class="text-gray-700">Haz 100 flexiones cada día durante un mes.</p>
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
</body>
</html>
