<?php include("../backend/config.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Pizzería X</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<script src="js/carrito.js"></script>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Pizzería X</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Nuestro Menú</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM pizzas";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="Pizza">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                            <p class="card-text"><?php echo $row['descripcion']; ?></p>
                            <p class="card-text"><strong>$<?php echo $row['precio']; ?></strong></p>
                            <button class="btn btn-success" onclick="agregarAlCarrito(<?php echo $row['id']; ?>, '<?php echo $row['nombre']; ?>', <?php echo $row['precio']; ?>)">🛒 Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
