<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--box-shadow);
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
        }

        h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(72, 149, 239, 0.25);
        }

        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--box-shadow);
        }

        .modal-header {
            border-bottom: 1px solid #f0f0f0;
            padding: 1.5rem 1.5rem 1rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0;
            width: 100% !important;
            margin-top: 1.5rem;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        table.dataTable thead th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            padding: 12px 15px;
            border: none;
        }

        table.dataTable tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        table.dataTable tbody tr:last-child td {
            border-bottom: none;
        }

        table.dataTable tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 6px 12px;
            margin-left: 8px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .form-check-input {
            width: 2.5em;
            height: 1.2em;
            margin-top: 0.25em;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--success);
            border-color: var(--success);
        }

        .form-switch .form-check-input {
            transition: var(--transition);
        }

        .form-switch .form-check-input:not(:checked) {
            background-color: var(--danger);
            border-color: var(--danger);
            opacity: 0.6;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success);
        }

        .status-inactive {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--danger);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
            
            table.dataTable {
                display: block;
                width: 100%;
                overflow-x: auto;
            }
        }
        .topbar {
        margin-bottom: 2rem;
        }
    
        .navbar-dark {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .dropdown-item:active {
            background-color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .topbar {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>


<?php include_once 'vistas/modulos/header-alumnos.php'; ?>


<?php include_once 'vistas/modulos/logout-modal.php'; ?>


<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de Alumnos</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarAlumnoModal">
            <i class="fas fa-user-plus me-2"></i>Agregar Alumno
        </button>
    </div>

 

    <?php include_once 'vistas/modulos/modal-agregar-alumno.php'; ?>
    <?php include_once 'vistas/modulos/tabla-alumnos.php'; ?>

</div>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS para el manejo de ajax -->
<script src="ajax/alumnos.js" ></script>

</body>
</html>