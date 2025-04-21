<?php
require_once 'c:\xampp\htdocs\Requerimiento\modelos\conexion.php';

// Obtener el estado de los botones desde la base de datos
$conexion = new Conexion();
$db = $conexion->conectar();
$stmt = $db->query("SELECT id, estado FROM botones");
$botones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Definir los PDFs para cada botón
$pdfs = [
    1 => 'docs/boleta_periodo.pdf',
    2 => 'docs/boleta_trimestral.pdf',
    3 => 'docs/observaciones.pdf'
];
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

                <div class="row align-items-center mb-5">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <img src="img/instituto.png" alt="Instituto Bilingüe Carlos Dickens" class="img-fluid" style="max-height: 160px;">
          </div>

          <div class="col-md-8">
            <h4 class="fw-bold fs-3">¿Por qué evaluamos?</h4>
            <p class="fs-5 text-justify">
              La educación consiste en educar cambiando en los alumnos que son traducidos en resultados de aprendizaje.
              Podemos expresarlo con un doble sentido:
            </p>
            <ul class="fs-5">
              <li>Adquisición de conocimientos, habilidades y actitudes.</li>
              <li>Evaluación de desempeño del proceso enseñanza-aprendizaje.</li>
            </ul>
          </div>
        </div>

        <h5 class="mt-4 fw-bold fs-4">Evaluación de las actitudes</h5>
        <p class="fs-5 text-justify">
          Una actitud es una disposición emocional que nos lleva a reaccionar favorable o desfavorablemente ante personas, cosas o situaciones.
          Esta disposición se manifiesta de manera individual y grupal, y su observación permite conocer el juicio que el alumno o alumna ha formado ante el profesor.
        </p>

        <hr class="my-5">

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
            <button type="button" class="btn btn-primary action-button" id="boton<?= $boton['id'] ?>" 
                    <?= $boton['estado'] ? '' : 'disabled' ?> 
                    data-pdf="<?= isset($pdfs[$boton['id']]) ? $pdfs[$boton['id']] : '' ?>"
                    data-title="Documento <?= $boton['id'] ?>">
                <i class="fas fa-file-pdf me-2"></i>Botón <?= $boton['id'] ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal PDF -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Documento</h5>
                    <div class="d-flex align-items-center">
                        <a id="downloadPdfLink" href="#" download class="btn btn-sm btn-outline-primary me-2" target="_blank">
                            <i class="fas fa-download me-1"></i> Descargar PDF
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                </div>
                <div class="modal-body p-0" style="height: 80vh;">
                    <iframe id="pdfViewer" src="" style="width:100%; height:100%;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- AJAX para manejar el cambio de estado -->
    <script>
        $(document).ready(function() {
            // Manejar el cambio de estado de los botones
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

            // Manejar el clic en los botones para mostrar el PDF
            $('.action-button').click(function() {
                var pdfUrl = $(this).data('pdf');
                var title = $(this).data('title');
                
                if (pdfUrl) {
                    // Actualizar el título del modal
                    $('#pdfModalLabel').text(title);
                    
                    // Actualizar la URL del iframe
                    $('#pdfViewer').attr('src', pdfUrl);
                    
                    // Actualizar el enlace de descarga
                    $('#downloadPdfLink').attr('href', pdfUrl);
                    
                    // Mostrar el modal
                    var pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
                    pdfModal.show();
                }
            });
        });
    </script>
</body>
</html>