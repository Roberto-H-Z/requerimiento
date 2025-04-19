$(document).ready(function () {
    // Inicializar DataTables
    $('#alumnosTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
        },
        responsive: true,
        columnDefs: [
            { orderable: false, targets: 7 }
        ]
    });

    // Manejar el envío del formulario con AJAX
    $('#formAgregarAlumno').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío por defecto

        // Deshabilitar el botón de envío para evitar múltiples envíos
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
        submitBtn.prop('disabled', true);

        $.ajax({
            url: 'index.php?ruta=agregar-alumno',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                // Restaurar botón
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);

                if(response.status === 'success') {
                    // Mostrar mensaje de éxito
                    alert(response.message);

                    // Cerrar el modal
                    $('#agregarAlumnoModal').modal('hide');

                    // Recargar la tabla para mostrar el nuevo alumno
                    location.reload();
                } else {
                    // Mostrar mensaje de error
                    alert(response.message || 'Error desconocido');
                }
            },
            error: function(xhr, status, error) {
                // Restaurar botón
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);

                // Mostrar información detallada del error
                console.error("Error AJAX:", xhr.responseText);
                alert('Error en la solicitud AJAX: ' + (xhr.responseText || error));
            }
        });
    });

    // Manejar el cambio de estatus con AJAX
    $('.cambiar-estatus').on('change', function() {
        const alumnoId = $(this).data('id');
        const nuevoEstatus = $(this).prop('checked') ? 'Activo' : 'Inactivo';
        
        $.ajax({
            url: 'index.php?ruta=cambiar-estatus',
            type: 'POST',
            data: {
                id: alumnoId,
                estatus: nuevoEstatus
            },
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    // Actualizar la badge de estatus en la tabla
                    const fila = $(`input[data-id="${alumnoId}"]`).closest('tr');
                    const celdaEstatus = fila.find('td:eq(5)');
                    
                    if(nuevoEstatus === 'Activo') {
                        celdaEstatus.html('<span class="status-badge status-active">Activo</span>');
                    } else {
                        celdaEstatus.html('<span class="status-badge status-inactive">Inactivo</span>');
                    }
                } else {
                    alert(response.message);
                    // Revertir el cambio en el switch si hubo un error
                    $(this).prop('checked', !$(this).prop('checked'));
                }
            },
            error: function() {
                alert('Error en la solicitud AJAX');
                // Revertir el cambio en el switch si hubo un error
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });

    // Funcionalidad para mostrar/ocultar contraseña
    $('#togglePassword').on('click', function() {
        const passwordField = $('#contraseña');
        const passwordFieldType = passwordField.attr('type');
        const icon = $(this).find('i');
        
        // Cambiar el tipo de campo entre password y text
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});