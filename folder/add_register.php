<?php
// Inicia la sesión para poder usar $_SESSION
include '../config/Conexion.php';  // Incluye la clase de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        echo "<script>
                    alert('Las Contraseñas no Coinciden. Inténtelo de nuevo.');
                    window.location.href = 'register.php'; // Redirige a la página de registro
                </script>";
        exit;
    }

    // Conectar a la base de datos
    $conexion = Conexion::Conectar();

    if ($conexion) {
        // Verificar si el email ya está registrado
        $stmt = $conexion->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Si el email ya existe
        if ($stmt->fetchColumn() > 0) {
            echo "<script>
                    alert('Este correo electrónico ya está registrado. Por favor, use otro.');
                    window.location.href = 'register.php'; // Redirige a la página de registro
                </script>";
            exit;
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el usuario en la base de datos
        $stmt = $conexion->prepare("INSERT INTO users (name, email, password, created_at) VALUES (:name, :email, :password, NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // Obtener el ID del usuario recién creado
            $user_id = $conexion->lastInsertId();

            // Crear desafíos para este usuario
            $desafios = [
                [
                    'title' => 'Desafio Maraton',
                    'total_stages' => 2,
                    'imagen_url' => 'runing.webp',
                    'stages' => [
                        ['stage_name' => 'Corre 1', 'stage_goal' => 'Corre unos 6km'],
                        ['stage_name' => 'Corre 2', 'stage_goal' => 'Corre en una competencia']
                    ]
                ],
                [
                    'title' => 'Desafio de Fuerza',
                    'total_stages' => 2,
                    'imagen_url' => 'peso_muerto.webp',
                    'stages' => [
                        ['stage_name' => 'Fuerza 1', 'stage_goal' => 'Comienza con mucho peso'],
                        ['stage_name' => 'SuperFuerza 2', 'stage_goal' => 'Termina con estiramientos']
                    ]
                ]
            ];

            foreach ($desafios as $desafio) {
                // Insertar el desafío en la tabla challenges
                $stmt_challenge = $conexion->prepare(
                    "INSERT INTO challenges (user_id, tittle, total_stages, imagen_url, created_at) 
                    VALUES (:user_id, :tittle, :total_stages, :imagen_url, NOW())"
                );
                $stmt_challenge->bindParam(':user_id', $user_id);
                $stmt_challenge->bindParam(':tittle', $desafio['title']);
                $stmt_challenge->bindParam(':total_stages', $desafio['total_stages']);
                $stmt_challenge->bindParam(':imagen_url', $desafio['imagen_url']);

                if ($stmt_challenge->execute()) {
                    // Obtener el ID del desafío recién insertado
                    $challenge_id = $conexion->lastInsertId();
                    if (!$challenge_id) {
                        die("Error: No se pudo obtener el ID del desafío recién insertado.");
                    }

                    // Insertar las etapas en la tabla stages
                    foreach ($desafio['stages'] as $index => $etapa) {
                        $stage_num = $index + 1; // Almacena el número de etapa en una variable
                        $stage_name = $etapa['stage_name'];
                        $stage_goal = $etapa['stage_goal'];
                    
                        $stmt_stage = $conexion->prepare(
                            "INSERT INTO stages (user_id, challenge_id, stage_num, stage_name, stage_goal) 
                            VALUES (:user_id, :challenge_id, :stage_num, :stage_name, :stage_goal)"
                        );
                    
                        $stmt_stage->bindParam(':user_id', $user_id);
                        $stmt_stage->bindParam(':challenge_id', $challenge_id);
                        $stmt_stage->bindParam(':stage_num', $stage_num); // Usa la variable en lugar de la expresión
                        $stmt_stage->bindParam(':stage_name', $stage_name);
                        $stmt_stage->bindParam(':stage_goal', $stage_goal);
                    
                        if (!$stmt_stage->execute()) {
                            die("Error al insertar la etapa: " . print_r($stmt_stage->errorInfo(), true));
                        }
                    }
                } else {
                    die("Error al insertar el desafío: " . print_r($stmt_challenge->errorInfo(), true));
                }
            }

            // Redirigir al login
            echo "<script>
                    alert('Registro exitoso. Desafíos creados. Ahora debe logearse.');
                    window.location.href = 'login.php'; // Redirige al login
                </script>";
            exit;
        } else {
            echo "Error en el registro.";
        }
    } else {
        echo "No se pudo conectar a la base de datos.";
    }
}
?>
