<?php
include 'logger.php';
session_start();

// Verificar si se proporcionó un ID de encuesta en la URL
if (isset($_GET['poll_id']) && $_SESSION['usuario']) {
    $poll_id = $_GET['poll_id'];
    $user_id = $_SESSION['usuario'];

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

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
        $sql = "SELECT vote_option, COUNT(*) AS option_count FROM vote WHERE poll_id = :poll_id GROUP BY vote_option";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Inicializar un array asociativo para almacenar el recuento de opciones
        $optionCounts = [];

        // Iterar sobre los resultados y almacenar el recuento de cada opción en el array
        foreach ($result as $option) {
            $optionCounts[$option['vote_option']] = $option['option_count'];
        }
    } catch (PDOException $e) {
        logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (SELECT)");
    }

    try {
        // Conexión a la base de datos
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para obtener el título de la encuesta
        $stmt = $pdo->prepare("SELECT title_name FROM poll WHERE poll_id = :poll_id");
        $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener el título de la encuesta
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Guardar el título de la encuesta en una variable de sesión
        if ($result) {
            $_SESSION['title_name'] = $result['title_name'];
        } else {
            logInfo("El ID de encuesta proporcionado no existe en la BD", $_SERVER['PHP_SELF'], "Conexión BD (SELECT)");
            exit();
        }
    } catch (PDOException $e) {
        logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (INSERT)");
    }
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

<body id="body_detalles">
    <?php include_once('recursos/header.php'); ?>
    <main class="container">
        <?php
        echo "<h1>" . $_SESSION['title_name'] . "</h1>";
        ?>
        <div>
            <?php
            echo "<h2>Gráfico de Pastel</h2>";
            echo "<canvas id='pieChart' width='400' height='400'></canvas>";
            echo "<script>
                        var pieData = {
                            labels: " . json_encode(array_keys($optionCounts)) . ",
                            datasets: [{
                                data: " . json_encode(array_values($optionCounts)) . ",
                                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)'] // Colores para las opciones
                            }]
                        };
                        var pieCtx = document.getElementById('pieChart').getContext('2d');
                        var pieChart = new Chart(pieCtx, {
                            type: 'pie',
                            data: pieData,
                            options: {
                                responsive: false,
                                maintainAspectRatio: false
                            }
                        });
                      </script>";
            ?>
        </div>

        <!-- Div para el gráfico de barras -->
        <div>
            <?php
            // Generar gráfico de barras
            echo "<h2>Gráfico de Barras</h2>";
            echo "<canvas id='barChart' width='400' height='400'></canvas>";
            echo "<script>
            var barData = {
                labels: " . json_encode(array_keys($optionCounts)) . ",
                datasets: [{
                    label: 'Recuento de opciones',
                    data: " . json_encode(array_values($optionCounts)) . ",
                    backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(153, 102, 255)'] // Colores para las opciones
                }]
            };
            var barCtx = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(barCtx, {
                type: 'bar',
                data: barData,
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
          </script>";
            ?>
        </div>

        <!-- Apartado de opciones de visibilidad -->
        <div id="visibility">
            <h2>Enunciado:</h2>
            <form method="POST">
                <div>
                    <input type="radio" id="opcion1" name="enunciado" value="Oculto">
                    <label for="opcion1">Oculto</label>
                </div>
                <div>
                    <input type="radio" id="opcion2" name="enunciado" value="Privado">
                    <label for="opcion2">Privado</label>
                </div>
                <div>
                    <input type="radio" id="opcion3" name="enunciado" value="Público">
                    <label for="opcion3">Público</label>
                </div>
                <button type="submit">Cambiar</button>
            </form>
            <h2>Resultado:</h2>
            <form method="POST">
                <div>
                    <input type="radio" id="opcion1" name="resultado" value="Oculto">
                    <label for="opcion1">Oculto</label>
                </div>
                <div>
                    <input type="radio" id="opcion2" name="resultado" value="Privado">
                    <label for="opcion2">Privado</label>
                </div>
                <div>
                    <input type="radio" id="opcion3" name="resultado" value="Público">
                    <label for="opcion3">Público</label>
                </div>
                <button type="submit">Cambiar</button>
            </form>
        </div>
    </main>

    <?php include_once("recursos/footer.php") ?>
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
                    break;
            }

            // Ejecutar la consulta preparada
            $stmt->bindParam(':vPoll_id', $vPoll_id, PDO::PARAM_INT);
            $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (UPDATE)");
        }
    } else {
        logInfo("No se han cambiado las opciones de privacidad correctamente", $_SERVER['PHP_SELF'], "Cambio Poll (Privacidad)");
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
                    break;
            }

            // Ejecutar la consulta preparada
            $stmt->bindParam(':vResult_id', $vResult_id, PDO::PARAM_INT);
            $stmt->bindParam(':poll_id', $poll_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (UPDATE)");
        }
    } else {
        logInfo("No se han cambiado las opciones de privacidad correctamente", $_SERVER['PHP_SELF'], "Cambio Poll (Privacidad)");
    }
}
?>