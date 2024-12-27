<?php 
include_once '../config/Conexion.php';

class Functions extends Conexion{

    //---------AQUI SE IMPLEMENTE EL REGISTRAR - INICIAR SESION-------------//

    public function registerUser($username, $email, $password){
        try{
            $con = Conexion::Conectar();
            // Cifrar la contraseña
            $consulta = $con->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $consulta->bindParam(':username', $username);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':password', $password);
            $consulta->execute();
        } catch (PDOException $e){
            echo "Error al Registrar Usuario: " . $e->getMessage();
        }
    }
    
    public function loginUser($email, $password){
        try{
            $con = Conexion::Conectar();
            $consulta = $con->prepare("SELECT * FROM users WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $user = $consulta->fetch(PDO::FETCH_ASSOC);
            // Comparar contraseñas sin cifrar
            if ($user && $user['password'] === $password) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al iniciar sesión: " . $e->getMessage();
            return false;
        }
    }

    //SECCION PARA BUSCAR USUARIOS DENTRO DE LA BD
    public function getUser($id_user)
    {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("SELECT username, email FROM users WHERE id_user = :id_user");
        $consulta->bindParam(':id_user', $id_user);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    
    public function searchUser($email){
        try {
            $con = Conexion::Conectar();
            $consulta = $con->prepare("SELECT username FROM users WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['username'] : null;
        } catch (PDOException $e) {
            echo "Error al buscar usuario: " . $e->getMessage();
            return null;
        }
    }

    public function getIdUser($email){
        try
        {
            $con = Conexion::Conectar();
            $consulta = $con->prepare("SELECT id_user FROM users WHERE email = :email");
            $consulta->bindParam(':email', $email);
            $consulta->execute();
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id_user'] : null;
        }catch (PDOException $e){
            echo "Error al obtener ID del Usuario: " . $e->getMessage();
            return null;
        }
    }

    //------Aqui Estará la Seccion de challenges-------------//
    public function createChallenge($name_challenge, $image_url, $total_stages, $createdBy) {
        $con = Conexion::Conectar();
    
        // Verificar si el desafío con el mismo nombre ya existe
        $verificarConsulta = $con->prepare("SELECT COUNT(*) FROM challenges WHERE name_challenge = :name_challenge");
        $verificarConsulta->bindParam(':name_challenge', $name_challenge);
        $verificarConsulta->execute();
        $existe = $verificarConsulta->fetchColumn();
        if ($existe > 0) {
            return false;
        }
    
        // Si no existe, insertar el nuevo desafío
        $consulta = $con->prepare("
            INSERT INTO challenges (name_challenge, imagen_url, total_stages, created_by, created_at) 
            VALUES (:name_challenge, :imagen_url ,:total_stages, :created_by, NOW())
        ");
        $consulta->bindParam(':name_challenge', $name_challenge);
        $consulta->bindParam(':imagen_url', $image_url);
        $consulta->bindParam(':total_stages', $total_stages);
        $consulta->bindParam(':created_by', $createdBy);
        return $consulta->execute();
    }
    
    public function createStage($id_challenge, $num_stage, $name_stage, $goal_stage) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("
            INSERT INTO stages (id_challenge, num_stage, name_stage, goal_stage) 
            VALUES (:id_challenge, :num_stage, :name_stage, :goal_stage)
        ");
        $consulta->bindParam(':id_challenge', $id_challenge);
        $consulta->bindParam(':num_stage', $num_stage);
        $consulta->bindParam(':name_stage', $name_stage);
        $consulta->bindParam(':goal_stage', $goal_stage);
        return $consulta->execute();
    }
                          //usado para INsertar stages
    public function getIdChallenge($name_challenge) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("SELECT id_challenge FROM challenges WHERE name_challenge = :name_challenge LIMIT 1");
        $consulta->bindParam(':name_challenge', $name_challenge);
        $consulta->execute();
        return $consulta->fetchColumn();
    }

    
    //----------------Mostrar challenges y Stages------------->
    
    public function getChallenges() {
        $con = Conexion::Conectar();
        $consulta = $con->query("SELECT * FROM challenges");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChallengeById($id_challenge) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("SELECT * FROM challenges WHERE id_challenge = :id_challenge");
        $consulta->bindParam(':id_challenge', $id_challenge);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function getStagesByChallenge($id_challenge, $id_user) {
        try {
            $con = Conexion::Conectar();
            $consulta = $con->prepare("
                SELECT c.id_stage, c.num_stage, c.name_stage, c.goal_stage, COALESCE(ur.completed, 0) AS completed, ur.start_date, ur.end_date
                FROM stages c
                LEFT JOIN user_stages ur ON c.id_stage = ur.id_stage AND ur.id_user = :id_user
                WHERE c.id_challenge = :id_challenge
            ");
            $consulta->bindParam(':id_challenge', $id_challenge, PDO::PARAM_INT);
            $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los retos: " . $e->getMessage());
        }
    }

    public function getAvailableChallenges($id_user) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("
            SELECT * 
            FROM challenges 
            WHERE id_challenge NOT IN (SELECT id_challenge FROM user_challenges WHERE id_user = :id_user)
        ");
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJoinedChallenges($id_user) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("
            SELECT c.* 
            FROM challenges c
            JOIN user_challenges uc ON c.id_challenge = uc.id_challenge
            WHERE uc.id_user = :id_user AND uc.completed = 0
        ");
        $consulta->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    //---------------Acciones Unirse, Mostrar, Salir-----------------------------
    public function joinChallenge($id_user, $id_challenge) {
        $con = Conexion::Conectar();
        try {
            // Verificar si el usuario ya está inscrito en el desafío
            $verificarInscripcion = $con->prepare("
                SELECT COUNT(*) FROM user_challenges WHERE id_user = :id_user AND id_challenge = :id_challenge
            ");
            $verificarInscripcion->execute([':id_user' => $id_user, ':id_challenge' => $id_challenge]);
            $inscrito = $verificarInscripcion->fetchColumn();
    
            if ($inscrito > 0) {
                // Si ya está inscrito, devolvemos un mensaje o false
                return "Ya estás inscrito en este desafío.";
            }
            // Iniciar transacción
            $con->beginTransaction();
            // Insertar al usuario en el desafío (tabla user_challenges)
            $consulta = $con->prepare("
                INSERT INTO user_challenges (id_user, id_challenge, completed, start_date)
                VALUES (:id_user, :id_challenge, 0, CURDATE())");
            $consulta->execute([':id_user' => $id_user, ':id_challenge' => $id_challenge]);
            // Obtener todas las etapas (stages) asociadas al desafío
            $consultarStages = $con->prepare("SELECT id_stage FROM stages WHERE id_challenge = :id_challenge");
            $consultarStages->execute([':id_challenge' => $id_challenge]);
            $stages = $consultarStages->fetchAll(PDO::FETCH_ASSOC);
    
            // Insertar registros en user_stages para cada etapa (stage)
            $queryUserStages = $con->prepare("
                INSERT INTO user_stages (id_user, id_stage, completed, start_date)
                VALUES (:id_user, :id_stage, 0, CURDATE())"
            );
            foreach ($stages as $stage) {
                $queryUserStages->execute([':id_user' => $id_user, ':id_stage' => $stage['id_stage']]);
            }
            // Confirmar la transacción
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $con->rollBack();
            echo "Error al unirse al desafío: " . $e->getMessage();
            return false;
        }
    }
    

    public function completeStage($id_user, $id_stage) {
        $con = Conexion::Conectar();
        
        try {
            // Iniciar una transacción para asegurar integridad
            $con->beginTransaction();
    
            // Actualizar el stage como completado
            $consulta = $con->prepare("
                UPDATE user_stages 
                SET completed = 1, end_date = NOW() 
                WHERE id_user = :id_user AND id_stage = :id_stage
            ");
            $consulta->execute([':id_user' => $id_user, ':id_stage' => $id_stage]);
    
            // Confirmar la transacción
            $con->commit();
            
            return true;
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $con->rollBack();
            echo "Error al completar el stage: " . $e->getMessage();
            return false;
        }
    }

    public function completeChallenge($id_user, $id_challenge) {
        $con = Conexion::Conectar();
        
        try {
            // Iniciar una transacción para asegurar integridad
            $con->beginTransaction();
    
            // Actualizar el stage como completado
            $consulta = $con->prepare("
                UPDATE user_challenges 
                SET completed = 1, end_date = NOW() 
                WHERE id_user = :id_user AND id_challenge = :id_challenge
            ");
            $consulta->execute([':id_user' => $id_user, ':id_challenge' => $id_challenge]);
    
            // Confirmar la transacción
            $con->commit();
            
            return true;
        } catch (PDOException $e) {
            // Revertir transacción en caso de error
            $con->rollBack();
            echo "Error al completar el challenge: " . $e->getMessage();
            return false;
        }
    }

    


    

    



} 
?>