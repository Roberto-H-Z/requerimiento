<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Instituto Dickens</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* Estilos generales */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Logo */
        .card img {
            max-width: 100px;
            margin-bottom: 0.5rem;
        }

        /* Textos destacados */
        .card h5 {
            color: #0033cc;
            font-weight: bold;
        }

        /* Botones */
        .btn-primary {
            background-color: #0033cc;
            border-color: #0033cc;
            color: white;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #002bb5;
            border-color: #002bb5;
        }

        /* Inputs */
        form .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            transition: box-shadow 0.3s ease;
            padding: 0.75rem 1rem;
        }

        form .form-control:focus {
            border-color: #0033cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 51, 204, 0.25);
        }

        /* Ajuste para el tamaño del login */
        .card {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            border-radius: 1rem;
            margin: auto;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        /* Validación estilo Bootstrap */
        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            color: #dc3545;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
            font-weight: 500;
            border: none;
            border-radius: 0.3rem;
        }

        #togglePassword {
            border-radius: 0 0.5rem 0.5rem 0;
        }
    </style>
</head>
<body class="bg-light">
    <div>
        <!-- Formulario de login -->
        <div class="card p-4 shadow-lg mx-auto" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;">
            <h5 class="fw-bold mb-3 text-primary">Consulta de Boleta, <span class="fw-normal text-secondary">Primaria</span></h5>
            <?php
            require_once 'controladores/usuario.controlador.php';
            $login = new ControladorUsuario();
            $respuesta = $login->ctrLogin();

            if($respuesta && $respuesta["status"] == "error") {
                echo '<div class="alert alert-danger text-center p-2">
                        ' . $respuesta["message"] . '
                      </div>';
            }
            ?>

            <form id="loginForm" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" 
                        placeholder="Escribe tu usuario" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" 
                            placeholder="Escribe tu contraseña" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-1"></i> INICIAR SESIÓN
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const icon = $(this).find('i');
                const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                icon.toggleClass('fa-eye fa-eye-slash');
            });
        });
    </script>
</body>
</html>