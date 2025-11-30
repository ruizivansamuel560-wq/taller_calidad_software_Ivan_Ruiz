<?php

$productos_result = false; 

if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    $sql_query = "
        SELECT p.id, p.nombre, p.precio, p.stock, t.nombre AS tipo_nombre
        FROM productos p
        JOIN tipos t ON p.tipo_id = t.id
        ORDER BY p.id DESC
    ";
    $productos_result = $conn->query($sql_query);
    
    if ($productos_result === false) {
        echo "<div class='alert alert-danger'>ERROR SQL: No se pudo cargar la lista. MySQL: " . $conn->error . "</div>";
    }
} else {
     echo "<div class='alert alert-danger'>ERROR: La conexión a la base de datos no está disponible.</div>";
}
?>

<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="bi bi-basket-fill me-2"></i> Inventario de Productos</h5>
    </div>
    <div class="card-body">
        <a href="dashboard.php?view=productos&action=crear" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle-fill me-2"></i> Registrar Nuevo Producto
        </a>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($productos_result && $productos_result->num_rows > 0): ?>
                        <?php while ($row = $productos_result->fetch_assoc()): ?>
                            <tr>
                                <th scope="row"><?= $row['id'] ?></th>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td><?= htmlspecialchars($row['tipo_nombre']) ?></td>
                                <td>$<?= number_format($row['precio'], 2) ?></td>
                                <td><?= $row['stock'] ?></td>
                                <td>
                                    <a href="dashboard.php?view=productos&action=editar&id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-primary me-2" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="productos_eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                       onclick="return confirm('¿Seguro que desea eliminar: <?= htmlspecialchars($row['nombre']) ?>?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay productos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>