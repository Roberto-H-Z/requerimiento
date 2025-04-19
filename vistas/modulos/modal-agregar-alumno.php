<!-- Modal -->
<div class="modal fade" id="agregarAlumnoModal" tabindex="-1" aria-labelledby="agregarAlumnoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAlumnoModalLabel">Agregar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarAlumno" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   placeholder="Ingrese el nombre" required
                                   pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$">
                            <div class="invalid-feedback">
                                El nombre no puede contener números ni caracteres especiales.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" 
                                   placeholder="Ingrese los apellidos" required
                                   pattern="^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$">
                            <div class="invalid-feedback">
                                Los apellidos no pueden contener números ni caracteres especiales.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="grado" class="form-label">Grado</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                <select class="form-select" id="grado" name="grado" required>
                                    <option value="" selected disabled>Grado</option>
                                    <option value="1">1°</option>
                                    <option value="2">2°</option>
                                    <option value="3">3°</option>
                                    <option value="4">4°</option>
                                    <option value="5">5°</option>
                                    <option value="6">6°</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione un grado válido.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="grupo" class="form-label">Grupo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-users"></i></span>
                                <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Ej: A" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            <select class="form-select" id="estatus" name="estatus" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                            <input type="text" class="form-control" id="usuario" name="usuario" 
                                   placeholder="Nombre de usuario único" required
                                   minlength="4">
                            <div class="invalid-feedback">
                                El usuario debe tener al menos 4 caracteres.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" 
                                   placeholder="Contraseña segura" required
                                   minlength="6">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="invalid-feedback">
                                La contraseña debe tener al menos 6 caracteres.
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="ajax/alumnos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formAgregarAlumno');

    // Validación de los campos de entrada
    const nombreInput = document.getElementById('nombre');
    const apellidosInput = document.getElementById('apellidos');

    nombreInput.addEventListener('input', function() {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (this.value && !regex.test(this.value)) {
            this.setCustomValidity('El nombre no puede contener números ni caracteres especiales.');
        } else {
            this.setCustomValidity('');
        }
    });

    apellidosInput.addEventListener('input', function() {
        const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
        if (this.value && !regex.test(this.value)) {
            this.setCustomValidity('Los apellidos no pueden contener números ni caracteres especiales.');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>