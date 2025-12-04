<?php
session_start();

// =========================
// CONEXIÓN
// =========================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_market_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
define('CRUD_REDIRECT', 'Location: type_crud.php');
// =========================
// CREAR / EDITAR
// =========================
if (isset($_POST['save_type'])) {

    $nombre = trim($_POST['nombre']);
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Validar duplicados
    $check = $conn->prepare("SELECT id FROM tipos WHERE nombre = ? AND id != ?");
    $check->bind_param("si", $nombre, $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['msg'] = "Ese tipo ya existe.";
        header(CRUD_REDIRECT);
        exit;
    }
    $check->close();

    if ($id > 0) {
        // EDITAR
        $stmt = $conn->prepare("UPDATE tipos SET nombre = ? WHERE id = ?");
        $stmt->bind_param("si", $nombre, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['msg'] = "✔ Tipo actualizado correctamente.";
    } else {
        // CREAR
        $stmt = $conn->prepare("INSERT INTO tipos (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->close();
        $_SESSION['msg'] = "✔ Tipo creado correctamente.";
    }

    header(CRUD_REDIRECT);
    exit;
}

// =========================
// ELIMINAR
// =========================
if (isset($_GET['delete'])) {
    $id_delete = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM tipos WHERE id = ?");
    $stmt->bind_param("i", $id_delete);

    try {
        $stmt->execute();
        $_SESSION['msg'] = "✔ Tipo eliminado correctamente.";
    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1451) {
            $_SESSION['msg'] = " No se puede eliminar este tipo porque tiene productos asociados.";
        } else {
            $_SESSION['msg'] = "Error: " . $e->getMessage();
        }
    }

    $stmt->close();
    header(CRUD_REDIRECT);
    exit;
}

// =========================
// LISTADO
// =========================
$result = $conn->query("SELECT * FROM tipos ORDER BY id ASC");

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Tipos</title>
<style>
body { font-family: Arial; padding: 20px; background: #f2f2f2; }
.container { width: 650px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
h2 { text-align: center; margin-top: 0; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
table, th, td { border: 1px solid #aaa; }
th, td { padding: 10px; text-align: center; }
input[type=text] { width: 100%; padding: 8px; }
button { padding: 7px 15px; cursor: pointer; }
.msg { padding: 10px; background: #e8ffe8; border: 1px solid #7acc7a; margin-bottom: 10px; border-radius: 5px; }
.btn-new { background: #2196f3; color: white; border: none; border-radius: 5px; }
.btn-edit { background: #ff9800; color: white; border: none; border-radius: 5px; }
.btn-delete { background: #f44336; color: white; border: none; border-radius: 5px; }
.btn-save { background: #4caf50; color: white; border: none; border-radius: 5px; }
</style>
</head>
<body>

<div class="container">

<h2>Gestión de Tipos de Producto</h2>

<?php if (isset($_SESSION['msg'])): ?>
    <div class="msg"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
<?php endif; ?>

<!-- BOTÓN CREAR NUEVO -->
<button class="btn-new" onclick="nuevoTipo()">+ Crear nuevo tipo</button>

<br><br>

<!-- FORMULARIO -->
<form method="POST" action="type_crud.php">
    <input type="hidden" name="id" id="id">

    <label>Nombre del tipo:</label>
    <input type="text" name="nombre" id="nombre" required>

    <br><br>
    <button class="btn-save" type="submit" name="save_type">Guardar</button>
</form>

<!-- TABLA -->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nombre'] ?></td>
        <td>
            <button class="btn-edit" onclick="editar(<?= $row['id'] ?>, '<?= $row['nombre'] ?>')">Editar</button>

            <a href="type_crud.php?delete=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar este tipo?');">
                <button class="btn-delete">Eliminar</button>
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</div>

<script>
function editar(id, nombre) {
    document.getElementById("id").value = id;
    document.getElementById("nombre").value = nombre;
}

function nuevoTipo() {
    document.getElementById("id").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("nombre").focus();
}
</script>

</body>
</html>
