<?php
require_once 'conexion.php';

class ModeloUsuario {
    private $conexion;
    
    public function __construct() {
        $this->conexion = new Conexion();
    }
    
    public function login($usuario, $password) {
        try {
            // Consultar el usuario en la tabla de alumnos
            $sql = "SELECT id, usuario, contraseña, estatus FROM alumnos WHERE usuario = :usuario";
            $stmt = $this->conexion->conectar()->prepare($sql);
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->execute();
            
            // Verificar si el usuario existe
            if($stmt->rowCount() > 0) {
                $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verificar si el estatus es activo
                if($alumno['estatus'] != 'Activo') {
                    return ["status" => "error", "message" => "Usuario inactivo. Contacte al administrador."];
                }
                
                // Verificar la contraseña
                if(password_verify($password, $alumno['contraseña'])) {
                    return ["status" => "success", "alumno" => $alumno];
                } else {
                    return ["status" => "error", "message" => "Contraseña incorrecta."];
                }
            } else {
                return ["status" => "error", "message" => "El usuario no existe."];
            }
        } catch(PDOException $e) {
            return ["status" => "error", "message" => "Error en la base de datos: " . $e->getMessage()];
        }
    }
}
?>