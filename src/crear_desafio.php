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
            background-image: url('../assets/pexels-wallpaper.webp'); /* Ruta de tu imagen */
            background-size: cover; /* Cubre toda el área */
            background-position: center center; /* Centra la imagen */
            background-attachment: fixed; /* La imagen no se mueve al hacer scroll */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            min-height: 100vh; /* Asegura que el fondo cubra toda la pantalla */
        }
    </style>
</head>

<body>

    <?php include 'views/header_prueba.php';?>
    <main class="flex mx-auto p-4 mt-4 items-center justify-center">
        <section class="flex flex-col bg-slate-800 p-6 rounded-md shadow-md w-6/12">
            <form action="crear_desafio.php" method="POST" class="flex flex-col gap-y-2">
                <h2 class="text-white font-bold">Crear Desafío</h2>
                
                <label for="titulo" class="font-semibold text-white">Título:</label>
                <input type="text" id="titulo" name="titulo" class="rounded-md shadow-md px-1 py-1" placeholder="Ingrese Titulo"required>

                <label for="descripcion" class="font-semibold text-white">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="rounded-md shadow-md px-1" placeholder="Ingrese Descripción"></textarea>

                <label for="duracion_dias" class="font-semibold text-white">Duración (días):</label>
                <select id="duracion_dias" name="duracion_dias" class="rounded-md shadow-md" required>
                    <option value="1">1 día</option>
                    <option value="2">2 días</option>
                    <option value="3">3 días</option>
                </select>

                <label for="etapas" class="font-semibold text-white">Número de Etapas:</label>
                <select id="etapas" name="etapas" class="rounded-md shadow-md" required onchange="mostrarCamposEtapas()">
                    <option value="1">1 etapa</option>
                    <option value="2">2 etapas</option>
                    <option value="3">3 etapas</option>
                    <option value="4">4 etapas</option>
                    <option value="5">5 etapas</option>
                    <option value="6">6 etapas</option>
                </select>

                <div id="camposEtapas"></div>

                <label class="font-semibold text-white">Imagen del desafío:</label>
                <div class="self-center" id="image-selector">
                    <button type="button" onclick="cambiarImagen(-1)">◀</button>
                    <img id="previewImage" src="../assets/desafio_img/runing.webp" alt="Imagen del desafío" style="width: 100px;">
                    <button type="button" onclick="cambiarImagen(1)">▶</button>
                    <input type="hidden" id="imagen_url" name="imagen_url" value="runing.webp">
                </div>

                <button type="submit" class="bg-green-600 font-bold rounded-lg px-4 py-2">Crear Desafío</button>
            </form>
            
        </section>
    </main>    
    <script src="JS/c_etapas.js"></script>
    <?php include 'views/footer.php'; ?>
</body>
</html>
