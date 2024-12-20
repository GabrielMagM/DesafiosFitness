<?php
session_start();
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';
$user = new Functions();
// Lógica para cerrar sesión
include '../Core/logout.php'

$id_chalenge = $_GET['id_challenge'];

// Obtener detalles del desafío y retos desde el servicio SOAP
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
    $fechaUltimaCompletado = $user->getDateCompleted($id_user, $id_stage);
    $ahora = new DateTime();
    $intervalo = $fechaUltimaCompletado ? $ahora->diff(new DateTime($fechaUltimaCompletado)) : null;

    // Verifica si ha pasado el tiempo de espera de 10 segundos
    if (!$intervalo || $intervalo->s >= 10 || $intervalo->i >= 1) { // Incluir minutos para asegurar
        $user->completeStage($id_user, $id_stage); // Marcar el reto como completado
        header("Location: seguimiento-desafio.php?id_desafio=$id_challenge");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        *{
           
        }
       
        .bebas-neue-regular {
            font-family: "Bebas Neue", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>

<body class="bg-slate-800 font-sans leading-normal tracking-normal">
    <!-- Encabezado -->
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
            // Obtener el nombre del usuario basado en su correo electrónico
            $userName = $user->searchUser($_SESSION['email']);
            ?>
            <?php include '../includes/header_log.php';?>
        <?php else: ?>
            <?php include '../includes/header_noLog.php';?>
        <?php endif; ?>
    </nav>

    <!-- Contenido Principal -->
    <main class="mx-6 mb-2 mt-2 text-white">
        <section id="txt_welcome" class="bg-gray-900 p-6 rounded-lg shadow-md">
            <h2 class=" text-xl font-semibold mb-4 ">Bienvenido a los Desafíos Fitness</h2>        
            <p class="mt-4 ">Algunos desafíos para mejorar tu condición física. Únete y mantente motivado.</p>
        </section>

        <div class="seguimiento-container">
            <div class="mensajes">
                <?php if (isset($mensaje)) echo "<p style='color: green;'>$mensaje</p>";
                      elseif (isset($mensaje_error)) echo "<p style='color: red;'>$mensaje_error</p>"; ?>
            </div>
            <h2><?php echo htmlspecialchars($challenge['name_challenge']); ?></h2>
            <p><strong>Etapas: </strong> <?php echo htmlspecialchars($challenge['total_stages']); ?></p>

            <h3>Retos del Desafío</h3>
            <ul class="retos-lista">
                <?php foreach ($stages as $stage): ?>
                <li class="reto-item <?php echo $stage['completado'] ? 'completado' : ''; ?>">
                    <span><?php echo htmlspecialchars($stage['name_stage']); ?>
                    <?php
                        // Verifica si el reto puede ser completado y calcula los segundos restantes
                        $segundosRestantes = 0;
                        $puedeCompletar = true;
                        $tiempo = $stage['fecha_completado'] ? new DateTime($reto['fecha_completado']) : null;
                        if ($tiempo) {
                            $ahora = new DateTime();
                            $intervalo = $ahora->diff($tiempo);
                            $segundosRestantes = max(0, 10 - ($intervalo->s + $intervalo->i * 60));
                            $puedeCompletar = $segundosRestantes <= 0;
                        }
                        if ($segundosRestantes === 0) {
                            $usuario->resetRetos($idUsuario, $reto['id_reto']);
                        }
                    ?>

                    <?php if (!$reto['completado'] && $puedeCompletar && $usuario->usuarioInscritoEnDesafio($idUsuario, $idDesafio)): ?>
                    <form action="seguimiento-desafio.php?id_desafio=<?php echo $idDesafio; ?>" method="POST"
                        class="completar-form">
                        <input type="hidden" name="id_reto" value="<?php echo $reto['id_reto']; ?>">
                        <button type="submit" class="btn-completar">Marcar como Completado</button>
                    </form>
                    <?php elseif ($reto['completado']): ?>
                    <span class="completado-texto">Completado</span>
                    <?php if ($reto['completado'] === 1): ?>
                    <span class="disponible">Disponible en: <span class="temporizador"
                            data-tiempo="<?php echo $segundosRestantes; ?>">
                            <?php echo $segundosRestantes; ?></span> segundos</span>
                    <?php endif; ?>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="botones-accion">
                <!-- Botón para regresar a la página anterior -->
                <div class="boton">
                    <button onclick="history.go(-1)">← Regresar</button>
                </div>
                <!-- Botón para salirse del desafío -->
                <?php if ($usuario->usuarioInscritoEnDesafio($idUsuario, $idDesafio)): ?>
                <form method="POST" action="desafios.php" style="display: inline;">
                    <input type="hidden" name="id_desafio" value="<?php echo $desafio['id_desafio']; ?>">
                    <button type="submit" name="salir" class="btn-salir">Salirse del Desafío</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Script para el Temporizador de 10 Segundos -->
    <script>
    document.querySelectorAll('.temporizador').forEach(function(temporizador) {
        let tiempoRestante = parseInt(temporizador.getAttribute('data-tiempo'));
        const countdown = setInterval(() => {
            if (tiempoRestante > 0) {
                tiempoRestante--;
                temporizador.textContent = tiempoRestante;
            } else {
                clearInterval(countdown);
                // Eliminar el mensaje de "Disponible en..." y mostrar el botón
                const retoItem = temporizador.closest('.reto-item');
                retoItem.querySelector('.btn-completar').style.display = 'block';
                temporizador.parentElement.style.display = 'none';
            }
        }, 1000);
    });
    </script>


        <!-- Sección de Desafíos -->
        <section class="flex mt-4 gap-5 rounded-md">
            <div id="desafios_container" class="flex flex-col bg-gray-900 rounded-md w-full">
                
            </div>    
        </section>
    </main>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/JS/carrusel.js"></script>
    <script src="../assets/JS/lottiefiles.js"></script>
</body>
</html>
