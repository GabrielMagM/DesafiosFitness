<?php
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$function = new Functions();
$service = new Challenges();

try {
    $id_user = $_SESSION['id_user'] ?? null; // Obtén el ID del usuario desde la sesión
    if (!$id_user) {
        throw new Exception("Usuario no autenticado.");
    }
    // Obtener solo los desafíos disponibles para el usuario
    $challenges = $service->getAvailableChallenges($id_user);
} catch (Exception $e) {
    $challenges = null; // Indicamos que no hay desafíos
    $errorMessage = $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_challenge'])) {
    $id_user = $_SESSION['id_user'] ?? null; // Asegúrate de que el usuario esté autenticado
    $id_challenge = $_POST['id_challenge'];
    $challenge_name = $_POST['challenge_name'] ?? 'el desafío'; // Pasar el nombre del desafío desde el formulario
    
    if ($id_user && isset($_POST['unirse'])) {
        $result = $function->joinChallenge($id_user, $id_challenge);
        if ($result) {
            $mensaje = "Te has unido al desafío exitosamente!";
            echo "<script>
                    alert('¡Te has unido al desafío \"$challenge_name\" exitosamente!');
                    setTimeout(function() {
                        window.location.href = 'desafios.php';
                    }, 1000);
                  </script>";
        } else {
            $mensaje_error = "Hubo un error al unirse al desafío.";
        }
    } else {
        $mensaje_error = "Por favor, inicia sesión primero.";
    }
}

?>

<?php if ($challenges === null): ?>
    <!-- Mostrar mensaje si no hay desafíos disponibles -->
        <p class="ml-20 my-5 p-2 w-5/6"><?php echo isset($errorMessage) ? htmlspecialchars($errorMessage) : "No Hay Desafios Disponibles"; ?></p>  
<?php else: ?>
    <!-- Si hay desafíos, mostramos la lista -->
    <?php foreach ($challenges as $challenge): ?>
        <div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-2 items-center gap-y-1 w-3/4 text-xs my-2">
            <div id="challenge_info" class="flex flex-col w-5/6">
                <h4 class=" font-semibold self-center rounded-sm bg-gray-600 p-1"> <?php echo htmlspecialchars($challenge['name_challenge']); ?></h4>
                <p id="p" class="font-bold break-all self-center">Etapas: <?php echo htmlspecialchars($challenge['total_stages']); ?></p>
            </div>
            <?php 
                $creatorData = $function->getUser($challenge['created_by']);
                $creatorName = $creatorData ? $creatorData['username'] : 'Usuario desconocido';
            ?>
            <p><strong>Creado por:</strong> <?php echo htmlspecialchars($creatorName); ?></p>
            <div id="image_container" class="flex" >
                <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class="h-36 w-32 rounded-lg">
            </div>
            <div class="flex gap-2">
                <form method="GET" action="../views/trackChallenge.php" style="display: inline;">
                    <input type="hidden" name="id_challenge" value="<?php echo $challenge['id_challenge']; ?>">
                    <button class="text-xs bg-slate-500 p-1 rounded-md font-bold" type="submit" class="btn-ver-retos">Ver Retos</button>
                </form>

                <form method="POST" action="desafios.php" style="display: inline;">
                    <input type="hidden" name="id_challenge" value="<?php echo $challenge['id_challenge']; ?>">
                    <input type="hidden" name="challenge_name" value="<?php echo htmlspecialchars($challenge['name_challenge']); ?>">
                    <button class="text-xs bg-indigo-600 p-1 rounded-md font-bold" type="submit" name="unirse" class="btn-unirse">Unirse al Desafío</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
