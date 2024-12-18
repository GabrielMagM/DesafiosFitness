<?php
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$function = new Functions();
$service = new Challenge();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
} else {
    $name = $function->searchUser($_SESSION['email']);
    $id_user = $_SESSION['id_user'];
}

$challenge = $service->getChallenge();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_challenge'])) {
    $id_challenge = $_POST['id_challenge'];
    
    if (isset($_POST['unirse'])) {
        if ($function->unirseDesafio($idUsuario, $idDesafio)) {
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
        if ($function->salirDesafio($idUsuario, $idDesafio)) {
            $mensaje = "Has salido del desafío exitosamente.";
        } else {
            $mensaje_error = "Hubo un problema al intentar salir del desafío.";
        }
    }
}
?>


<!--<div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-1 items-center gap-y-1 w-10/12">
    <div id="challenge_info" class="flex flex-col w-5/6" >
        <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1"> Desafio del Tiburon </h4>
        <p id="p" class=" font-bold break-all self-center">Correr Hasta morir</p>
        <p id="p" class=" font-bold break-all self-center">Etapas: 3</p>
    </div>
    <div id="image_container" class="flex" >
        <img src="../assets/images/runing.webp" alt="" class="h-44 w-44 rounded-lg">
    </div>

    <div class="flex gap-2">
        <form method="GET" action="seguimiento-desafio.php" style="display: inline;">
            <input type="hidden" name="id_desafio" value="<?php echo $desafio['id_desafio']; ?>">
            <button class="bg-slate-500 p-1 rounded-md font-bold" type="submit" class="btn-ver-retos">Ver Retos</button>
        </form>

        <form method="POST" action="desafios.php" style="display: inline;">
            <input type="hidden" name="id_desafio" value="">
            <button class="bg-indigo-600 p-1 rounded-md font-bold" type="submit" name="unirse" class="btn-unirse">Unirse al Desafío</button>
        </form>
    </div>
</div>


