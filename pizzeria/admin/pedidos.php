<?php
session_start();
include("../backend/config.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $sql = "UPDATE pedidos SET estado = '$estado' WHERE id = $id";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .badge-pendiente { background-color: orange; }
        .badge-proceso { background-color: blue; color: white; }
        .badge-entregado { background-color: green; color: white; }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">📦 Gestión de Pedidos</h2>
        <div class="row">
            <?php while ($pedido = $result->fetch_assoc()): ?>
                <div class="col-md-6">
                    <div class="card p-3 shadow">
                        <h5>Pedido #<?php echo $pedido['id']; ?> - 💰 $<?php echo $pedido['total']; ?></h5>
                        <p><strong>Estado:</strong> 
                            <span class="badge 
                                <?php 
                                    echo ($pedido['estado'] == 'pendiente') ? 'badge-pendiente' : 
                                         (($pedido['estado'] == 'en proceso') ? 'badge-proceso' : 'badge-entregado'); 
                                ?>">
                                <?php echo ucfirst($pedido['estado']); ?>
                            </span>
                        </p>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                            <select name="estado" class="form-select mb-2">
                                <option value="pendiente" <?php if ($pedido['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                                <option value="en proceso" <?php if ($pedido['estado'] == 'en proceso') echo 'selected'; ?>>En Proceso</option>
                                <option value="entregado" <?php if ($pedido['estado'] == 'entregado') echo 'selected'; ?>>Entregado</option>
                            </select>
                            <button type="submit" name="actualizar" class="btn btn-primary btn-sm">Actualizar</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>

