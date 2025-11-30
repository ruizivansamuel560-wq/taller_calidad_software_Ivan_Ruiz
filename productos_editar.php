<?php

include 'db_conexion.php'; 

$edit_id = $_GET['id'] ?? null;
$producto = [];
$tipos = [];

if (isset($conn) && $conn instanceof mysqli) {
    $tipos_result = $conn->query("SELECT id, nombre FROM tipos ORDER BY nombre ASC");
    if ($tipos_result) {
        while ($row = $tipos_result->fetch_assoc()) {
            $tipos[] = $row;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST" && $edit_id) {
        $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio, stock, tipo_id FROM productos WHERE id = ?");
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
        $stmt->close();

        if (!$producto) {
            close_db_connection($conn);
            header("Location: dashboard.php?view=productos&msg=" . urlencode("Producto no encontrado.") . "&type=danger");
            exit;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $tipo_id = $_POST['tipo_id'];

        if (!empty($nombre) && is_numeric($precio) && is_numeric($stock) && is_numeric($tipo_id)) {

            $stmt = $conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, tipo_id = ? WHERE id = ?");
            $stmt->bind_param("ssdiis", $nombre, $descripcion, $precio, $stock, $tipo_id, $id); 

            if ($stmt->execute()) {
                $message = " Producto **$nombre** actualizado correctamente.";
                $message_type = 'success';
            } else {
                $message = " Error al actualizar: " . $stmt->error;
                $message_type = 'danger';
            }
            $stmt->close();
            
            close_db_connection($conn);
            header("Location: dashboard.php?view=productos&msg=" . urlencode($message) . "&type=" . $message_type);
            exit;
        } else {
             $producto = $_POST;
             echo '<div class="alert alert-danger">Por favor, complete todos los campos requeridos con valores válidos.</div>';
        }
    }
}

if (empty($producto) && $_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($conn)) {
    close_db_connection($conn);
}
?>

<h1 class="content-title display-5 mb-4"><i class="bi bi-apple-fill me-2"></i> Editar Producto</h1>
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Editando: <?= htmlspecialchars($producto['nombre'] ?? 'Cargando...') ?></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="productos_editar.php">
            <input type="hidden" name="id" value="<?= $producto['id'] ?? '' ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Producto:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? '') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo_id" class="form-label fw-bold">Tipo:</label>
                    <select class="form-select" id="tipo_id" name="tipo_id" required>
                        <?php foreach ($tipos as $tipo): ?>
                            <option value="<?= $tipo['id'] ?>" 
                                <?= (isset($producto['tipo_id']) && $producto['tipo_id'] == $tipo['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tipo['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio" class="form-label fw-bold">Precio ($):</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($producto['precio'] ?? '') ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label fw-bold">Stock:</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?= htmlspecialchars($producto['stock'] ?? '') ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= htmlspecialchars($producto['descripcion'] ?? '') ?></textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Guardar Cambios</button>
                <a href="dashboard.php?view=productos" class="btn btn-outline-secondary"><i class="bi bi-x-lg me-1"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>