<?php
class Conexion {
    public static function Conectar(){
        // Datos de conexión
        $host = "localhost";
        $baseDeDatos = 'fitness_app';
        $usuario = 'root';
        $contrasena = "newpassword";

        try {
            // Crear la conexión con PDO
            $con = new PDO("mysql:host=$host;dbname=$baseDeDatos;charset=utf8", $usuario, $contrasena);

            // Configurar PDO para que lance excepciones en caso de error
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            // Manejar el error de conexión
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
?>