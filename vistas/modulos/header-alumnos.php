<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="background-color: var(--primary-color); padding: 0.5rem 1rem;">
        
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
                <span class="d-flex align-items-center ms-2 mt-4">
                    <i class="fas fa-graduation-cap fa-2x me-2" style="color: white;"></i>
                    <span style="color: white; font-weight: 600; font-size: 1.2rem;">Sistema Escolar</span>
                    <?php
                    // Mostrar el nombre de usuario si está en sesión
                    if(isset($_SESSION["usuario"])) {
                        echo '<h1 class="dropdown-header ms-5">¡Bienvenido ' . $_SESSION["usuario"] . '!</h1>';
                    }
                    ?>
                </span>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
            <!-- User profile and search -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                        <i class="fas fa-bell me-1"></i>
                        <span class="badge bg-danger rounded-pill">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow" style="border-radius: var(--border-radius); border: none; min-width: 280px;">
                        <h6 class="dropdown-header">Notificaciones</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center py-2" href="#">
                            <div class="me-3">
                                <div class="bg-primary text-white rounded-circle p-2" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                            </div>
                            <div>
                                <span class="fw-bold d-block">Nuevo alumno registrado</span>
                                <small class="text-muted">Hace 5 minutos</small>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas las notificaciones</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                        Opciones
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?ruta=configuracion">Configuración</a></li>
                        <!-- Other dropdown items -->
                        <li><a class="dropdown-item" href="index.php?ruta=login">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Add this overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
    /* Add this to ensure proper body layout */
    body {
        padding-top: 100px; /* Increased from 56px to give more space */
    }
    
    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Added shadow for visual separation */
    }
    
    /* Adjust container padding */
    .container {
        padding-top: 30px; /* Increased padding at the top */
    }
    
    /* Sidebar Styles */
    .sidebar {
        position: fixed; /* Changed to fixed */
        top: 70px; /* Adjusted to match new body padding */
        left: -250px;
        width: 250px;
        height: calc(100vh - 70px); /* Adjusted height */
        background-color: white;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        z-index: 1020;
        transition: all 0.3s ease;
        overflow-y: auto;
    }
    
    /* Responsive adjustments */
    @media (min-width: 768px) {
        .sidebar {
            left: 0;
        }
        
        .sidebar.toggled {
            left: -250px;
        }
        
        .container {
            margin-left: 250px;
            width: calc(100% - 250px);
            transition: all 0.3s ease;
        }
        
        .container.expanded {
            margin-left: auto;
            margin-right: auto;
            width: 95%;
            max-width: 1200px;
        }
    }
</style>
