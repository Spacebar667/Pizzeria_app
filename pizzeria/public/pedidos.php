<?php
session_start();
include("../backend/config.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM pedidos WHERE usuario_id = '$usuario_id' ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Mis Pedidos</h2>
        <?php if (isset($_GET['success'])) { echo "<p class='text-success'>Pedido realizado con éxito.</p>"; } ?>
        <ul class="list-group">
            <?php while ($pedido = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <strong>Pedido #<?php echo $pedido['id']; ?></strong> - Total: $<?php echo $pedido['total']; ?> - 
                    Estado: <span class="badge bg-warning"><?php echo $pedido['estado']; ?></span> 
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
