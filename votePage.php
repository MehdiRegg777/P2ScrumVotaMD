<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="recursos/styles.css" rel="stylesheet">
    <title><?php 
    // Conexion mysql
    $hostname = "localhost";
    $username = "aws27";
    $pw = "aws27mehdidiego";
    $dbname = "vota_DDBB";

    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // parametro GET
    $poll_id = isset($_GET['poll_id']) ? $_GET['poll_id'] : 0;
    $queryPoll = $pdo->prepare("SELECT * FROM `poll-user` as PU Inner Join poll as P on PU.poll_id = P.poll_id WHERE PU.poll_id = :poll_id ");
    $queryPoll->bindParam(':poll_id', $poll_id); 
    $queryPoll->execute();
    $resultPoll = $queryPoll->fetch(PDO::FETCH_ASSOC);
    //add en titulo el nombre del poll
    echo $resultPoll['title_name'];

    ?>
    </title>
</head>
<body>
    <?php
    include("recursos/header.php");  
    try{
    // Conexion mysql
    $hostname = "localhost";
    $username = "aws27";
    $pw = "aws27mehdidiego";
    $dbname = "vota_DDBB";

    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // parametro GET
    $poll_id = isset($_GET['poll_id']) ? $_GET['poll_id'] : 0;

    // query
    $queryPoll = $pdo->prepare("SELECT * FROM `poll-user` as PU Inner Join poll as P on PU.poll_id = P.poll_id WHERE PU.poll_id = :poll_id ");
    $queryPoll->bindParam(':poll_id', $poll_id); 
    $queryPoll->execute();
    
    

    if ($queryPoll->rowCount() > 0) {
        // Encuesta encontrada
        echo "<div class=\"vp\">";
        $resultPoll = $queryPoll->fetch(PDO::FETCH_ASSOC);
        echo "<h2>{$resultPoll['title_name']}</h2>";
        $queryAnswers =$pdo->prepare("SELECT answer FROM `answer` WHERE poll_id = :poll_id ") ;
        $queryAnswers->bindParam(':poll_id', $poll_id); 
        $queryAnswers->execute();
        echo "<div class=\"answers\">";
        echo "<form method=\"post\">";
        foreach ($queryAnswers as $row) {
            echo "<input type=\"radio\" id=\"{$row['answer']}\" name=\"answers\">";
            echo "<label for=\"{$row['answer']}\">{$row['answer']}</label><br>";
        }
        echo "</form>";
        echo "</div>";
        echo "</div>";

    } else {
        // No se encuentra encuesta
        echo "Encuesta no encontrada.";
    }

    include("recursos/footer.php"); 
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    logError($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (INSERT)");
    exit;
}

    ?>
</body>
</html>