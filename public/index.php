<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <!-- Enlace al archivo CSS de Tailwind -->
    <link href="/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
            <div class="flex items-center gap-4">
                <!-- Contenedor del perfil con menú desplegable -->
                <div class="group relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                        height="24px" 
                        viewBox="0 -960 960 960" 
                        width="24px" 
                        fill="#e8eaed">
                        <path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/>
                    </svg>
                    <div class="hidden group-hover:block absolute right-0 pt-4 bg-slate-100 text-gray-500 rounded shadow-lg dropdown-menu">
                        <div class="flex flex-col gap-2 w-36 py-3 px-5">
                            <p class="cursor-pointer hover:text-blue-700">My Profile</p>
                            <p class="cursor-pointer hover:text-green-500">Orders</p>
                            <p class="cursor-pointer hover:text-red-500">Logout</p>
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
                <div class="flex flex-col bg-white p-4 rounded-lg shadow-md">
                    <h4 class="text-blue-600 font-semibold ml-5">Desafío de Fuerza</h4>
                    <p class="text-gray-700 ml-5">Haz abdominales cada día durante un mes.</p>
                    <!-- Aquí insertamos el GIF -->
                    <img src="Abdominales.gif" alt="Animación de Fuerza" class="mt-3 ml-5 rounded-lg" />
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
