<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 600px; margin-top: 50px; }
        .btn { width: 100%; margin-bottom: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🍕 Admin Pizzería</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="pedidos.php">📦 Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pizzas.php">🍕 Pizzas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">🚪 Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center mt-5">
        <h2 class="mb-4">Bienvenido al Panel de Administración</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="pedidos.php" class="btn btn-warning btn-lg">📦 Gestionar Pedidos</a>
            </div>
            <div class="col-md-6">
                <a href="pizzas.php" class="btn btn-info btn-lg">🍕 Gestionar Pizzas</a>
            </div>
            <div class="col-md-6">
                <a href="reportes.php" class="btn btn-secondary">📊 Ver Reportes</a>
            </div>
            <div class="col-md-6">
                <a href="promociones.php" class="btn btn-success">💸 Gestionar Promociones</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
