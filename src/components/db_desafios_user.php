<?php
// Iniciar sesión
// Incluir la conexión a la base de datos
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
    $sql = "SELECT tittle, total_stages, imagen_url, created_at 
            FROM challenges 
            WHERE user_id = :user_id 
            ORDER BY created_at DESC"; // Mostrar los más recientes primero
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar si hay desafíos
    if ($stmt->rowCount() > 0) {
        // Iterar sobre los desafíos y generar el HTML
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tittle = htmlspecialchars($row['tittle']);
            $total_stages = (int)$row['total_stages'];
            $imagen_url = htmlspecialchars($row['imagen_url']);
            $created_at = htmlspecialchars($row['created_at']);

            echo "
                <div class='flex flex-col bg-gray-900 rounded-lg shadow-md p-2 items-center gap-2 w-3/4'>
                    <div class='flex flex-col w-5/6'>
                        <h4 class='font-semibold self-center rounded-sm bg-gray-600 p-1'>{$tittle}</h4>
                        <p class='font-bold break-all self-center'>Total de Etapas: {$total_stages}</p>
                        <p class='font-bold break-all'>Creado el: {$created_at}</p>
                    </div>
                    <div class='flex'>
                        <img src='../assets/desafio_img/{$imagen_url}' alt='Imagen del desafío' class='h-56 w-56 rounded-lg'>
                    </div>
                    <button class='bg-indigo-600 p-1 rounded-md font-bold'>Editar Desafío</button>
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
