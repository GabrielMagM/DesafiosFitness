<?php
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$function = new Functions();
$service = new Challenges();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
} else {
    $name = $function->searchUser($_SESSION['email']);
    $id_user = $_SESSION['id_user'];
}

$challenges = $service->getChallenge();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_challenge'])) {
    $id_challenge = $_POST['id_challenge'];
    
    if (isset($_POST['unirse'])) {
        if ($function->unirseDesafio($id_user, $id_challenge)) {
            $mensaje = "Te has unido al desafío exitosamente!";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'seguimiento-desafio.php?id_desafio=$id_challenge';
                    }, 1000);
                  </script>";
        } else {
            $mensaje_error = "Ya estás inscrito en este desafío.";
        }
    } elseif (isset($_POST['salir'])) {
        if ($function->salirDesafio($id_user, $id_challenge)) {
            $mensaje = "Has salido del desafío exitosamente.";
        } else {
            $mensaje_error = "Hubo un problema al intentar salir del desafío.";
        }
    }
}
?>

<?php foreach ($challenges as $challenge): ?>
    <div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-1 items-center gap-y-1 w-10/12">
        <div id="challenge_info" class="flex flex-col w-5/6" >
            <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1"> <?php echo htmlspecialchars($challenge['name_challenge']); ?></h4>
            <p id="p" class=" font-bold break-all self-center">Etapas: <?php echo htmlspecialchars($challenge['total_stages']); ?></p>
        </div>
        <?php 
            $creatorData = $function->getUser($challenge['created_by']);
            $creatorName = $creatorData ? $creatorData['username'] : 'Usuario desconocido';
        ?>
        <p><strong>Creado por:</strong> <?php echo htmlspecialchars($creatorName); ?></p>
        <div id="image_container" class="flex" >
            <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class="h-44 w-44 rounded-lg">
        </div>
        <div class="flex gap-2">
            <form method="GET" action="../views/seguimiento-desafio.php" style="display: inline;">
                <input type="hidden" name="id_desafio" value="<?php echo $desafio['id_desafio']; ?>">
                <button class="bg-slate-500 p-1 rounded-md font-bold" type="submit" class="btn-ver-retos">Ver Retos</button>
            </form>

            <form method="POST" action="desafios.php" style="display: inline;">
                <input type="hidden" name="id_desafio" value="">
                <button class="bg-indigo-600 p-1 rounded-md font-bold" type="submit" name="unirse" class="btn-unirse">Unirse al Desafío</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>