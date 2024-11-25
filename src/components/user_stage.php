<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include 'Conexion.php';  // Ajustar la ruta si es necesario

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("No estás logueado. Por favor, inicia sesión.");
}

// Obtener la conexión a la base de datos
$conn = Conexion::Conectar(); 

// Obtener el user_id de la sesión
$user_id = $_SESSION['user_id'];

// Verificar si se ha enviado una acción
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['challenge_id'])) {
    $challenge_id = (int)$_POST['challenge_id'];
    $action = $_POST['action'];

    try {
        // Verificar el progreso actual del usuario en este desafío
        $sqlProgress = "SELECT us.stage_id, s.stage_num, s.challenge_id, c.total_stages 
                        FROM user_stages us
                        INNER JOIN stages s ON us.stage_id = s.id
                        INNER JOIN challenges c ON s.challenge_id = c.id
                        WHERE us.user_id = :user_id AND c.id = :challenge_id
                        ORDER BY s.stage_num DESC
                        LIMIT 1";

        $stmtProgress = $conn->prepare($sqlProgress);
        $stmtProgress->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtProgress->bindParam(':challenge_id', $challenge_id, PDO::PARAM_INT);
        $stmtProgress->execute();

        $currentStage = $stmtProgress->fetch(PDO::FETCH_ASSOC);

        if ($action === 'join') {
            // El usuario se une al desafío por primera vez
            if (!$currentStage) {
                // Obtener la primera etapa del desafío
                $sqlFirstStage = "SELECT id FROM stages 
                                  WHERE challenge_id = :challenge_id 
                                  ORDER BY stage_num ASC LIMIT 1";
                $stmtFirstStage = $conn->prepare($sqlFirstStage);
                $stmtFirstStage->bindParam(':challenge_id', $challenge_id, PDO::PARAM_INT);
                $stmtFirstStage->execute();
                $firstStage = $stmtFirstStage->fetch(PDO::FETCH_ASSOC);

                if ($firstStage) {
                    // Insertar el progreso en la tabla `user_stages`
                    $sqlInsert = "INSERT INTO user_stages (user_id, challenge_id, stage_id, start_date) 
                                  VALUES (:user_id, :challenge_id, :stage_id, CURDATE())";
                    $stmtInsert = $conn->prepare($sqlInsert);
                    $stmtInsert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':challenge_id', $challenge_id, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':stage_id', $firstStage['id'], PDO::PARAM_INT);
                    $stmtInsert->execute();
                    echo "Te has unido al desafío.";
                }
            }
        } elseif ($action === 'next') {
            // Avanzar a la siguiente etapa
            if ($currentStage && $currentStage['stage_num'] < $currentStage['total_stages']) {
                // Obtener la siguiente etapa
                $sqlNextStage = "SELECT id FROM stages 
                                 WHERE challenge_id = :challenge_id 
                                 AND stage_num = :next_stage_num 
                                 LIMIT 1";
                $nextStageNum = $currentStage['stage_num'] + 1;
                $stmtNextStage = $conn->prepare($sqlNextStage);
                $stmtNextStage->bindParam(':challenge_id', $challenge_id, PDO::PARAM_INT);
                $stmtNextStage->bindParam(':next_stage_num', $nextStageNum, PDO::PARAM_INT);
                $stmtNextStage->execute();
                $nextStage = $stmtNextStage->fetch(PDO::FETCH_ASSOC);

                if ($nextStage) {
                    // Marcar la etapa actual como completada
                    $sqlComplete = "UPDATE user_stages 
                                    SET completed = 1, end_date = CURDATE() 
                                    WHERE user_id = :user_id 
                                    AND stage_id = :stage_id";
                    $stmtComplete = $conn->prepare($sqlComplete);
                    $stmtComplete->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmtComplete->bindParam(':stage_id', $currentStage['stage_id'], PDO::PARAM_INT);
                    $stmtComplete->execute();

                    // Insertar la nueva etapa
                    $sqlInsertNext = "INSERT INTO user_stages (user_id, challenge_id, stage_id, start_date) 
                                      VALUES (:user_id, :challenge_id, :stage_id, CURDATE())";
                    $stmtInsertNext = $conn->prepare($sqlInsertNext);
                    $stmtInsertNext->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmtInsertNext->bindParam(':challenge_id', $challenge_id, PDO::PARAM_INT);
                    $stmtInsertNext->bindParam(':stage_id', $nextStage['id'], PDO::PARAM_INT);
                    $stmtInsertNext->execute();
                    echo "Has avanzado a la siguiente etapa.";
                }
            }
        } elseif ($action === 'complete') {
            // Completar el desafío
            if ($currentStage && $currentStage['stage_num'] == $currentStage['total_stages']) {
                // Marcar la etapa actual como completada
                $sqlComplete = "UPDATE user_stages 
                                SET completed = 1, end_date = CURDATE() 
                                WHERE user_id = :user_id 
                                AND stage_id = :stage_id";
                $stmtComplete = $conn->prepare($sqlComplete);
                $stmtComplete->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmtComplete->bindParam(':stage_id', $currentStage['stage_id'], PDO::PARAM_INT);
                $stmtComplete->execute();
                echo "¡Has completado el desafío!";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
