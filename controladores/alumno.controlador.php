<?php
require_once 'modelos/alumno.modelo.php';

class ControladorAlumno {
    public function ctrAgregarAlumno() {
        if(isset($_POST["nombre"])) {
            try {
                // Validar que todos los campos requeridos estén presentes
                foreach(['nombre', 'apellidos', 'grado', 'grupo', 'estatus', 'usuario', 'contraseña'] as $campo) {
                    if(!isset($_POST[$campo]) || empty($_POST[$campo])) {
                        throw new Exception("Todos los campos son requeridos");
                    }
                }

                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "apellidos" => $_POST["apellidos"],
                    "grado" => $_POST["grado"],
                    "grupo" => $_POST["grupo"],
                    "estatus" => $_POST["estatus"],
                    "usuario" => $_POST["usuario"],
                    "contraseña" => $_POST["contraseña"]
                );

                // Crear instancia del modelo
                $modelo = new ModeloAlumno();
                
                $respuesta = $modelo->agregarAlumno($datos);
                
                // Preparar respuesta JSON
                header('Content-Type: application/json');
                
                if($respuesta == "ok") {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Alumno agregado exitosamente'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Error al agregar el alumno: ' . $respuesta
                    ]);
                }
                exit;
            } catch(Exception $e) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error: ' . $e->getMessage()
                ]);
                exit;
            }
        } else {
            // Si no hay datos POST, devolver error
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'No se recibieron datos del formulario'
            ]);
            exit;
        }
    }

    public function ctrCambiarEstatus() {
        if(isset($_POST["id"]) && isset($_POST["estatus"])) {
            try {
                $id = $_POST["id"];
                $estatus = $_POST["estatus"];
                
                // Validar que el estatus sea válido
                if($estatus != "Activo" && $estatus != "Inactivo") {
                    throw new Exception("Estatus no válido");
                }
                
                $modelo = new ModeloAlumno();
                $respuesta = $modelo->actualizarEstatus($id, $estatus);
                
                header('Content-Type: application/json');
                
                if($respuesta == "ok") {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Estatus actualizado correctamente'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Error al actualizar el estatus'
                    ]);
                }
                exit;
            } catch(Exception $e) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }
    }

    public function ctrMostrarAlumnos() {
        $modelo = new ModeloAlumno();
        $alumnos = $modelo->obtenerAlumnos();
        return $alumnos;
    }
}
?>