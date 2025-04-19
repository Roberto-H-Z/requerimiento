<?php
require_once 'modelos/usuario.modelo.php';

class ControladorUsuario {
    
    public function ctrLogin() {
        if(isset($_POST["usuario"]) && isset($_POST["password"])) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            
            // Validar que los campos no estén vacíos
            if(empty($usuario) || empty($password)) {
                return ["status" => "error", "message" => "Todos los campos son requeridos."];
            }
            
            $modelo = new ModeloUsuario();
            $respuesta = $modelo->login($usuario, $password);
            
            if($respuesta["status"] == "success") {
                // Iniciar sesión
                session_start();
                $_SESSION["iniciarSesion"] = "ok";
                $_SESSION["id"] = $respuesta["alumno"]["id"];
                $_SESSION["usuario"] = $respuesta["alumno"]["usuario"];
                
                // Redirigir al dashboard
                header('Location: index.php?ruta=dashboard');
                exit;
            } else {
                // Devolver el error para mostrarlo en la página de login
                return $respuesta;
            }
        }
        return null;
    }
}
?>