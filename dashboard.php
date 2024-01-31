<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    header("HTTP/1.1 403 Forbidden");
    // include('/home/tianleyin/P2ScrumVotaMD/errors/errores403.php');
    
    // Para el proxmox:
    include('/var/www/html/P2ScrumVotaMD/errors/errores403.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="recursos/styles.css">  
    <link rel="shortcut icon" href="recursos/logo.png" />  
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body id="dashboard_body">
<?php
include_once("recursos/header.php");
?>
    <main id="dashboard">        
        <ul>
            <li><a href="list_polls.php">Ver mis encuestas</a></li>
            <li><a href="create_poll.php">Crear encuestas</a></li>
        </ul>
        
        <!--<a id="logout" href="logout.php">Cerrar sesión</a>-->
    </main>
    <?php
    if (isset($_GET["succ"])) {
        echo "<script>successfulNotification('Has iniciado sesión correctamente.');</script>";
    }
include_once("recursos/footer.php");
?>
</body>
</html>