<?php
session_start();
include("../backend/config.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Agregar Pizza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $sql = "INSERT INTO pizzas (nombre, precio) VALUES ('$nombre', '$precio')";
    $conn->query($sql);
}

// Eliminar Pizza
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM pizzas WHERE id = $id";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM pizzas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pizzas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { margin-top: 20px; }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">🍕 Gestión de Pizzas</h2>
        <div class="card p-4 shadow">
            <h4>Agregar Nueva Pizza</h4>
            <form method="POST">
                <input type="text" name="nombre" placeholder="Nombre de la pizza" class="form-control mb-2" required>
                <input type="number" name="precio" placeholder="Precio" class="form-control mb-2" required>
                <button type="submit" class="btn btn-success">➕ Agregar Pizza</button>
            </form>
        </div>

        <h3 class="mt-4">📋 Lista de Pizzas</h3>
        <div class="row">
            <?php while ($pizza = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <h5><?php echo $pizza['nombre']; ?></h5>
                        <p>💰 Precio: $<?php echo $pizza['precio']; ?></p>
                        <a href="?eliminar=<?php echo $pizza['id']; ?>" class="btn btn-danger btn-sm">🗑 Eliminar</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>

