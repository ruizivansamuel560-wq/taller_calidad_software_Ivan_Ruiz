<?php
$view = $_GET['view'] ?? 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Mini Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body { background-color: #f8f9fa; }
        #sidebar {
            height: 100vh;
            background-color: #212529;
            padding-top: 20px;
            position: fixed;
            min-width: 250px;
        }
        #sidebar .nav-link { color: #f8f9fa; padding: 15px; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { background-color: #343a40; color: #ffffff; }
        #main-content { margin-left: 250px; padding: 30px; }
        .dashboard-header { margin-bottom: 30px; }
    </style>
</head>
<body>

    <div class="d-flex">
        <div id="sidebar">
            <h4 class="text-white text-center mb-4">Mini Market Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'inicio') ? 'active' : '' ?>" href="dashboard.php?view=inicio">
                        <i class="bi bi-house-door-fill me-2"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'productos') ? 'active' : '' ?>" href="dashboard.php?view=productos">
                        <i class="bi bi-apple-fill me-2"></i> Gestión de Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($view == 'tipos') ? 'active' : '' ?>" href="dashboard.php?view=tipos">
                        <i class="bi bi-tags-fill me-2"></i> Gestión de Tipos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">
                        <a href="logout.php" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>

        <div id="main-content" class="flex-grow-1">
            <header class="dashboard-header d-flex justify-content-between align-items-center">
                <h1 class="display-4">DASHBOARD</h1>
            </header>

            <?php 
            include_once 'db_conexion.php'; 
            
            if ($view == 'inicio'): 
            ?>
                <div class="alert alert-info">¡Bienvenido al panel de administración!</div>
                
            <?php elseif ($view == 'productos'): ?>
                <?php 
                    include_once 'productos_index.php'; 
                ?>

            <?php elseif ($view == 'tipos'): ?>
                <?php 
                    include_once 'type_crud.php'; 
                ?>

            <?php else: ?>
                <div class="alert alert-warning">Vista no encontrada.</div>
            <?php endif; ?>

            <?php 
