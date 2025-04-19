<table id="alumnosTable" class="display table">



    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Grado</th>
        <th>Grupo</th>
        <th>Estatus</th>
        <th>Usuario</th>
        <th>Acción</th>
    </tr>
    </thead>



    <tbody>
    <?php
    require_once 'controladores/alumno.controlador.php';
    $controlador = new ControladorAlumno();
    $alumnos = $controlador->ctrMostrarAlumnos();
    foreach ($alumnos as $alumno) {
        echo "<tr>
        <td>{$alumno['id']}</td>
        <td>{$alumno['nombre']}</td>
        <td>{$alumno['apellidos']}</td>
        <td>{$alumno['grado']}</td>
        <td>{$alumno['grupo']}</td>
        <td><span class='status-badge " . ($alumno['estatus'] == 'Activo' ? 'status-active' : 'status-inactive') . "'>{$alumno['estatus']}</span></td>
        <td>{$alumno['usuario']}</td>
        <td>
            <div class='form-check form-switch d-flex justify-content-center'>
                <input class='form-check-input cambiar-estatus' type='checkbox' role='switch' 
                    data-id='{$alumno['id']}' " . ($alumno['estatus'] == 'Activo' ? 'checked' : '') . ">
            </div>
        </td>
      </tr>";
    }
    ?>
    </tbody>


</table>