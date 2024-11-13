<?php
// Asegúrate de que el usuario esté autenticado antes de intentar acceder a los desafíos
if (!isset($_SESSION['user_id'])) {
    die(" <p>Debes iniciar sesión para ver los desafíos.</p>");
}

// Conectar a la base de datos
$conn = Conexion::Conectar();

// Obtener el ID del usuario que está autenticado
$user_id = $_SESSION['user_id'];

// Realizar la consulta para obtener solo los desafíos del usuario autenticado
$sql = "SELECT * FROM desafios WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Verifica si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Recorre cada desafío y genera el HTML
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="bg-white rounded-lg shadow-md flex flex-col w-4/5 p-2 items-center">
                <div class="flex flex-col w-10/12">
                    <h4 class="text-blue-600 font-semibold flex text-left"><?php echo htmlspecialchars($row['titulo']); ?></h4>
                    <p class="text-gray-700 flex text-left"><?php echo htmlspecialchars($row['descripcion']); ?></p>
                </div>
                <div class="flex gap-1">
                    <div class="flex border-cyan-600 border-2">
                        <img src="../assets/desafio_img/<?php echo htmlspecialchars($row['imagen_url']); ?>" alt="" class="h-56 w-42 object-cover">
                    </div>
                    <div class="flex flex-col border-cyan-600 border-2">
                        <div class="flex-wrap px-2 gap-1 ">
                                <p class="text-gray-700 font-bold">aqui va la etapa  </p>
                                <p class="self-start text-blue-500 ">aqui su descripcion</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-5 mt-1 ">
                    <button class="bg-green-500 p-1 rounded-md">Unirse al Desafio</button>
                    <!--<button type="button" onclick="cambiarImagen(1)">Siguente Etapa▶</button>-->
                </div>
        </div>
        <?php
    }
} else {
    echo "<p>No tienes desafíos disponibles en este momento.</p>";
}
?>