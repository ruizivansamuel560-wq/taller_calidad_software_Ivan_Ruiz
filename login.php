<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Mini Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/estilos.css" rel="stylesheet">
    <style>
        .login-bg {
            min-height: 100vh;
            background-color: var(--bs-light); 
        }
        .login-card {
             max-width: 400px;
             border: none;
        }
    </style>
</head>
<body class="bg-light">

    <div class="d-flex align-items-center justify-content-center login-bg p-3">
        <div class="card login-card bg-white shadow-lg p-4 p-md-5">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle display-4 text-primary mb-2"></i>
                <h2 class="fw-bold">Acceso de Administrador</h2>
                <p class="text-muted">Gestiona tus productos y tipos.</p>
            </div>
            
            <form action="dashboard.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-primary"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-primary"><i class="bi bi-key-fill"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg text-uppercase fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Ingresar
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary mt-2">
                        <i class="bi bi-house-door-fill me-2"></i> Volver a la Tienda
                    </a>
                </div>
            </form>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>