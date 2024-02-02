<?php
include 'logger.php';

try {
    session_start();
    if (isset($_SESSION['usuario'])) {
        header("Location: dashboard.php");
    }
} catch (Exception $e) {
    logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Ocurrió un error al reconocer al usuario o al acceder a dashboard.php");
}

?>

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

<body id="login_body">
    <main id="login">
        <h1>Iniciar sesión</h1>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> Iniciar sesión</button>
            <br>
            <ul id="notis_login"></ul>
            <div class="button-inicio">
                <a href="index.php"><i class="fas fa-home"></i> Volver Inicio</a>
            </div>
        </form>
    </main>

    <?php
    include_once("recursos/footer.php")
    ?>

<script>
    function eliminarNotificacion(idNotificacion) {
        var elemento = document.getElementById(idNotificacion);
        if (elemento) {
            elemento.remove();
        }
    }
</script>

</body>

</html>

<?php

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        // Cambiar parámetros, conexión a BD
        $dsn = "mysql:host=localhost;dbname=vota_DDBB";

        // Proxmox
        // $hostname = "localhost";
        // $dbname = "vota_DDBB";
        // $username = "aws27";
        // $pw = "aws27mehdidiego";

                // Local
                $hostname = "localhost";
                $dbname = "vota_DDBB";
                $username = "tianleyin";
                $pw = "Sinlove2004_";
        $pdo = new PDO($dsn, $username, $pw);

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
            $_SESSION['nombre'] = $row['user_name'];
            logInfo("Login correcto: ".$email, $_SERVER['PHP_SELF'], "Inicio sesión correcto");
            header("Location: dashboard.php");
            exit();
        } else {
            // Añadir las notificaciones
            $mensajeError = "Usuario o contraseña incorrectos";

            // Generar un identificador único para la notificación (puedes usar una función hash, por ejemplo)
            $idNotificacion = md5(uniqid());
        
            // Imprimir el mensaje de error y la cruz para eliminar la notificación
            echo '<script>
                var ul = document.getElementById("notis_login");
                var li = document.createElement("li");
                li.id = "' . $idNotificacion . '";
                li.innerHTML = "' . $mensajeError . ' <span class=\"cerrar-notificacion\" onclick=\"eliminarNotificacion(\'' . $idNotificacion . '\')\">&times;</span>";
                ul.appendChild(li);
            </script>';        }
    } catch (Exception $e) {
        logInfo($e->getMessage() ,$_SERVER['PHP_SELF'],"CONSULTA SQL",);
    }
}
?>