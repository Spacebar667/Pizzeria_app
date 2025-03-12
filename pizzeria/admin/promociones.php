<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['crear'])) {
    $codigo = strtoupper($conn->real_escape_string($_POST['codigo']));
    $descuento = $conn->real_escape_string($_POST['descuento']);
    $query = "INSERT INTO promociones (codigo, descuento) VALUES ('$codigo', '$descuento')";
    $conn->query($query);
}

$query = "SELECT * FROM promociones";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Promociones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">💸 Gestión de Promociones</h2>
        <div class="card p-4 shadow">
            <h4>Agregar Nueva Promoción</h4>
            <form method="POST">
                <input type="text" name="codigo" placeholder="Código de descuento" class="form-control mb-2" required>
                <input type="number" name="descuento" placeholder="Porcentaje de descuento" class="form-control mb-2" required>
                <button type="submit" name="crear" class="btn btn-success">➕ Agregar Promoción</button>
            </form>
        </div>

        <h3 class="mt-4">📋 Promociones Actuales</h3>
        <ul class="list-group">
            <?php while ($promo = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    Código: <strong><?php echo $promo['codigo']; ?></strong> - 🔥 <?php echo $promo['descuento']; ?>% de descuento
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
