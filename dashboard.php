<?php
include 'logger.php';
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"]) || $_SESSION["token_verified"] == 0) {
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
    include_once("recursos/footer.php");
    ?>
    <script src="recursos/modal.js"></script>
</body>

</html>

<?php
// Proxmoxx
$hostname = "localhost";
$dbname = "vota_DDBB";
$username = "aws27";
$pw = "aws27mehdidiego";

// local
// $hostname = "localhost";
// $dbname = "vota_DDBB";
// $username = "tianleyin";
// $pw = "Sinlove2004_";

$user_id = $_SESSION['usuario'];

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

    $conditions = $result['terms_condition_accepted'];
} catch (PDOException $e) {
    logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "CONSULTA SQL",);
}

// Verificar si el usuario ha aceptado los términos y condiciones
if (isset($_COOKIE['terms_condition_accepted']) && $_COOKIE['terms_condition_accepted'] == 1) {
    // Si el usuario ya ha aceptado los términos y condiciones, no mostrar el modal
    echo "show";
} else {
    echo '<script>
$("#myModal").modal("show");
</script>';
}

if (isset($_COOKIE['terms_condition_accepted']) && $_COOKIE['terms_condition_accepted']==1) {
    if ($conditions == 0) {
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
                echo "Correcto";
                $_SESSION['terms_condition_accepted'] = true;
            } else {
                echo "Incorrecto";
                $_SESSION['terms_condition_accepted'] = false;
            }
        } catch (PDOException $e) {
            logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (UPDATE)");
        }
    }
}

?>