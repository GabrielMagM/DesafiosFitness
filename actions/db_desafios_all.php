<?php
include '../config/Conexion.php'; 
        // Conectar a la base de datos
        $conn = Conexion::Conectar();

        // Obtener los desafíos creados por otros usuarios (excluyendo al usuario autenticado)
        $sql = "SELECT * FROM challenges WHERE user_id != :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $sql = "SELECT * FROM stages WHERE challenge_id != :challenge_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':challenge_id', $challenge_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica si se encontraron resultados
        if ($stmt->rowCount() > 0) {
            // Recorre cada desafío y genera el HTML
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4">
                    <div class="flex flex-col  w-5/6" >
                        <h4 class="text-white font-semibold self-center rounded-sm bg-gray-600 p-1"><?php echo htmlspecialchars($row['tittle']); ?></h4>
                        <p class="text-white font-bold break-all self-center">Etapa 1/5: Correr</p>
                        <p class="text-white font-bold break-all">Corre por 20min y sin parar</p>
                    </div>
                    <div class="flex" >
                        <img src="../assets/desafio_img/<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="" class="h-56 w-56 rounded-lg">
                    </div>
                    <button class="bg-indigo-600 p-1 rounded-md font-bold">Unirse al Desafio</button>
                </div>
                <?php
            }
        } else {
            echo "<p>No hay desafíos creados por otros usuarios en este momento.</p>";
        }
        ?>