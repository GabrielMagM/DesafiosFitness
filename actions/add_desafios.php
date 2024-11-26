<?php
// Iniciar sesión
session_start();

// Incluir la conexión a la base de datos
include '../config/Conexion.php';  // Asegúrate de que la ruta sea correcta

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    die("No estás logueado. Por favor, inicia sesión.");
}

// Obtener la conexión a la base de datos
$conn = Conexion::Conectar(); // Usamos el método estático para obtener la conexión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $tittle = $_POST['tittle'];
    $imagen_url = $_POST['imagen_url'];
    $total_stages = $_POST['total_stages'];
    $user_id = $_SESSION['user_id'];  // Obtener el user_id de la sesión

    // Validar que los campos no estén vacíos
    if (empty($tittle) || empty($imagen_url) || empty($total_stages)) {
        echo "Por favor, completa todos los campos.";
    } else {
        try {
            // Iniciar una transacción
            $conn->beginTransaction();

            // Insertar el desafío
            $sqlChallenge = "INSERT INTO challenges (user_id, tittle, total_stages, imagen_url) 
                             VALUES (:user_id, :tittle, :total_stages, :imagen_url)";
            
            $stmtChallenge = $conn->prepare($sqlChallenge);
            $stmtChallenge->bindParam(':user_id', $user_id);
            $stmtChallenge->bindParam(':tittle', $tittle);
            $stmtChallenge->bindParam(':total_stages', $total_stages, PDO::PARAM_INT);
            $stmtChallenge->bindParam(':imagen_url', $imagen_url);

            // Ejecutar la consulta
            if ($stmtChallenge->execute()) {
                // Obtener el ID del desafío recién creado
                $challengeId = $conn->lastInsertId();

                // Insertar las etapas asociadas
                $sqlStage = "INSERT INTO stages (user_id, challenge_id, stage_num, stage_name, stage_goal) 
                             VALUES (:user_id, :challenge_id, :stage_num, :stage_name, :stage_goal)";
                
                $stmtStage = $conn->prepare($sqlStage);

                // Recorrer las etapas enviadas en el formulario
                foreach ($_POST['stages'] as $index => $stage) {
                    $stageNum = $index; // Número de la etapa
                    $stageName = $stage['stage_name'];
                    $stageGoal = $stage['stage_goal'];

                    // Vincular los parámetros
                    $stmtStage->bindParam(':user_id', $user_id);
                    $stmtStage->bindParam(':challenge_id', $challengeId);
                    $stmtStage->bindParam(':stage_num', $stageNum, PDO::PARAM_INT);
                    $stmtStage->bindParam(':stage_name', $stageName);
                    $stmtStage->bindParam(':stage_goal', $stageGoal);

                    // Ejecutar la consulta
                    $stmtStage->execute();
                }

                // Confirmar la transacción
                $conn->commit();
                echo "Desafío y etapas creados exitosamente.";
            } else {
                throw new Exception("Error al crear el desafío.");
            }
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conn->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
