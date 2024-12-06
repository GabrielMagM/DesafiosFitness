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

} 
?>