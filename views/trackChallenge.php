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

try {
    $soapCliente = new Challenges();
    $challenge = $soapCliente->getChallenge($id_challenge);
    $stages = $soapCliente->getStagesByChallenge($id_challenge, $id_user);
} catch (SoapFault $e) {
    echo "Error al obtener los datos: " . $e->getMessage();
    exit;
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
        <section id="txt_welcome" class="bg-gray-900 p-6 rounded-lg shadow-md">
            <div class="main-container flex justify-center items-center">
                <div class="flex flex-col seguimiento-container bg-slate-800 p-4 justify-center rounded-md items-center gap-3">
                    <div class="mensajes">
                        <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>";
                            elseif (isset($mensaje_error)) echo "<p style='color: red;'>$mensaje_error</p>"; ?>
                    </div>
                    
                    <h1 class="self-center justify-self-center text-3xl"><?php echo htmlspecialchars($challenge['name_challenge']); ?></h1>
                    <p class="self-center justify-self-center text-xl"><strong>Etapas :</strong> <?php echo htmlspecialchars($challenge['total_stages']); ?></p>

                    <h2 class="text-xl">Retos del Desafío</h2>
                    <ul class="retos-lista">
                        <?php foreach ($stages as $stage): ?>
                        <li class="reto-item shadow-md bg-slate-900 mb-2 text-xl py-1 px-2 rounded-md">
                            <span>Reto: <?php echo htmlspecialchars($stage['num_stage']); ?> :</span>
                            <span><?php echo htmlspecialchars($stage['name_stage']); ?></span>
                            <span><?php echo htmlspecialchars($stage['goal_stage']); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class="h-64 w-60 rounded-lg">
                    <div class="botones-accion">
                        <!-- Botón para regresar a la página anterior -->
                        <div class="boton">
                            <button class=" bg-lime-700 py-1 px-3 rounded-md" onclick="history.go(-1)">← Regresar</button>
                        </div>
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
