<?php
// Iniciar sesión

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo "<p>No estás logueado. Por favor, inicia sesión.</p>";
    exit();
}

// Obtener la conexión a la base de datos
$conn = Conexion::Conectar();

// Obtener el user_id del usuario logueado
$user_id = $_SESSION['user_id'];

try {
    // Consultar los desafíos creados por el usuario
    $sqlChallenges = "SELECT id, tittle, total_stages, imagen_url, created_at 
                      FROM challenges 
                      WHERE user_id = :user_id 
                      ORDER BY created_at DESC";
    $stmtChallenges = $conn->prepare($sqlChallenges);
    $stmtChallenges->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtChallenges->execute();

    // Verificar si hay desafíos
    if ($stmtChallenges->rowCount() > 0) {
        while ($row = $stmtChallenges->fetch(PDO::FETCH_ASSOC)) {
            $challengeId = $row['id'];
            $tittle = htmlspecialchars($row['tittle']);
            $total_stages = (int)$row['total_stages'];
            $imagen_url = htmlspecialchars($row['imagen_url']);
            $created_at = htmlspecialchars($row['created_at']);

            // Verificar el progreso del usuario en este desafío
            $sqlProgress = "SELECT stage_id, completed 
                            FROM user_stages 
                            WHERE user_id = :user_id AND challenge_id = :challenge_id 
                            ORDER BY stage_id DESC LIMIT 1";
            $stmtProgress = $conn->prepare($sqlProgress);
            $stmtProgress->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmtProgress->bindParam(':challenge_id', $challengeId, PDO::PARAM_INT);
            $stmtProgress->execute();

            $stageNum = 0;
            $buttonText = "Unirse al Desafío";
            $buttonAction = "joinChallenge.php?challenge_id={$challengeId}";

            if ($stmtProgress->rowCount() > 0) {
                $progress = $stmtProgress->fetch(PDO::FETCH_ASSOC);
                $stageNum = (int)$progress['stage_id'];
                $completed = (bool)$progress['completed'];

                if ($completed && $stageNum < $total_stages) {
                    $buttonText = "Siguiente Desafío";
                    $buttonAction = "nextStage.php?challenge_id={$challengeId}&current_stage={$stageNum}";
                } elseif ($completed && $stageNum == $total_stages) {
                    $buttonText = "Completar Desafío";
                    $buttonAction = "completeChallenge.php?challenge_id={$challengeId}";
                }
            }

            // Generar el HTML
            echo "
                <div class='flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4'>
                    <div class='flex flex-col w-5/6'>
                        <h4 class='font-semibold self-center rounded-sm bg-gray-600 p-1'>{$tittle}</h4>
                        <p class='font-bold break-all self-center'>Etapa: {$stageNum}/ {$total_stages}</p>
                    </div>
                    <div class='flex'>
                        <img src='../assets/desafio_img/{$imagen_url}' alt='Imagen del desafío' class='h-56 w-56 rounded-lg'>
                    </div>
                    <a href='{$buttonAction}' class='bg-indigo-600 p-1 rounded-md font-bold'>{$buttonText}</a>
                </div>
            ";
        }
    } else {
        echo "<p class='text-gray-500'>No has creado ningún desafío aún.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
