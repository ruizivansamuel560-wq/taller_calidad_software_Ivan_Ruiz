<?php


include 'db_conexion.php';
$tipos = [];
if (isset($conn) && $conn instanceof mysqli) {
    $tipos_result = $conn->query("SELECT id, nombre FROM tipos ORDER BY nombre ASC");
    if ($tipos_result) {
        while ($row = $tipos_result->fetch_assoc()) {
            $tipos[] = $row;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $tipo_id = $_POST['tipo_id'];

    if (!empty($nombre) && is_numeric($precio) && is_numeric($stock) && is_numeric($tipo_id)) {
        
        $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, stock, tipo_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $nombre, $descripcion, $precio, $stock, $tipo_id);
        
        if ($stmt->execute()) {
            $message = "Producto **$nombre** creado correctamente.";
            $message_type = 'success';
        } else {
            $message = "Error al crear: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
        
        close_db_connection($conn);
        header("Location: dashboard.php?view=productos&msg=" . urlencode($message) . "&type=" . $message_type);
        exit;
    } 
}

?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="bi bi-plus-circle-fill me-2"></i> Registrar Nuevo Producto</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="productos_crear.php"> 
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre del Producto:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo_id" class="form-label fw-bold">Tipo:</label>
                    <select class="form-select" id="tipo_id" name="tipo_id" required>
                        <option value="">Seleccione el Tipo</option>
                        <?php foreach ($tipos as $tipo): ?>
                            <option value="<?= $tipo['id'] ?>"><?= htmlspecialchars($tipo['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio" class="form-label fw-bold">Precio ($):</label>
                    <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label fw-bold">Stock Inicial:</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> Guardar Producto</button>
                <a href="dashboard.php?view=productos" class="btn btn-outline-secondary"><i class="bi bi-x-lg me-1"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>