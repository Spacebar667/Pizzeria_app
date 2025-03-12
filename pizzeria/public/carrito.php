<?php
session_start();
include("../backend/config.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar pizza al carrito
if (isset($_GET['id'])) {
    $pizza_id = $_GET['id'];
    $_SESSION['carrito'][] = $pizza_id;
    header("Location: carrito.php");
}

// Eliminar del carrito
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['carrito'][$index]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    header("Location: carrito.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Carrito de Compras</h2>
        <ul class="list-group">
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $index => $pizza_id) {
                $sql = "SELECT * FROM pizzas WHERE id = $pizza_id";
                $result = $conn->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $total += $row['precio'];
                    echo "<li class='list-group-item'>{$row['nombre']} - $ {$row['precio']}
                            <a href='carrito.php?remove=$index' class='btn btn-danger btn-sm float-end'>Eliminar</a>
                          </li>";
                }
            }
            ?>
        </ul>
        <h4 class="mt-3">Total: $<?php echo $total; ?></h4>
        <a href="checkout.php" class="btn btn-success mt-3">Proceder al Pago</a>
    </div>
</body>
</html>
