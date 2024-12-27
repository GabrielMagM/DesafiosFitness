<?php
session_start();
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';
$user = new Functions();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Supongamos que tienes el ID del usuario en la sesión
$id_user = $_SESSION['id_user']; // Asegúrate de que `id_user` esté en la sesión
$statistics = $user->getUserStatistics($id_user);

// Si no hay estadísticas para este usuario, inicializa con valores por defecto
if (!$statistics) {
    $statistics = [
        'challenges_joined' => 0,
        'challenges_completed' => 0,
        'challenges_in_progress' => 0,
    ];
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
    <nav class="mx-6 pt-3">
        <?php if (isset($_SESSION['email'])): ?>
            <?php include '../includes/header_log.php'; ?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php'; ?>
        <?php endif; ?>
    </nav>

    <!-- Contenido Principal -->
    <main class="mx-6 my-4">
        <section id="txt_welcome" class="bg-gray-900 p-3 rounded-lg shadow-md">
            <div class="flex flex-col main-container justify-center items-center gap-y-2">
                <h1 class="font-bold">Progreso en Desafios</h1>
                <div class="flex flex-col seguimiento-container bg-slate-800 px-8 py-3 justify-center rounded-md items-center gap-1">
                    <h2>Estadisticas de los Desafios</h2>
                    <div class="flex flex-col justify-center items-center">
                        <span>Desafíos Completados: <?php echo $statistics['challenges_completed']; ?></span>
                        <span>Retos Completados: <?php echo $statistics['challenges_completed']; ?></span>
                        <span>Desafíos Inscritos: <?php echo $statistics['challenges_in_progress']; ?></span>
                        <div class="barra-progreso bg-gray-700 rounded w-full h-4 mt-2 relative overflow-hidden">
                            <div class="progreso bg-green-500 h-full" style="width: <?php echo min(100, ($statistics['challenges_completed'] / max(1, $statistics['challenges_joined'])) * 100); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>
