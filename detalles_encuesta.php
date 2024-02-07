<?php
include 'logger.php';
session_start();

// Verificar si se proporcionó un ID de encuesta en la URL
if (isset($_GET['poll_id']) && $_SESSION['usuario']) {
    $poll_id = $_GET['poll_id'];
    $user_id = $_SESSION['usuario'];

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

    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    $sql = "SELECT * FROM poll WHERE poll_id = :poll_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
    $stmt->execute();

    // Procesar los resultados y mostrar las estadísticas

} else {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Encuesta</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="recursos/styles.css">
    <link rel="shortcut icon" href="recursos/logo.png" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>Más Detalles</h1>
    <div>
        <canvas id="graficoPastel"></canvas>
    </div>

    <!-- Div para el gráfico de barras -->
    <div>
        <canvas id="graficoBarras"></canvas>
    </div>

    <!-- Apartado de opciones de visibilidad -->
    <div>
        <form method="POST">
            <h2>Enunciado:</h2>
            <input type="radio" id="opcion1" name="enunciado" value="Oculto">
            <label for="opcion1">Oculto</label>
            <input type="radio" id="opcion2" name="enunciado" value="Privado">
            <label for="opcion2">Privado</label>
            <input type="radio" id="opcion3" name="enunciado" value="Público">
            <label for="opcion3">Público</label>
            <button type="submit">Cambiar</button>
        </form>
        <form method="POST">
            <h2>Resultado</h2>
            <input type="radio" id="opcion1" name="resultado" value="Oculto">
            <label for="opcion1">Oculto</label>
            <input type="radio" id="opcion2" name="resultado" value="Privado">
            <label for="opcion2">Privado</label>
            <input type="radio" id="opcion3" name="resultado" value="Público">
            <label for="opcion3">Público</label>
            <button type="submit">Cambiar</button>
        </form>
    </div>
    <script src="recursos/graficos.js"></script>
</body>

</html>

<?php
    // Añadir logica para cambiar el valor en la tabla poll

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha seleccionado una opción
        if (isset($_POST["enunciado"])) {
            // Obtener el valor seleccionado
            $enunciado = $_POST["enunciado"];
            
            // Realizar la conexión a la base de datos
            try {
                $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // Actualizar el valor de vPoll_id en la tabla poll
                $sql = "UPDATE poll SET vPoll_id = :vPoll_id WHERE poll_id = :poll_id";
                $stmt = $pdo->prepare($sql);
                
                // Determinar el valor de vPoll_id según la opción seleccionada
                switch ($enunciado) {
                    case "Oculto":
                        $vPoll_id = 0;
                        break;
                    case "Privado":
                        $vPoll_id = 1;
                        break;
                    case "Público":
                        $vPoll_id = 2;
                        break;
                    default:
                        // Opción no válida
                        // Puedes manejar esto de acuerdo a tus necesidades
                        break;
                }
    
                // Ejecutar la consulta preparada
                $stmt->bindParam(':vPoll_id', $vPoll_id, PDO::PARAM_INT);
                $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
                $stmt->execute();
                
                // Mensaje de éxito
                echo "Se actualizó vPoll_id correctamente.";
            } catch (PDOException $e) {
                // Manejar cualquier error de la base de datos
                // logInfo
            }
        } else {
            // logInfo
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha seleccionado una opción
        if (isset($_POST["resultado"])) {
            // Obtener el valor seleccionado
            $resultado = $_POST["resultado"];
            
            // Realizar la conexión a la base de datos
            try {
                $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // Actualizar el valor de vResult_id en la tabla poll
                $sql = "UPDATE poll SET vResult_id = :vResult_id WHERE poll_id = :poll_id";
                $stmt = $pdo->prepare($sql);
                
                // Determinar el valor de vResult_id según la opción seleccionada
                switch ($resultado) {
                    case "Oculto":
                        $vResult_id = 0;
                        break;
                    case "Privado":
                        $vResult_id = 1;
                        break;
                    case "Público":
                        $vResult_id = 2;
                        break;
                    default:
                        // Opción no válida
                        // Puedes manejar esto de acuerdo a tus necesidades
                        break;
                }
    
                // Ejecutar la consulta preparada
                $stmt->bindParam(':vResult_id', $vResult_id, PDO::PARAM_INT);
                $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
                $stmt->execute();
                
            } catch (PDOException $e) {
                // Manejar cualquier error de la base de datos
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Si no se seleccionó ninguna opción, mostrar un mensaje de error
        }
    }
?>