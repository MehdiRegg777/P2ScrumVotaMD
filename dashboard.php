<?php
include 'logger.php';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body id="dashboard_body">
    <?php
    include_once("recursos/header.php");
    ?>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <h2>Condiciones de uso</h2>
            <p>Acepta las condiciones de uso para continuar.</p>
            <button id="acceptBtn">Aceptar</button>
            <button id="declineBtn">Rechazar</button>
        </div>
    </div>

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
    <script src="recursos/modal.js"></script>
</body>

</html>

<?php
// Proxmoxx
// $hostname = "localhost";
// $dbname = "vota_DDBB";
// $username = "aws27";
// $pw = "aws27mehdidiego";

// local
$hostname = "localhost";
$dbname = "vota_DDBB";
$username = "tianleyin";
$pw = "Sinlove2004_";

$user_id = $_SESSION['usuario'];

// Verificar si se ha hecho clic en el botón de aceptar
if (isset($_COOKIE['terms_condition_accepted'])) {

    $terms_condition = $_COOKIE['terms_condition_accepted'];

    echo $terms_condition;
    if ($terms_condition == 1) {
        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // Consulta SQL para actualizar el campo terms_condition_accepted a 1
            $updateStmt = $pdo->prepare("UPDATE user SET terms_condition_accepted = 1 WHERE user_id = :user_id");
            $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $updateStmt->execute();
    
            // Verificar si se ha actualizado correctamente
            if ($updateStmt->rowCount() > 0) {
                echo "<script>alert('Términos y condiciones aceptados correctamente.');</script>";
                $fechaExpiracion = time() - 3600 * 24 * 365;
                setcookie($terms_condition, null, $fechaExpiracion);
            } else {
                echo "<script>alert('Error al actualizar los términos y condiciones.');</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Consulta SQL para obtener user_id basado en el correo electrónico
        $sql = "SELECT terms_condition_accepted from user where user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
    
        // Obtener el resultado
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result['terms_condition_accepted'] == 0) {
            // Mostrar el modal para aceptar las condiciones
            echo '<script>
                $("#myModal").modal("show");
            </script>';
        } else {
            exit();
        }
    } catch (PDOException $e) {
        logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "CONSULTA SQL",);
    }


?>