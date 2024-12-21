<?php
session_start();
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$user = new Functions();
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
<body class="bg-slate-800 text-white font-sans leading-normal tracking-normal">
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
        <div class="main-container">
        <div class="seguimiento-container">
            <div class="mensajes">
                <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>";
                      elseif (isset($mensaje_error)) echo "<p style='color: red;'>$mensaje_error</p>"; ?>
            </div>
            <h2><?php echo htmlspecialchars($challenge['name_challenge']); ?></h2>
            <p><strong>Etapas :</strong> <?php echo htmlspecialchars($challenge['total_stages']); ?></p>

            <h3>Retos del Desafío</h3>
            <ul class="retos-lista">
                <?php foreach ($stages as $stage): ?>
                <li class="reto-item ">
                    <span><?php echo htmlspecialchars($stage['name_stage']); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="botones-accion">
                <!-- Botón para regresar a la página anterior -->
                <div class="boton">
                    <button onclick="history.go(-1)">← Regresar</button>
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
