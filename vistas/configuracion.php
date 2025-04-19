<?php
require_once 'c:\xampp\htdocs\Requerimiento\modelos\conexion.php';

// Obtener el estado de los botones desde la base de datos
$conexion = new Conexion();
$db = $conexion->conectar();
$stmt = $db->query("SELECT id, estado FROM botones");
$botones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --text-color: #333333;
            --light-gray: #f8f9fa;
            --white: #ffffff;
            --success: #4CAF50;
            --danger: #F44336;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0,0,0,0.05);
            --transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <?php include_once 'modulos/header-alumnos.php'; ?>

    <div class="container">
        <h2>Configuración</h2>
        <p>Aquí puedes configurar las opciones de los botones.</p>
        
        <!-- Botones de configuración -->
        <?php foreach ($botones as $boton): ?>
        <div class="form-check form-switch">
            <input class="form-check-input toggle-button" type="checkbox" id="toggleBoton<?= $boton['id'] ?>" data-id="<?= $boton['id'] ?>" <?= $boton['estado'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="toggleBoton<?= $boton['id'] ?>">Habilitar Botón <?= $boton['id'] ?></label>
        </div>
        <?php endforeach; ?>

        <!-- Botones de acción -->
        <div class="mt-4">
            <?php foreach ($botones as $boton): ?>
            <button type="button" class="btn btn-primary action-button" id="boton<?= $boton['id'] ?>" <?= $boton['estado'] ? '' : 'disabled' ?> data-bs-toggle="popover" data-bs-content="Contenido del Botón <?= $boton['id'] ?>">
                <i class="fas fa-user-plus me-2"></i>Botón <?= $boton['id'] ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- AJAX para manejar el cambio de estado -->
    <script>
        $(document).ready(function() {
            // Initialize popovers
            $('[data-bs-toggle="popover"]').popover();

            $('.toggle-button').change(function() {
                var buttonId = $(this).data('id');
                var estado = $(this).is(':checked') ? 1 : 0;

                // Enable or disable the corresponding action button
                $('#boton' + buttonId).prop('disabled', !estado);

                $.ajax({
                    url: 'ajax/botones.php',
                    type: 'POST',
                    data: { id: buttonId, estado: estado },
                    success: function(response) {
                        alert('Estado del botón actualizado correctamente.');
                    },
                    error: function() {
                        alert('Error al actualizar el estado del botón.');
                    }
                });
            });
        });
    </script>
</body>
</html>