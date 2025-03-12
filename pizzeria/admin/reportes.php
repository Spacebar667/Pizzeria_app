<?php
session_start();
require '../config/db.php';

// Verificar si el admin está autenticado
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Obtener las ventas totales
$query = "SELECT SUM(total) AS total_ventas, COUNT(id) AS total_pedidos FROM pedidos WHERE estado = 'entregado'";
$result = $conn->query($query);
$datos = $result->fetch_assoc();

// Obtener los productos más vendidos
$query_pizzas = "SELECT p.nombre, COUNT(dp.pizza_id) AS cantidad FROM detalle_pedido dp 
                 JOIN pizzas p ON dp.pizza_id = p.id 
                 GROUP BY dp.pizza_id ORDER BY cantidad DESC LIMIT 5";
$result_pizzas = $conn->query($query_pizzas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">📊 Reportes de Ventas</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 shadow">
                    <h5>Total de Ventas: 💰 $<?php echo number_format($datos['total_ventas'], 2); ?></h5>
                    <h5>Total de Pedidos: 🛒 <?php echo $datos['total_pedidos']; ?></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 shadow">
                    <h5>📋 Top 5 Pizzas Más Vendidas</h5>
                    <ul class="list-group">
                        <?php while ($pizza = $result_pizzas->fetch_assoc()): ?>
                            <li class="list-group-item">
                                <?php echo $pizza['nombre']; ?> - 🛒 <?php echo $pizza['cantidad']; ?> pedidos
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">⬅ Volver</a>
    </div>
</body>
</html>
