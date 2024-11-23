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
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
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
    <?php include 'components/add_desafios.php'; ?>
    
    <main class="flex mx-auto p-4 mt-4 items-center justify-center">
        <section class="flex flex-col bg-slate-800 p-6 rounded-md shadow-md w-6/12">
            <form id="add_desafios" action="../components/add_desafios.php" method="POST" class="bg-white p-4 rounded shadow">
                <div class="mb-4">
                    <label for="tittle" class="block text-gray-700">Descripción</label>
                    <input type="text" id="description" name="tittle" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Titulo del desafío">
                </div>
                <select id="etapas" name="total_stages" class="mt-1 p-2 border border-gray-300 rounded w-full mb-4" required onchange="mostrarCamposEtapas()">
                    <option value="">Selecciona el número de etapas</option>
                    <option value="1">1 Etapa</option>
                    <option value="2">2 Etapas</option>
                    <option value="3">3 Etapas</option>
                    <option value="4">4 Etapas</option>
                </select>

                <!-- Contenedor de Campos de Etapas -->
                <div id="etapasContainer"></div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">Crear Desafío</button>
            </form>
            <script>
                function mostrarCamposEtapas() {
                    const etapasContainer = document.getElementById('etapasContainer');
                    const etapasCount = document.getElementById('etapas').value;
                    
                    // Limpiar el contenedor de etapas antes de agregar nuevos campos
                    etapasContainer.innerHTML = '';
                    
                    // Crear campos dinámicamente para las etapas seleccionadas
                    for (let i = 1; i <= etapasCount; i++) {
                        const etapaDiv = document.createElement('div');
                        etapaDiv.classList.add('mb-4');
                        etapaDiv.innerHTML = `
                            <label for="etapa${i}" class="block text-gray-700">Etapa ${i}</label>
                            <input type="text" id="etapa${i}" name="stage_name[${i}]" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Nombre de la etapa">
                            <textarea name="stage_goal[${i}]" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Descripción de la etapa (máximo 80 palabras)" maxlength="500"></textarea>
                        `;
                        etapasContainer.appendChild(etapaDiv);
                    }
                }
            </script>         
        </section>
    </main>    
    <?php include 'views/footer.php'; ?>
</body>
</html>
