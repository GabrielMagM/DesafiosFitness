<?php
// Asegúrate de que el usuario esté autenticado antes de intentar acceder a los desafíos
if (!isset($_SESSION['user_id'])) {
    die("<p>Debes iniciar sesión para ver los desafíos.</p>");
}

// Conectar a la base de datos
$conn = Conexion::Conectar();

// Obtener el ID del usuario que está autenticado
$user_id = $_SESSION['user_id'];

// Realizar la consulta para obtener solo los desafíos del usuario autenticado
$sql = "SELECT * FROM challenges WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Verifica si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Recorre cada desafío y genera el HTML
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Obtener las etapas de este desafío
        $challenge_id = $row['id'];
        $sql_stages = "SELECT * FROM stages WHERE challenge_id = :challenge_id ORDER BY id ASC";
        $stmt_stages = $conn->prepare($sql_stages);
        $stmt_stages->bindValue(':challenge_id', $challenge_id, PDO::PARAM_INT);
        $stmt_stages->execute();

        // Verifica si hay etapas para este desafío
        if ($stmt_stages->rowCount() > 0) {
            $stages = $stmt_stages->fetchAll(PDO::FETCH_ASSOC);
            $total_stages = count($stages); // Contamos las etapas

            // Mostrar el desafío y la primera etapa (suponiendo que el desafío tiene etapas)
            ?>
            
            <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class="text-white font-semibold self-center rounded-sm bg-gray-600 p-1"><?php echo htmlspecialchars($row['tittle']); ?></h4>
                        <p class="text-white font-bold break-all self-center">Etapa <?php echo htmlspecialchars($stages[0]['stage_num']); ?> /<?php echo $total_stages; ?> : <?php echo htmlspecialchars($stages[0]['stage_name']);?></p>
                        <p class="text-white font-bold break-all"><?php echo htmlspecialchars($stages[0]['stage_goal']);?></p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/images/<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                </div>
            <?php
        } else {
            echo "<p>No hay etapas para este desafío.</p>";
        }
    }
} else {
    echo "<p>No tienes desafíos disponibles en este momento.</p>";
}
?>