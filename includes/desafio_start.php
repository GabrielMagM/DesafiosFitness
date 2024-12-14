<?php
session_start();
include 'include/functions.php';
include 'include/cliente-desafios.php';

$funciones = new Functions();
$servicio = new Desafios();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
} else {
    $nombre = $funciones->buscarUsuario($_SESSION['email']);
    $idUsuario = $_SESSION['id_usuario'];
}

$desafios = $servicio->obtenerDesafios();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_desafio'])) {
    $idDesafio = $_POST['id_desafio'];
    
    if (isset($_POST['unirse'])) {
        if ($funciones->unirseDesafio($idUsuario, $idDesafio)) {
            $mensaje = "Te has unido al desafío exitosamente!";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'seguimiento-desafio.php?id_desafio=$idDesafio';
                    }, 1000);
                  </script>";
        } else {
            $mensaje_error = "Ya estás inscrito en este desafío.";
        }
    } elseif (isset($_POST['salir'])) {
        if ($funciones->salirDesafio($idUsuario, $idDesafio)) {
            $mensaje = "Has salido del desafío exitosamente.";
        } else {
            $mensaje_error = "Hubo un problema al intentar salir del desafío.";
        }
    }
}
?>

<!--<div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-1 items-center gap-y-1 w-10/12">
    <div id="challenge_info" class="flex flex-col w-5/6" >
        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1"><?php echo htmlspecialchars($name_challenge); ?></h4>
        <p id="p" class=" font-bold break-all self-center">Etapa <?php echo htmlspecialchars($num_stage); ?> / <?php echo htmlspecialchars($total_stages); ?>: <?php echo htmlspecialchars($name_stage); ?></p>
        <p class=" font-bold break-all text-xs"><?php echo htmlspecialchars($goal_stage); ?></p>
    </div>
    <div id="image_container" class="flex" >
        <img src="../assets/images/<?php echo htmlspecialchars($imagen_url); ?>" alt="" class="h-44 w-44 rounded-lg">
    </div>
    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
</div> -->
