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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_stage'])) {
    $id_stage = $_POST['id_stage'];
    $fechaUltimaCompletado = $user->obtenerFechaCompletado($id_user, $id_stage);
    $ahora = new DateTime();
    $intervalo = $fechaUltimaCompletado ? $ahora->diff(new DateTime($fechaUltimaCompletado)) : null;

    // Verifica si ha pasado el tiempo de espera de 10 segundos
    if (!$intervalo || $intervalo->s >= 10 || $intervalo->i >= 1) { // Incluir minutos para asegurar
        $user->completarReto($id_user, $id_stage); // Marcar el reto como completado
        header("Location: seguimiento-desafio.php?id_challenge=$id_challenge");
        exit;
    } else {
        $mensaje_error = "Debes esperar 10 segundos para marcar este reto como completado nuevamente.";
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
                    <ul class="retos-lista">
                        <?php foreach ($stages as $stage): ?>
                        <li class="text-sm reto-item shadow-md bg-slate-900 mb-2 py-1 px-2 rounded-md">
                            <span>Reto: <?php echo htmlspecialchars($stage['num_stage']); ?> :</span>
                            <span><?php echo htmlspecialchars($stage['name_stage']); ?></span>
                            <span><?php echo htmlspecialchars($stage['goal_stage']); ?></span>
                        </li>

                        <?php if (!$reto['completado'] && $puedeCompletar && $usuario->usuarioInscritoEnDesafio($idUsuario, $idDesafio)): ?>
                            <form action="seguimiento-desafio.php?id_desafio=<?php echo $idDesafio; ?>" method="POST"
                                class="completar-form">
                                <input type="hidden" name="id_reto" value="<?php echo $reto['id_reto']; ?>">
                                <button type="submit" class="btn-completar">Marcar como Completado</button>
                            </form>
                            <?php elseif ($reto['completado'] === 1 ): ?>
                                <span class="completado-texto">Completado</span>
                        <?php endif; ?>

                        <?php endforeach; ?>
                    </ul>
                    <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class="h-56 w-52 rounded-lg">
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
