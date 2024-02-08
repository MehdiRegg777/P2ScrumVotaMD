<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de encuestas</title>
    <link rel="stylesheet" href="recursos/styles.css">
    <link rel="shortcut icon" href="recursos/logo.png" />
</head>

<body id="list_polls">
    <?php include_once('recursos/header.php'); ?>
    <main>
        <h1>Tus encuestas</h1>
        <section class="grid-polls">
            <?php
            include 'logger.php';
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            //Proxmoxx
            $hostname = "localhost";
            $dbname = "vota_DDBB";
            $username = "aws27";
            $pw = "aws27mehdidiego";


            $user_id = $_SESSION['usuario'];

            try {
                $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * from poll as p inner join `poll-user` as pu on p.poll_id = pu.poll_id where pu.user_id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $stmt->execute();

                // Obtener el resultado
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<ul>';
                foreach ($result as $row) {
                    echo '<li>' . $row['title_name'] . ' - ' . ' 
                    <a href="votePage.php?poll_id=' . $row['poll_id'] . '">Ver detalles</a>
                    </li>';
                }
                echo '</ul>';
            } catch (PDOException $e) {
                logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "CONSULTA SQL",);
            }

            // Cerrar la conexión
            unset($pdo);
            ?>
        </section>
    </main>
    <?php include_once("recursos/footer.php") ?>
</body>

</html><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de encuestas</title>
    <link rel="stylesheet" href="recursos/styles.css">
    <link rel="shortcut icon" href="recursos/logo.png" />
</head>

<body id="list_polls">
    <?php include_once('recursos/header.php'); ?>
    <main>
        <h1>Tus encuestas</h1>
        <section class="grid-polls">
            <?php
            include 'logger.php';
            session_start();
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

                $sql = "SELECT * from poll as p inner join `poll-user` as pu on p.poll_id = pu.poll_id where pu.user_id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $stmt->execute();

                // Obtener el resultado
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<ul>';
                foreach ($result as $row) {
                    echo '<li>' . $row['title_name'] . ' - ' . ' 
                    <a href="detalles_encuesta.php?poll_id=' . $row['poll_id'] . '">Ver detalles</a>
                    </li>';
                }
                echo '</ul>';
            } catch (PDOException $e) {
                logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "CONSULTA SQL",);
            }

            // Cerrar la conexión
            unset($pdo);
            ?>
        </section>
    </main>
    <?php include_once("recursos/footer.php") ?>
</body>

</html>