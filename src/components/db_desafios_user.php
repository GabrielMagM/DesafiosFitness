<?php
// Asegúrate de que el usuario esté autenticado antes de intentar acceder a los desafíos
if (!isset($_SESSION['id_usuario'])) {
    die("<p>Debes iniciar sesión para ver los desafíos.</p>");
}

// Conectar a la base de datos
$conn = Conexion::Conectar();

// Obtener el ID del usuario que está autenticado
$id_usuario = $_SESSION['id_usuario'];

// Realizar la consulta para obtener solo los desafíos del usuario autenticado
$sql = "SELECT * FROM desafios WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();

// Verifica si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Recorre cada desafío y genera el HTML
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Obtener las etapas de este desafío
        $id_desafio = $row['id'];
        $sql_etapas = "SELECT * FROM etapas WHERE id_desafio = :id_desafio ORDER BY id ASC";
        $stmt_etapas = $conn->prepare($sql_etapas);
        $stmt_etapas->bindValue(':id_desafio', $id_desafio, PDO::PARAM_INT);
        $stmt_etapas->execute();

        // Verifica si hay etapas para este desafío
        if ($stmt_etapas->rowCount() > 0) {
            $etapas = $stmt_etapas->fetchAll(PDO::FETCH_ASSOC);
            $total_etapas = count($etapas); // Contamos las etapas

            // Mostrar el desafío y la primera etapa (suponiendo que el desafío tiene etapas)
            ?>
            <div class="bg-white rounded-lg shadow-md flex flex-col w-4/5 p-2 items-center">
                <div class="flex flex-col w-10/12">
                    <!-- Mostrar título del desafío -->
                    <h4 class="text-blue-600 font-semibold flex text-left"><?php echo htmlspecialchars($row['titulo']); ?></h4>
                    <!-- Mostrar la etapa actual y el total de etapas -->
                    <p class="text-gray-700 flex text-left">Etapa 1/<?php echo $total_etapas; ?>: <?php echo htmlspecialchars($etapas[0]['titulo_etapa']);
                     ?>
                     </p>
                     <p class="text-gray-700 flex text-left"><?php echo htmlspecialchars($etapas[0]['descripcion_etapa']); ?></p>
                </div>

                <!-- Verificar si existe la imagen antes de mostrarla -->
                <div class="flex gap-1">
                    <div class="flex border-cyan-600 border-2">
                        <img src="../assets/desafio_img/<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="" class="h-56 w-42 object-cover">
                    </div>
                </div>

                <!-- Botón de "Unirse al Desafío" -->
                <div class="flex gap-5 mt-1">
                    <button class="bg-green-500 p-1 rounded-md">Unirse al Desafío</button>
                </div>
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
