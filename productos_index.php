<?php

$action = $_GET['action'] ?? 'listar'; 
$message = $_GET['msg'] ?? '';         
$message_type = $_GET['type'] ?? '';   
?>

<h1 class="content-title display-5 mb-4"><i class="bi bi-apple me-2"></i> Gestión de Productos</h1>

<?php if ($message): ?>
    <div class="alert alert-<?= $message_type ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($message) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <?php 
        switch ($action) {
            case 'crear':
                include 'productos_crear.php'; 
                break;
            case 'editar':
                include 'productos_editar.php'; 
                break;
            case 'listar':
            default:
                include 'productos_listar.php'; 
                break;
        }
        ?>
    </div>
</div>

<?php 
if ($action == 'listar' && isset($conn)) {
    close_db_connection($conn);
}
?>