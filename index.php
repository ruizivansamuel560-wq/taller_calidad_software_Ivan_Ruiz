<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Market - Frescura a tu puerta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body class="bg-light"> 
    
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">
                    <i class="bi bi-tree-fill me-2 text-primary"></i>Mini Market
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#productos">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#ofertas">Ofertas</a></li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-admin ms-lg-3 px-3 py-2" href="login.php">
                                <i class="bi bi-person-fill-lock me-1"></i> Administrar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero" class="d-flex align-items-center justify-content-center text-center">
            <div class="container py-5 my-5">
                <h1 class="display-3 mb-3">
                    La Frescura del Campo, Directo a Ti
                </h1>
                <p class="lead mb-4 text-secondary">
                    Frutas, verduras y más. Calidad garantizada, precios justos.
                </p>
                <a href="#productos" class="btn btn-lg btn-primary shadow-sm px-5 py-3 text-uppercase">
                    Explorar Productos <i class="bi bi-arrow-down-circle-fill ms-2"></i>
                </a>
            </div>
        </section>
        
        <section id="productos" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 section-title">
                    <i class="bi bi-basket3-fill me-2"></i> Nuestros Productos Frescos
                </h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="img/manzana.jpg" class="card-img-top" alt="Manzanas Rojas">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Manzana Roja</h5>
                                <p class="card-text flex-grow-1">Dulces y crujientes. Ideales para snacks y postres.</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price">$3.50 / Kg</span>
                                    <button class="btn btn-success btn-sm"><i class="bi bi-cart-plus-fill me-1"></i> Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="img/tomate.jpg" class="card-img-top" alt="Tomates">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Tomate Larga Vida</h5>
                                <p class="card-text flex-grow-1">Perfectos para ensaladas y salsas frescas.</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price">$2.80 / Kg</span>
                                    <button class="btn btn-success btn-sm"><i class="bi bi-cart-plus-fill me-1"></i> Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col">
                        <div class="card h-100 product-card">
                            <img src="img/lechuga.jpg" class="card-img-top" alt="Lechuga">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Lechuga Crespa</h5>
                                <p class="card-text flex-grow-1">Base indispensable para cualquier plato.</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="card-price">$1.50 / Und</span>
                                    <button class="btn btn-success btn-sm"><i class="bi bi-cart-plus-fill me-1"></i> Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ofertas" class="py-5 cta-section">
            <div class="container text-center py-5">
                 <h2 class="display-5 mb-3">
                    <i class="bi bi-tags-fill me-2"></i> ¡Ofertas Exclusivas de la Semana!
                </h2>
                <p class="lead mb-4">
                    Aprovecha nuestros precios especiales en productos seleccionados.
                </p>
                <a href="#productos" class="btn btn-warning btn-lg shadow-sm px-5 py-3 text-uppercase fw-bold">
                    ¡Ver Descuentos! <i class="bi bi-arrow-right-short ms-2"></i>
                </a>
            </div>
        </section>
        
        </main>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Mini Market. Todos los derechos reservados.</p>
            <div class="mt-2">
                <a href="#" class="mx-2"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#" class="mx-2"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#" class="mx-2"><i class="bi bi-twitter fs-4"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>