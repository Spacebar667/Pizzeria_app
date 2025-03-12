<?php
require 'config/db.php';

if (isset($_POST['codigo'])) {
    $codigo = $conn->real_escape_string($_POST['codigo']);
    $query = "SELECT estado FROM pedidos WHERE id = '$codigo'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $pedido = $result->fetch_assoc();
        $estado = ucfirst($pedido['estado']);
    } else {
        $estado = "Pedido no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Pedido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">🔍 Consulta el Estado de tu Pedido</h2>
        <form method="POST">
            <input type="text" name="codigo" placeholder="Ingresa tu código de pedido" class="form-control mb-2" required>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>
        <?php if (isset($estado)): ?>
            <h3 class="mt-3">Estado: <?php echo $estado; ?></h3>
        <?php endif; ?>
    </div>
</body>
</html>
