<?php 
include '../config/Conexion.php';

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


    //------Aqui Estará la Seccion de Desafios-------------//

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
    
    public function getIdChallenge($name_challenge) {
        $con = Conexion::Conectar();
        $consulta = $con->prepare("SELECT id_challenge FROM challenges WHERE name_challenge = :name_challenge LIMIT 1");
        $consulta->bindParam(':name_challenge', $name_challenge);
        $consulta->execute();
        return $consulta->fetchColumn();
    }
    

} 


?>