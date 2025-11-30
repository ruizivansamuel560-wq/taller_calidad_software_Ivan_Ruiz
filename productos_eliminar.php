<?php

include 'db_conexion.php'; 


$id_to_delete = $_GET['id'] ?? null;
$message = " Error: ID de producto no especificado.";
$message_type = 'danger';

if ($id_to_delete && is_numeric($id_to_delete)) {
    $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id_to_delete);

    if ($stmt->execute()) {
        $message = "Producto eliminado correctamente.";
        $message_type = 'success';
    } else {
        $message = "Error al eliminar el producto: " . $stmt->error;
        $message_type = 'danger';
    }
    $stmt->close();
}

close_db_connection($conn);

header("Location: dashboard.php?view=productos&msg=" . urlencode($message) . "&type=" . $message_type);
exit;
?>