<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="./colors/Tailwind.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Prata&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('../assets/pexels-wallpaper.jpg'); /* Ruta de tu imagen */
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
    <header class="bg-slate-800 text-white shadow-md mt-0.5 mx-6 rounded-md py-1">
        <div class="flex flex-wrap justify-between items-center px-12">
            <img src="../assets/Logo.png" alt="Logo" class="h-14">
            <nav class="flex justify-between gap-6">
                <a href="#" class="text-white hover:underline">Inicio</a>
                <a href="desafios.php" class="text-white hover:underline">Desafíos</a>
                <a href="#" class="text-white hover:underline">Informe</a>
            </nav>
            <div class="flex items-center gap-4">
                <!-- Se agregó el id="openModal" aquí -->
                <button id="openModalLogin" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Iniciar Sesion</button>
                <button id="openModalRegister" class="px-2 py-1 border border-white-100 text-white-300 rounded hover:bg-cyan-600">Registrarse</button>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="mt-4 m-0">
        <section class="flex flex-col p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Bienvenido a los Desafíos Fitness</h2>        
            <p class="text-gray-700 mt-4">Aquí encontrarás una variedad de desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
            <br>
            <!-- Carrusel -->
            <div class="relative w-full h-[500px] overflow-hidden rounded-lg shadow-md">
                <!-- Botón anterior -->
                    <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100">
                        <img src="../assets/wallpaper.jpg" alt="Desafío 1" class="w-full h-full object-cover" />
                    </div>
                    <div class="carousel-item absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0">
                        <img src="../assets/wallpaper1.jpg" alt="Desafío 2" class="w-full h-full object-cover" />
                    </div>
                <!-- Botón siguiente -->
    
            </div>
        </section>
    </main>

    <!-- Modal de Login -->
    <div id="modalLogin" class="flex fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div id="modalContent" class="bg-white p-8 rounded-lg w-96 shadow-lg relative">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Iniciar sesión</h2>
            <form>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Nombre de usuario</label>
                    <input type="text" id="username_login" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu nombre de usuario">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Contraseña</label>
                    <input type="password" id="password_login" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Escribe tu contraseña">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-cyan-800 text-white rounded hover:bg-cyan-700">Entrar</button>
                </div>
            </form>
            
            <!-- Botón de cerrar (X) -->
            <button id="closeModalLogin" class="absolute top-2 right-2 text-2xl text-gray-700 bg-transparent border-none hover:text-cyan-800 mr-4">X</button>
        </div>
    </div>
    <!-- Modal de Registro -->
    <div id="modalRegister" class="flex fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div id="modalContentRegister" class="bg-white p-8 rounded-lg w-96 shadow-lg relative">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Registrarse</h2>
            <form>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Nombre de usuario</label>
                    <input type="text" id="username_register" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Nombre de usuario">
                </div>
                <div class="mb-4">
                    <label for="correo" class="block text-gray-700">Nombre de usuario</label>
                    <input type="text" id="correo_register" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Correo">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Contraseña</label>
                    <input type="password" id="password_register" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Contraseña">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Repetir Contraseña</label>
                    <input type="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-2" placeholder="Repetir Contraseña">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-cyan-800 text-white rounded hover:bg-cyan-700">Entrar</button>
                </div>
            </form>
            <!-- Botón de cerrar (X) -->
            <button id="closeModalRegister" class="absolute top-2 right-2 text-2xl text-gray-700 bg-transparent border-none hover:text-cyan-800 mr-4">X</button>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-gray-800 text-gray-200 p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Desafíos Fitness. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="./JS/carrusel.js"></script>
    <script src="./JS/modal.js"></script>
</body>
</html>
