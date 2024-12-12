<?php
session_start();
// Lógica para cerrar sesión
include '../Core/logout.php';

include_once '../Core/functions.php';
$user = new Functions();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$functions = new Functions();
$name_challenge = $total_stage = $imagen_url = ""; // Variables inicializadas en blanco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mantener los datos
    $name_challenge = $_POST['name_challenge'];
    $imagen_url = $_POST['imagen_url'];
    $total_stages = $_POST['total_stages'];
    $createdBy = $_SESSION['id_user'];    

    // Verificar que al menos un reto esté presente
    if (empty($_POST['stages']) || empty($_POST['stages'][1]['name_stage']) || empty($_POST['stages'][1]['goal_stage'])) {
        $mensaje_error = "ERROR: Debe agregar al menos un reto a su desafío.";
    } else {   
        // Crear el desafío si todas las validaciones pasan
        if ($functions->createChallenge($name_challenge, $imagen_url, $total_stages, $createdBy)) {
            // Obtener el ID del desafío creado y guardar los retos
            $id_challenge = $functions->getIdChallenge($name_challenge);
            foreach ($_POST['stages'] as $index => $stage) {
                $num_stage = $index + 0; // Número de la etapa
                $name_stage = $stage['name_stage'];
                $goal_stage = $stage['goal_stage'];
                
                // Aquí llamamos a la función para crear la etapa
                $functions->createStage($id_challenge, $num_stage, $name_stage, $goal_stage);  // Usamos $index + 1 para numerar las etapas
            }
            $mensaje_exito = "Desafío y retos creados exitosamente y disponibles para todos los usuarios.";
            // Limpiar los valores después de la creación
            $name_challenge = $total_stage = "";
            header("Location: desafios.php");
            exit;
        } else {
            $mensaje_error = "Error: Ya existe un desafío con ese nombre.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafíos Fitness</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-slate-800">
    <nav>
        <style>
            .bebas-neue-regular {
                font-family: "Bebas Neue", serif;
                font-weight: 400;
                font-style: normal;
            }
        </style>
        <?php if (isset($_SESSION['email'])): ?>
            <?php
            $userName = $user->searchUser($_SESSION['email']);
            ?>
            <?php include '../includes/header_log.php';?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php';?>
        <?php endif; ?>
    </nav>
    
    <main class="flex mx-auto py-4 pb-60 items-center justify-center">
        <section class="flex flex-col bg-slate-800 p-6 rounded-md shadow-md w-6/12">
            <form id="formulario-desafio" action="crear_desafio.php" method="POST" class="bg-indigo-600 font-semibold p-4 rounded shadow">
                <div class="mb-4">
                    <label for="tittle" class="block text-gray-100">Título del Desafío</label>
                    <input type="text" id="tittle" name="name_challenge" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Ingresa el título del desafío">
                </div>

                <div class="flex flex-col mb-4 self-center" id="image-selector">
                    <label for="imagen_url" class="self-center mb-4 text-gray-100">Selecciona una imagen para el desafío</label>
                    <div class="flex items-center self-center">
                        <button type="button" onclick="cambiarImagen(-1)" class="p-2 bg-gray-300 rounded hover:bg-gray-400">◀</button>
                        <img id="previewImage" src="../assets/images/runing.webp" alt="Imagen del desafío" class="mx-2 w-20 h-auto border rounded">
                        <button type="button" onclick="cambiarImagen(1)" class="p-2 bg-gray-300 rounded hover:bg-gray-400">▶</button>
                    </div>
                    <input type="hidden" id="imagen_url" name="imagen_url" value="runing.webp">
                </div>

                <div class="mb-4">
                    <label for="etapas" class="block text-gray-100">Número de Etapas</label>
                    <select id="etapas" name="total_stages" class="mt-1 p-2 border border-gray-300 rounded w-full" required onchange="mostrarCamposEtapas()">
                        <option value="">Selecciona el número de etapas</option>
                        <option value="1">1 Etapa</option>
                        <option value="2">2 Etapas</option>
                        <option value="3">3 Etapas</option>
                        <option value="4">4 Etapas</option>
                    </select>
                </div>

                <div id="etapasContainer" class="rounded"></div>

                <button type="submit" class="w-full bg-green-600 hover:bg-blue-600 text-white font-bold py-2 rounded mt-4">
                    Crear Desafío
                </button>
            </form>

            <script>
                const images = ["runing.webp", "estiramiento.webp", "peso_muerto.webp"];
                let currentIndex = 0;

                function cambiarImagen(direction) {
                    currentIndex = (currentIndex + direction + images.length) % images.length;
                    document.getElementById("previewImage").src = "../assets/images/" + images[currentIndex];
                    document.getElementById("imagen_url").value = images[currentIndex];
                }

                function mostrarCamposEtapas() {
                const etapasContainer = document.getElementById('etapasContainer');
                const etapasCount = document.getElementById('etapas').value;
                etapasContainer.innerHTML = '';

                for (let i = 1; i <= etapasCount; i++) {  // Cambié el índice a 1 para que comience desde la etapa 1
                    const etapaDiv = document.createElement('div');
                    etapaDiv.classList.add('mb-4');
                    etapaDiv.innerHTML = `
                        <h3 class="font-bold text-lg text-gray-100">Etapa ${i}</h3>
                        <label for="stages${i}" class="block text-gray-100">Título de la Etapa ${i}</label>
                        <input type="text" id="stages${i}" name="stages[${i}][name_stage]" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Título de la etapa">
                        <label for="descripcionEtapa${i}" class="block text-gray-100 mt-2">Descripción de la Etapa ${i}</label>
                        <textarea id="descripcionEtapa${i}" name="stages[${i}][goal_stage]" required class="mt-1 p-2 border border-gray-300 rounded w-full" placeholder="Descripción de la etapa" maxlength="500"></textarea>
                    `;
                    etapasContainer.appendChild(etapaDiv);
                }
            }
            </script>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
