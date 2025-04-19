<?php


    require_once 'controladores/plantilla.controlador.php';
    require_once 'controladores/alumno.controlador.php';
    
    // Inicializar controladores
    $plantilla = new ControladorPlantilla();
    $alumno = new ControladorAlumno();

    // Verificar si hay una ruta específica
    if(isset($_GET['ruta'])) {
        $ruta = $_GET['ruta'];
        

        // Manejar la ruta de login
        if($ruta == 'login') {
            include 'vistas/login.php';
            return; // Detener la ejecución después de cargar la vista
        }

        // Manejar la ruta de dashboard (después de login)
        if($ruta == 'dashboard') {
            $plantilla->ctrPlantilla();
            return;
        }
        
        // Manejar la ruta de configuración
        if($ruta == 'configuracion') {
            include 'vistas/configuracion.php';
            return; // Detener la ejecución después de cargar la vista
        }
        
        // Manejar la ruta de agregar alumno
        if($ruta == 'agregar-alumno') {
            $alumno->ctrAgregarAlumno();
            return; // Importante: detener la ejecución después de manejar la solicitud AJAX
        }
        // Manejar la ruta de cambiar estatus
        else if($ruta == 'cambiar-estatus') {
            $alumno->ctrCambiarEstatus();
            return; // Importante: detener la ejecución después de manejar la solicitud AJAX
        }
        else {
            // Mostrar la plantilla por defecto si la ruta no coincide
            $plantilla->ctrPlantilla();
        }
    } else {
        // Mostrar la plantilla por defecto
        $plantilla->ctrPlantilla();
    }


    
?>