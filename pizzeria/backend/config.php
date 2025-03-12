<?php
$host = "localhost";
$user = "root";  // Usuario por defecto en XAMPP
$pass = "";      // Sin contraseña por defecto
$db = "pizzeria_db";

$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
