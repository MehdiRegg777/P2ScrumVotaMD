<?php
try{
// Conexion mysql
$hostname = "localhost";
$username = "aws27";
$pw = "aws27mehdidiego";
$dbname = "vota_DDBB";

$pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$titulo ='Encuesta - VotaYa';

$querySelectCount = $pdo->query("SELECT COUNT(mail_invite_id) as count FROM mail_invite where mail_sent <> 0 Limit 5");
$count = $querySelectCount->fetch(PDO::FETCH_ASSOC);


if($count) {
  $queryMails = $pdo->query("SELECT g.guest_email as email from mail_invite as mi INNER JOIN guest as g on mi.guest_id = g.guest_id where mi.mail_sent <>0 Limit 5");
  
  $to ='';
  
  foreach ($queryMails as $m -> $mv) {
    $to = ""+$mv ;
    $queryToken = $pdo->query("SELECT g.guest_token from mail_invite as mi INNER JOIN guest as g on mi.guest_id = g.guest_id where mi.mail_sent <>0 and g.guest_email = $mv Limit 1");
    $token = $queryToken->fetch(PDO::FETCH_ASSOC);
    $mensaje = "
    <html>
    <head>
      <title>Recordatorio Encuesta VotaYa</title>
    </head>
    <body>
      <hr>
      <h2>¡Bienvenido!</h2>
      <br><br>
      <h4>¡Has sido invitado para votar en una encuesta a través del portal VotaYa!</h4>
      <h4>Click <a href='https://aws27.ieti.site/votePage.php/?token=$token';>Aquí</a> para hacer una votacion</h4>
      <hr>
      <h6>VotaYa <br><br>Creadores:<br>Tianle:tianleyin8888@gmail.com<br>Diego:dpareslopez.cf@iesesteveterradas.cat</h6>
    </body>
    </html>
    ";
    $cabeceras  = "$to" . "\r\n";
    $cabeceras .= 'From: VotaYa' . "\r\n";
    $cabeceras .= 'Cc:' . "\r\n";
    $cabeceras .= 'Bcc:' . "\r\n";


    $to = rtrim($to,",");
    echo "$to, $titulo, $mensaje, $cabeceras";
    //mail($to,$titulo,$mensaje, $cabeceras);
    
  }
  
  
    
  

}else{
  echo 'No hay mails';
}

}catch(PDOException $e){
  echo "Error: " . $e->getMessage();
  logError($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (INSERT)");
  exit;
}