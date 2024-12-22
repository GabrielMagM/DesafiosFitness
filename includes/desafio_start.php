<?php
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$function = new Functions();
$service = new Challenges();

try {
    // Intentamos obtener los desafíos
    $challenges = $service->getChallenges();
} catch (SoapFault $e) {
    // Si hay un error (como no hay desafíos), mostramos un mensaje amigable
    $challenges = null; // Indicamos que no hay desafíos
    $errorMessage = "No hay desafíos disponibles en este momento. ¡Vuelve más tarde!";
}
?>

<?php if ($challenges === null): ?>
    <!-- Mostrar mensaje si no hay desafíos disponibles -->
    <p class="text-red-500"><?php echo isset($errorMessage) ? htmlspecialchars($errorMessage) : "No se pudieron cargar los desafíos."; ?></p>
<?php else: ?>
    <!-- Si hay desafíos, mostramos la lista -->
    <?php foreach ($challenges as $challenge): ?>
        <div id="container" class="flex flex-col bg-gray-800 rounded-lg shadow-md p-2 items-center gap-y-1 w-3/4 text-xs">
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
                    <input type="hidden" name="id_challenge" value="">
                    <button class="text-xs bg-indigo-600 p-1 rounded-md font-bold" type="submit" name="unirse" class="btn-unirse">Unirse al Desafío</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
