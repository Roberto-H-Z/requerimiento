<?php

require_once 'conexion.php';

class ModeloAlumno {
    private $conexion;
    
    public function __construct() {
        $this->conexion = new Conexion();
    }
    
    public function agregarAlumno($datos) {
        try {
            // Verificar si el usuario ya existe
            $sqlCheck = "SELECT COUNT(*) FROM alumnos WHERE usuario = :usuario";
            $stmtCheck = $this->conexion->conectar()->prepare($sqlCheck);
            $stmtCheck->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmtCheck->execute();
            
            if ($stmtCheck->fetchColumn() > 0) {
                // Devolver un mensaje de error si el usuario ya existe
                return "error: El nombre de usuario ya está registrado.";
            }
    
            // Cambiamos el nombre del parámetro para evitar problemas con la ñ
            $sql = "INSERT INTO alumnos (nombre, apellidos, grado, grupo, estatus, usuario, contraseña) 
                    VALUES (:nombre, :apellidos, :grado, :grupo, :estatus, :usuario, :password)";
            
            $conexion = $this->conexion->conectar();
            $stmt = $conexion->prepare($sql);
            
            // Almacenar la contraseña hasheada en una variable primero
            $passwordHash = password_hash($datos["contraseña"], PASSWORD_DEFAULT);
            
            // Vinculamos todos los parámetros
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":grado", $datos["grado"], PDO::PARAM_STR);
            $stmt->bindParam(":grupo", $datos["grupo"], PDO::PARAM_STR);
            $stmt->bindParam(":estatus", $datos["estatus"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $passwordHash, PDO::PARAM_STR);
            
            // Ejecutamos y verificamos el resultado
            if($stmt->execute()) {
                return "ok";
            } else {
                return "error: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public function obtenerAlumnos() {
        $sql = "SELECT * FROM alumnos";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function actualizarEstatus($id, $estatus) {
        $sql = "UPDATE alumnos SET estatus = :estatus WHERE id = :id";
        $stmt = $this->conexion->conectar()->prepare($sql);
        $stmt->bindParam(":estatus", $estatus);
        $stmt->bindParam(":id", $id);
        
        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>