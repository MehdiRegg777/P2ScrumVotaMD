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
            session_start();
            if (isset($_SESSION["usuario"])) {
                $dbname = "vota_DDBB";
                $user = "aws27";
                $password = "aws27mehdidiego";
            
                try {
                    $dsn = "mysql:host=localhost;dbname=$dbname";
                    $pdo = new PDO($dsn, $user, $password);
                } catch (PDOException $e){
                    logError($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (CONEXIÓN)");
                }

                $query = $pdo -> prepare("SELECT title_name FROM poll");
                $query -> execute();

                // Error:
                $e= $query->errorInfo();
                if ($e[0]!='00000') {
                    logError($e[0], $_SERVER[''], 'ACCESO DE DATOS BD (ACCESO DATOS)');
                    die("Error accedint a dades: " . $e[2]);
                } 

                if (!empty($query)) {
                    foreach ($query as $row) {
                        echo "<ul>";
                        echo "<li>" . $row['title_name'] . "</li>";
                        echo "</ul>";
                    }
                } else {
                    echo "<p>No se encontraron encuestas.</p>";
                }
            } else {
                header("location: index.php");
            }
            ?>
        </section>
    </main>
    <?php include_once("recursos/footer.php") ?>
</body>
</html>