<?php
session_start();
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';
$user = new Functions();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
$id_user = $_SESSION['id_user'];
$id_challenge = $_GET['id_challenge'];

// Obtener los datos del desafío y los retos
try {
    $soapCliente = new Challenges();
    $challenge = $soapCliente->getChallenge($id_challenge);
    $stages = $soapCliente->getStagesByChallenge($id_challenge, $id_user);
} catch (SoapFault $e) {
    echo "Error al obtener los datos: " . $e->getMessage();
    exit;
}

// Manejo de completar reto usando funciones PHP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_stage'])) {
    $id_stage = $_POST['id_stage'];
    $result = $user->completeStage($id_user, $id_stage);

    if ($result) {
        header("Location: completeChallenge.php?id_challenge=$id_challenge");
        exit;
    } else {
        $mensaje_error = "No se pudo completar el reto.";
    }
}


// Verificar si todos los retos están completados
$allStagesCompleted = array_reduce($stages, function ($carry, $stage) {
    return $carry && $stage['completed']; // Asume que tienes un campo `completed` en los datos
}, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_challenge'])) {
    // Llamar a la función para completar el desafío
    $result = $user->completeChallenge($id_user, $id_challenge);

    if ($result) {
        // Mensaje de éxito
        $mensaje = "¡Desafío completado con éxito!";
        // Redirigir después de 3 segundos con JavaScript
        echo "<script>
            setTimeout(function() {
                window.location.href = 'desafios.php';
            }, 3000);
        </script>";
    } else {
        $mensaje_error = "No se pudo completar el desafío. Por favor, intenta de nuevo.";
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
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        * {   
          

        }

        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-slate-800 text-white font-sans leading-normal tracking-normal outline-1">
    <!-- Encabezado -->
    <nav>
        <?php if (isset($_SESSION['email'])): ?>
            <?php include '../includes/header_log.php'; ?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php'; ?>
        <?php endif; ?>
    </nav>

    <!-- Contenido Principal -->
    <main class="mx-6 my-4">
        <section id="txt_welcome" class="bg-gray-900 p-3 rounded-lg shadow-md">
            <div class="main-container flex justify-center items-center">
                <div class="flex flex-col seguimiento-container bg-slate-800 p-2 justify-center rounded-md items-center gap-1">
                    <div class="mensajes">
                        <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>";
                            elseif (isset($mensaje_error)) echo "<p style='color: red;'>$mensaje_error</p>"; ?>
                    </div>
                    
                    <h1 class="font-bold self-center justify-self-center"><?php echo htmlspecialchars($challenge['name_challenge']); ?></h1>
                    <p class="self-center justify-self-center"><strong>Cantidad de Etapas :</strong> <?php echo htmlspecialchars($challenge['total_stages']); ?></p>

                    <h2 class="">Retos del Desafío</h2>
                    <ul class="retos-lista ">
                        <?php foreach ($stages as $stage): ?>
                            <li class="text-sm reto-item shadow-md bg-slate-900 py-1 px-1 rounded-md mb-1">
                                <span>Reto <?php echo htmlspecialchars($stage['num_stage']); ?> : <?php echo htmlspecialchars($stage['name_stage']); ?></span>
                                <span><?php echo htmlspecialchars($stage['goal_stage']); ?> </span>
                                <?php if (!$stage['completed']): ?>
                                    <form action="completeChallenge.php?id_challenge=<?php echo $id_challenge; ?>" method="POST" class="completar-form flex justify-center py-1">
                                        <input type="hidden" name="id_stage" value="<?php echo $stage['id_stage']; ?>">
                                        <button type="submit" class="btn-completar bg-green-600 py-1 px-1 rounded-md text-white font-bold">Completar</button>
                                    </form>
                                <?php elseif ($stage['completed']): ?>
                                    <div class="flex justify-center py-1">
                                        <span class="completado-texto bg-gray-600 py-1 px-1 rounded-md text-white font-bold">Completado</span>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class="h-56 w-52 rounded-lg">
                    <div class="botones-accion flex gap-x-2 py-2">
                        <!-- Botón para regresar a la página anterior -->
                        <div class="boton">
                            <button class=" bg-lime-700 py-1 px-3 rounded-md" onclick="history.go(-1)">← Regresar</button>
                        </div>
                        <form method="POST" action="completeChallenge.php?id_challenge=<?php echo $id_challenge; ?>" style="display: inline;">
                            <input type="hidden" name="id_challenge" value="<?php echo $id_challenge; ?>">
                            <button class="bg-green-600 py-1 px-3 rounded-md text-white font-bold" type="submit" name="complete_challenge"
                                <?php echo $allStagesCompleted ? '' : 'disabled'; ?>>
                                Completar Desafío
                            </button>
                        </form>
                        <!-- Botón para salirse del desafío -->
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>
