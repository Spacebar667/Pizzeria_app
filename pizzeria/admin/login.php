<?php
session_start();
include("../backend/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($_POST['password']);    

    $sql = "SELECT * FROM administradores WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
    function validarLogin() {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        if (email === "" || password === "") {
            alert("Todos los campos son obligatorios.");
            return false;
        }
        return true;
    }
</script>
</head>
<body>
    <div class="container mt-5">
        <h2>Login de Administrador</h2>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form method="POST" onsubmit="return validarLogin()">
            <input type="email" id="email" name="email" placeholder="Email" class="form-control mb-2" required>
            <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control mb-2" required>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
</body>
</html>
