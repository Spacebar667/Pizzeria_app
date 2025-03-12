<?php
session_start();
include("../backend/config.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id'];
    $total = 0;

    foreach ($_SESSION['carrito'] as $pizza_id) {
        $sql = "SELECT precio FROM pizzas WHERE id = $pizza_id";
        $result = $conn->query($sql);
        if ($row = $result->fetch_assoc()) {
            $total += $row['precio'];
        }
    }

    // Guardar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (usuario_id, total) VALUES ('$usuario_id', '$total')";
    if ($conn->query($sql) === TRUE) {
        $pedido_id = $conn->insert_id;

        foreach ($_SESSION['carrito'] as $pizza_id) {
            $sql = "INSERT INTO detalles_pedido (pedido_id, pizza_id, cantidad) VALUES ('$pedido_id', '$pizza_id', 1)";
            $conn->query($sql);
        }

        // Vaciar el carrito
        $_SESSION['carrito'] = [];
        header("Location: pedidos.php?success=1");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Confirmar Pedido</h2>
        <p>Total a pagar: $<?php echo array_sum(array_map(function ($id) use ($conn) {
            $res = $conn->query("SELECT precio FROM pizzas WHERE id = $id");
            return $res->fetch_assoc()['precio'];
        }, $_SESSION['carrito'])); ?></p>
        <form method="POST">
            <button type="submit" class="btn btn-success">Confirmar Pedido</button>
        </form>
    </div>
</body>
</html>
