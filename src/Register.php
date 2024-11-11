<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="colors/Tailwind.css" rel="stylesheet">
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
    <header class="flex items-center justify-center bg-slate-800 text-white shadow-md py-2"> 
            <b>Aqui debes registrarte.</b>
            &nbsp&nbsp&nbsp
            <a>Al Registrarte encontrarás los Mejores Desafios</a>
    </header>
    <!-- Contenido Principal -->
    <main class="mt-20 flex justify-center items-center h-full">
        <section class="flex w-3/4 h-1/2 shadow-lg rounded-lg overflow-hidden">
            <!-- Sección Izquierda: Logo y textos -->
            <div class="w-1/2 bg-slate-800 flex flex-col justify-center items-center p-6">
                <div class="text-center bg-blue-200 p-6 rounded-lg shadow-md mb-20"> <!-- Contenedor separado para personalizar -->
                    <img src="logo.png" alt="Logo" class="mb-4 w-24 h-24"> <!-- Logo -->
                    <h1 class="text-2xl font-bold mb-2">Bienvenido a nuestra página</h1>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non dolor ac urna.</p>
                </div>
            </div>
            <!-- Sección Derecha: Cuadro de Login -->
            <div class="w-1/2 bg-slate-800 flex flex-col justify-center items-center p-6">
                <div class="bg-gray-100 p-6 rounded-lg shadow-md w-3/4"> <!-- Contenedor separado para el formulario -->
                    <h2 class="text-xl font-semibold mb-4">Iniciar Sesión</h2>
                    <form action="#" method="POST">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700">Usuario</label>
                            <input type="text" id="username" name="username" class="w-full p-2 border rounded">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Contraseña</label>
                            <input type="password" id="password" name="password" class="w-full p-2 border rounded">
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Ingresar</button>
                    </form>
                </div>
            </div>
            
        </section>
    </main>


    

    <!-- Modal de Login -->
    <?php include 'views/modal-login.php'; ?>
    <!-- Modal de Registro -->
    <?php include 'views/modal-register.php'; ?>

    <!-- Pie de página -->
    <?php include 'views/footer.php'; ?>

    <script src="JS/carrusel.js"></script>
    <script src="JS/modal.js"></script>
</body>
</html>
