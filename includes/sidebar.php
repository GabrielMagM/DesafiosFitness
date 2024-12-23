<?php
include_once '../Core/functions.php';
include_once '../Core/client-challenge.php';

$function = new Functions();
$service = new Challenges();

try {
    $id_user = $_SESSION['id_user'] ?? null;
    if (!$id_user) {
        throw new Exception("Usuario no autenticado.");
    }

    // Obtener desafíos
    $challenges = $function->getJoinedChallenges($id_user);
    if (!$challenges) {
        throw new Exception("No se encontraron desafíos para este usuario.");
    }
} catch (Exception $e) {
    $challenges = null;
    $errorMessage = $e->getMessage();
}
?>

<div id="sidebar_container" class="bg-gray-900 text-white w-96 rounded-md">
    <h2 id="sidebar_tittle" class="text-sm font-bold p-4 self-center border-b border-gray-300 text-center">Mis Desafíos</h2>
    <ul id="challengeList" class="p-4">
        <?php if (!empty($errorMessage)): ?>
            <li class="text-red-400"><?php echo htmlspecialchars($errorMessage); ?></li>
        <?php elseif (empty($challenges)): ?>
            <li class="text-gray-400">No te has unido a ningún desafío.</li>
        <?php else: ?>
            <?php foreach ($challenges as $challenge): ?>
                <li class="flex flex-column mb-2 gap-x-2 p-2 bg-gray-700 rounded cursor-pointer" onclick="openModal(<?php echo $challenge['id_challenge']; ?>)">
                    <img src="../assets/images/<?php echo htmlspecialchars($challenge['imagen_url']);?>" alt="" class=" w-6 h-6 rounded-sm">
                    <?php echo htmlspecialchars($challenge['name_challenge']); ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>