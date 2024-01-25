<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="recursos/styles.css">
    <link rel="shortcut icon" href="recursos/logo.png" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <main id="login">
        <h1>Iniciar sesión</h1>
        <form method="post">
            <input type="email" name="email" placeholder="email" required>
            <br>
            <input type="password" name="password" placeholder="contraseña" required>
            <br>
            <button type="submit">Iniciar sesión</button>
        </form>
        <div class="button-inicio">
                <?php
                    if (!empty($_POST)) {
                ?>
                <a ><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                <?php
                    }
                ?>
                <a href="index.php"><i class="fas fa-home"></i> Volver Inicio</a>
            </div>    
    </main>
    <ul id="notification__list">
        <!-- todas las notificaciones -->
    </ul>
    <?php
include_once("common/footer.php")
?>


</body>
</html>

<?php

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Cambiar parámetros, conexión a BD
    $dsn = "mysql:host=localhost;dbname=vota_DDBB";
    $pdo = new PDO($dsn, 'tianleyin', 'Sinlove2004_');

    // Cambiar query
    $query = $pdo->prepare("SELECT * FROM user WHERE password = SHA2(:pwd, 512) AND email = :email");

    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':pwd', $password, PDO::PARAM_STR);
    
    $query->execute();
    
    $row = $query->fetch();

    // Cambiar parámetro dentro de $row
    if ($row) {
        session_start();
        $_SESSION["usuario"] = $row['user_id'];
        $_SESSION['nombre'] = $row['customer_name'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Añadir las notificaciones
        echo "<script> errorNotification('Los datos no coinciden en nuestra base de datos o no existen.'); </script>";
    }
}
?>