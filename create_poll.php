<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="recursos/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="recursos/logo.png" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<?php
    
    try {
        $hostname = "localhost";
        $dbname = "vota_DDBB";
        $username = "aws27";
        $pw = "aws27mehdidiego";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $querystr = "SELECT name FROM country;";
        $continentes_result = $pdo->prepare($querystr);
        $continentes_result->execute();
    
        $resultados = $continentes_result->fetchAll(PDO::FETCH_ASSOC);

        unset($pdo);
        unset($querystr);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }

?>
<div class="pc_title">
   <h2>Crea tu encuesta!</h2> 
</div>

<div class="pc_main">
    <form method="post" action="">
        <fieldset>
            <legend>Rellena las opciones para tu encuesta</legend>
            <br>
            <div class="pc_options">
                <?php
                    echo '<label for="question_title">Titulo de la encuesta:</label>';
                    echo '<p><input id="question_title" name="question_title" type="text" required></p>';
                    echo '<label for="starDate">Fecha de inicio:</label>';
                    echo '<p><input id="startDate" name="starDate" type="date" required></p>';
                    echo '<label for="endDate">Fecha Final:</label>';
                    echo '<p><input id="endDate" name="endDate" type="date" required></p>';
                    echo '<label for="option1">Opcion 1:</label>';
                    echo '<p><input id="option1" name="option1" type="text" required></p>';
                    echo '<label for="option2">Opcion 2:</label>';
                    echo '<p><input id="option2" name="option2" type="text" required></p>';
                ?>
                
            
            </div>
            <div class="pc_buttons">
                <input id="addOption" type="button" value="Opcion Extra">
                <input id="quitOption" type="button" value="Borrar Ultima Opcion">
                <input type="submit">
            </div> 
        </fieldset>
        
    </form>
</div>
<script src="recursos/editOptions.js"></script>
</body>
</html>
