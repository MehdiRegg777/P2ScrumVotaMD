<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Encuesta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="recursos/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="recursos/logo.png" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<?php
include_once("recursos/header.php");
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
                    echo '<label for="startDate">Fecha de inicio:</label>';
                    echo '<p><input id="startDate" name="startDate" type="date" required></p>';
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
        <?php

include 'logger.php';

        try {
            $hostname = "localhost";
            $dbname = "vota_DDBB";
            $username = "aws27";
            $pw = "aws27mehdidiego";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST["question_title"];
                $startDate = $_POST["startDate"];
                $endDate = $_POST["endDate"];
                $stmt = $pdo->prepare("INSERT INTO poll (title_name, creation_date, `start_date`, end_date) VALUES (?,now(),?,?)");
                $stmt->execute([$title,$startDate,$endDate]);

                
                $queryPollID = $pdo->prepare("SELECT poll_id FROM poll WHERE title_name = :title order by creation_date desc LIMIT 1");
                $queryPollID->bindParam(':title', $title); 
                $queryPollID->execute();
                $resultID = $queryPollID->fetch(PDO::FETCH_ASSOC);
                if ($resultID !== false && $resultID !== null) {
                    for ($i = 1; $i <= 100; $i++) {
                        $optionName = "option" . $i;
                        
                        if (isset($_POST[$optionName] ) ) {
                            echo $optionName ."<br>-";  
                            echo $_POST[$optionName]."<br>-";   
                            $optionValue = $_POST[$optionName];
                            
                            $poll_id = $resultID['poll_id'];
                            $stmtInsert = $pdo->prepare("INSERT INTO answer (answer, poll_id) VALUES (?, ?)");
                            
                            $stmtInsert->execute([$optionValue, $poll_id]);
                            echo 'hasta aqui bien<br>';
                        }
                            
                    }
                }
                $cMail = $_COOKIE['email'];
                $mail = $pdo->prepare("SELECT user_id FROM user where email = :email");
                $mail->bindParam(':email', $cMail); 
                $mail->execute();
                $resultMail = $mail->fetch(PDO::FETCH_ASSOC);


                $queryPollID = $pdo->prepare("SELECT poll_id FROM poll WHERE title_name = :title order by creation_date desc LIMIT 1");
                $queryPollID->bindParam(':title', $title); 
                $queryPollID->execute();
                $resultID = $queryPollID->fetch(PDO::FETCH_ASSOC);
                $queryInsertPU = $pdo->prepare("INSERT INTO `poll-user` (user_id,poll_id) VALUES (?,?)");
                
                $queryInsertPU->execute([$resultMail['user_id'],$resultID['poll_id']]);
                $row = $queryInsertPU->fetch(PDO::FETCH_ASSOC);
                header("Location: dashboard.php?from=create");
            }

            unset($pdo);
            unset($querystr);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            logError($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (INSERT)");
            exit;
        }

        ?>
    </form>
    
</div>
<br><br><br><br>
<?php
include_once("recursos/footer.php");
?>
<script src="recursos/editOptions.js"></script>
</body>
</html>
