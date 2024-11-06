<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="css/Tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
    <header class="bg-cyan-800 text-white shadow-md">
        <div class="flex justify-around items-center px-12">
            <img src="../assets/Logo.png" alt="Logo" class="h-14 mr-40">
            <nav class="flex justify-between gap-6">
                <a href="#" class="text-white hover:underline">Inicio</a>
                <a href="#" class="text-white hover:underline">Desafíos</a>
                <a href="#" class="text-white hover:underline">Contacto</a>
            </nav>
            <div class="flex items-center gap-4 ml-40">
                <button class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Iniciar Sesion</button>
                <button class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Registrarse</button>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="flex flex-col p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
            
            <!-- Carrusel -->
            <div class="relative w-full h-[500px] overflow-hidden rounded-lg shadow-md">
                <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100">
                    <img src="wallpaper.jpg" alt="Desafío 1" class="w-full h-full object-cover" />
                </div>
                <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0">
                    <img src="wallpaper1.jpg" alt="Desafío 2" class="w-full h-full object-cover" />
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

    <!-- Script del Carrusel -->
    <script>
        // Seleccionar todos los items del carrusel
        const items = document.querySelectorAll('.carousel-item');
        let currentIndex = 0;
        const totalItems = items.length;

        // Función para mostrar el item actual y ocultar los demás
        function showItem(index) {
            items.forEach((item, i) => {
                // Mostrar el item correspondiente y ocultar los demás
                item.classList.remove('opacity-100');
                item.classList.add('opacity-0');
                if (i === index) {
                    item.classList.remove('opacity-0');
                    item.classList.add('opacity-100');
                }
            });
        }

        // Función para avanzar al siguiente item
        function nextItem() {
            currentIndex = (currentIndex + 1) % totalItems;
            showItem(currentIndex);
        }

        // Cambiar la imagen automáticamente cada 5 segundos
        setInterval(nextItem, 5000);
    </script>
</body>
</html>
