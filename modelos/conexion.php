<?php

class Conexion {
    
    private $host = "127.0.0.1";
    private $db = "alumnos";
    private $user = "root"; 
    private $pass = "";
    
    public function conectar() {
        try {
            $conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db,
                $this->user,
                $this->pass
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}
?>