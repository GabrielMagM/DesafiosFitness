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
                <a href="#" class="ml-6 text-white hover:underline">Inicio</a>
                <a href="#" class="ml-6 text-white hover:underline">Desafíos</a>
                <a href="#" class="ml-6 text-white hover:underline">Contacto</a>
            </nav>
            <div class="flex items-center gap-4">
                <button class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Iniciar Sesion</button>
                <button class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Registrarse</button>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 mt-4">
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
            <!-- Carrusel -->
            <!-- Contenedor del carrusel con proporción 16:9 -->
            
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
        const items = document.querySelectorAll('.carousel-item');
        let currentIndex = 0;
        const totalItems = items.length;

        function showItem(index) {
            items.forEach((item, i) => {
                item.classList.toggle('hidden', i !== index);
            });
        }

        function nextItem() {
            currentIndex = (currentIndex + 1) % totalItems;
            showItem(currentIndex);
        }

        // Cambiar la imagen automáticamente cada 5 segundos
        setInterval(nextItem, 5000);
    </script>

    <!-- JavaScript del Carrusel -->
    <script src="./JS/lottiefiles.js"></script>
</body>
</html>
