<?php
include 'logger.php';

try {
    session_start();
    if (isset($_SESSION['usuario'])) {
        header("Location: dashboard.php");
    }
} catch (Exception $e) {
    logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Ocurrió un error al reconocer al usuario o al acceder a dashboard.php");
}
?>

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

<body id="register_body">
    <?php

    try {
        // Proxmox
        $hostname = "localhost";
        $dbname = "vota_DDBB";
        $username = "aws27";
        $pw = "aws27mehdidiego";

        // Local
        // $hostname = "localhost";
        // $dbname = "vota_DDBB";
        // $username = "tianleyin";
        // $pw = "Sinlove2004_";

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
        logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD");
        exit;
    }

    if (isset($_GET['token'])) {
        // Proxmox
        $hostname = "localhost";
        $dbname = "vota_DDBB";
        $username = "aws27";
        $pw = "aws27mehdidiego";

        // Local
        // $hostname = "localhost";
        // $dbname = "vota_DDBB";
        // $username = "tianleyin";
        // $password = "Sinlove2004_";

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT token_verified, user_id FROM user WHERE token = ?");
            $stmt->execute([$_GET['token']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $token_verified = $result['token_verified'];
            $user_id = $result['user_id'];

            if ($token_verified == 0) {

                $_SESSION['mensaje'] = "¡Email verificado correctamente! Ahora puedes iniciar sesión.";
                
                $updateStmt = $pdo->prepare("UPDATE user SET token_verified = 1 WHERE user_id = :user_id");
                $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $updateStmt->execute();

                logInfo("Token verificado correctamente", $_SERVER['PHP_SELF'], "TOKEN VERIFICADO");

                header("Location: login.php");
            } else {

                $_SESSION['mensaje'] = "¡Email ya verificado anteriormente!";

                logInfo("Token ya validado", $_SERVER['PHP_SELF'], "TOKEN USADO");

                header("Location: login.php");
            }


            // Cerrar la conexión a la base de datos
            unset($pdo);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            // Manejar el error según tus necesidades
            logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "CONSULTA SQL");
        }
    }

    ?>

    <main id="register_main">
        <section>
            <h1>Registrar Usuario</h1>
            <form method="post" id="registration-form">
                <?php
                if (empty($_POST)) {
                ?>
                    <div class="level-register">

                    </div>
                <?php
                }
                ?>

            </form>
            <div id="notification-container"></div>
            <div class="buttons-registers">
                <div class="button-inicio">
                    <?php
                    if (!empty($_POST)) {
                    ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                    <?php
                    }
                    ?>
                    <a href="index.php"><i class="fas fa-home"></i> Volver Inicio</a>
                </div>
            </div>
            <div id="notification-registrado"></div>
        </section>
    </main>
    <?php
    include_once("recursos/footer.php");
    ?>

    <script src='recursos/validaciones.js'></script>
    <script>
        $(document).ready(function() {

            $(".level-register").on("keydown", ".phone-input", function(event) {
                // Verificar si la tecla presionada es Tab, Enter o un clic
                if (event.key === 'Tab' || event.key === 'Enter') {
                    console.log("confirm-phone");

                    if (validarTelefono()) {

                        localStorage.setItem('phone', $(this).val());
                        document.cookie = "phone=" + $(this).val();

                        $(this).nextAll().remove();

                        var countryLabel = $("<label>")
                            .attr("for", "country")
                            .addClass("country-label")
                            .text("País:");

                        var countrySelect = $("<select>")
                            .attr({
                                id: "country",
                                name: "country"
                            })
                            .addClass("country-input")
                            .prop("required", true);

                        <?php
                        foreach ($resultados as $pais) {
                            echo 'countrySelect.append("<option value=\'" + \'' . htmlspecialchars($pais['name'], ENT_QUOTES, 'UTF-8') . '\' + "\' data-pref=\'" + \'' . htmlspecialchars($pais['name'], ENT_QUOTES, 'UTF-8') . '\' + "\'>" + \'' . htmlspecialchars($pais['name'], ENT_QUOTES, 'UTF-8') . '\' + "</option>");';
                        }
                        ?>

                        $(".phone-input").after(countryLabel, countrySelect);


                        var newContent = $("<div>")
                            .addClass("button-forum")
                            .append(
                                $("<a>")
                                .addClass("confirm-country")
                                .text("Continuar")
                            );

                        $(".button-forum").replaceWith(newContent);

                        $("#country").focus();

                        scrollTo(".country-label");
                    } else {
                        mostrarError("Número de teléfono no válido. Por favor, inténtelo de nuevo. Deben ser 9 dígitos");
                    }

                    // Detener la propagación del evento para evitar comportamientos predeterminados
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            $(".level-register").on("click"), ".phone-input",
                function(event) {
                    if (!$(this).is(":last-child")) {
                        $(this).nextAll().remove();
                    }
                    event.stopPropagation();
                }




            function validarTelefono() {
                var telefono = $("#phone").val();
                var expresionRegularTelefono = /^\d{9}$/;
                return expresionRegularTelefono.test(telefono);
            }

            function mostrarError(mensaje) {
                var notificacion = $("<div class='notificacion-error'></div>");
                var botonCerrar = $("<span class='cerrar-notificacion'>&times;</span>");
                notificacion.append(botonCerrar);
                notificacion.append("<span class='mensaje-notificacion'>" + mensaje + "</span>");
                $("#notification-container").prepend(notificacion);

                botonCerrar.click(function() {
                    notificacion.fadeOut(500, function() {
                        $(this).remove();
                    });
                });
            }



            function scrollTo(element) {
                $('html, body').animate({
                    scrollTop: $(element).offset().top
                }, 1200);
            }

        });

        function cerrarNotificacion() {
            document.getElementById('notification-registrado').innerHTML = '';
        }
    </script>

    <?php
    error_reporting(0);

    try {
        // Proxmox
        $hostname = "localhost";
        $dbname = "vota_DDBB";
        $username = "aws27";
        $pw = "aws27mehdidiego";

        // Local
        // $hostname = "localhost";
        // $dbname = "vota_DDBB";
        // $username = "tianleyin";
        // $pw = "Sinlove2004_";

        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        $notification_message = "Failed to get DB handle: " . $e->getMessage() . "\n";
        //echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        echo "<script>
            document.getElementById('notification-registrado').innerHTML = '<div class=\"notificacion-error2\"><span class=\"cerrar-notificacion2\" onclick=\"cerrarNotificacion()\">&times;</span><p class=\"mensaje-notificacion2\">$notification_message</p></div>';
        </script>";
        logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_POST)) {

        $username = $_COOKIE["username"];
        $password = $_COOKIE["contra"];
        $confirm_password = $_COOKIE["contra2"];
        $email = $_COOKIE["email"];
        $phone = $_COOKIE["phone"];
        $country = $_COOKIE["pais"];
        $city = $_COOKIE["ciudad"];
        $postal_code = $_COOKIE["postal_cod"];

        // $username = $_POST["username"];
        // $password = $_POST["password"];
        // $confirm_password = $_POST["confirm_password"];
        // $email = $_POST["email"];
        // $phone = $_POST["phone"];
        // $country = $_POST["country"];
        // $city = $_POST["city"];
        // $postal_code = $_POST["postal_code"];

        //echo "<pre>".print_r($_POST,true)."</pre><br><br>";

        // Obtener el phonecode del país seleccionado
        try {


            $phonecode_query = "SELECT id,phonecode FROM country WHERE name=:namename";
            $phonecode_stmt = $pdo->prepare($phonecode_query);
            $phonecode_stmt->bindParam(':namename', $country, PDO::PARAM_STR);
            $phonecode_stmt->execute();
            $phonecode_result = $phonecode_stmt->fetch(PDO::FETCH_ASSOC);
            if ($phonecode_result) {
                $phonecode = $phonecode_result['phonecode'];
                $country_id = $phonecode_result['id'];
                //echo $country_id;

                // Formar el número de teléfono completo
                $full_phone = "+" . $phonecode . $phone;
                // Verificar si el usuario ya existe en la tabla 'user'
                $user_exists_query = "SELECT user_id FROM user WHERE phone_number=:full_phone OR email=:email";
                $user_exists_stmt = $pdo->prepare($user_exists_query);
                $user_exists_stmt->bindParam(':full_phone', $full_phone, PDO::PARAM_STR);
                $user_exists_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $user_exists_stmt->execute();

                if ($user_exists_stmt->rowCount() > 0) {
                    $notification_message = "El usuario con ese número de teléfono o email ya existe.";
                    //echo "<br>El usuario con ese número de teléfono o email ya existe.";
                    echo "<script>
                        document.getElementById('notification-registrado').innerHTML = '<div class=\"notificacion-error2\"><span class=\"cerrar-notificacion2\" onclick=\"cerrarNotificacion()\">&times;</span><p class=\"mensaje-notificacion2\">$notification_message</p></div>';
                    </script>";
                    exit;
                }

                // Encriptar la contraseña
                $hashed_password = hash('sha512', $password);

                // Insertar el nuevo usuario en la tabla 'user'
                $insert_user_query = "INSERT INTO user (user_name, phone_number, email, `password`, registered, country_id, city, postal_code)
                                VALUES (:username, :full_phone, :email, :hashed_password, NOW(), :country_id, :city, :postal_code)";
                $insert_user_stmt = $pdo->prepare($insert_user_query);
                $insert_user_stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $insert_user_stmt->bindParam(':full_phone', $full_phone, PDO::PARAM_STR);
                $insert_user_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $insert_user_stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
                $insert_user_stmt->bindParam(':country_id', $country_id, PDO::PARAM_INT);
                $insert_user_stmt->bindParam(':city', $city, PDO::PARAM_STR);
                $insert_user_stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_INT);

                $insert_user_stmt->execute();

                if ($insert_user_stmt->errorCode() != 0) {
                    $error_info = $insert_user_stmt->errorInfo();
                    $notification_message = "Error al registrar el usuario: " . $error_info[2];
                    //echo "Error al registrar el usuario: " . $error_info[2]; 
                    logInfo($error_info, $_SERVER['PHP_SELF'], "Fallo Registro Usuario");
                } else {
                    $notification_message = "Usuario registrado con éxito.";
                    //echo "Usuario registrado con éxito.";
                    logInfo($notification_message . ": " . $_COOKIE['email'], $_SERVER['PHP_SELF'], "Registro Usuario");
                    echo "<script>
                document.getElementById('notification-registrado').innerHTML = '<div class=\"notificacion-error2\"><span class=\"cerrar-notificacion2\" onclick=\"cerrarNotificacion()\">&times;</span><p class=\"mensaje-notificacion2\">$notification_message</p></div>';
            </script>";

                    // Enviar email de verificación
                    $tiempo = time();
                    $palabraSecreta = "aws27";
                    $cadenaToken = $email . $time . $palabraSecreta;

                    $token_email = md5($cadenaToken);

                    $insert_user_token = "UPDATE user SET token = :token WHERE email = :email";
                    $insert_user_token_stmt = $pdo->prepare($insert_user_token);
                    $insert_user_token_stmt->bindParam(':token', $token_email, PDO::PARAM_STR);
                    $insert_user_token_stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $insert_user_token_stmt->execute();

                    if ($insert_user_token_stmt->errorCode() != 0) {
                        logInfo($error_info, $_SERVER['PHP_SELF'], "Fallo INSERT TOKEN");
                    } else {

                        // $mail = new PHPMailer();
                        // $mail->IsSMTP();
                        // $mail->Mailer = "smtp";
                        // $mail->SMTPDebug  = 0;
                        // $mail->SMTPAuth   = TRUE;
                        // $mail->CharSet = 'UTF-8';
                        // $mail->SMTPSecure = "tls";
                        // $mail->Port       = 587;
                        // $mail->Host       = "smtp.gmail.com";
                        // $mail->IsHTML(true);
                        // $mail->AddAddress($email);
                        // $mail->Subject = "Validación de Correo Electrónico";
                        // $mensaje = "¡Gracias por registrarte! Para validar tu dirección de correo electrónico, haz clic en el siguiente enlace:\n";
                        // // $mensaje .= "https://aws27.ieti.site/register.php?token=$token_email";
                        // $mail->MsgHTML($mensaje);
                        // if (!$mail->Send()) {
                        //     logInfo("Mail para verificar el registro fallido", $_SERVER['PHP_SELF'], "Mail Registro Fallido");
                        // } else {
                        //     logInfo("Mail para verificar el registro enviado correctamente", $_SERVER['PHP_SELF'], "Mail Registro Correcto");
                        // }

                        $asunto = "Validación de Correo Electrónico";
                        $mensaje = "¡Gracias por registrarte! Para validar tu dirección de correo electrónico, haz clic en el siguiente enlace:\n";
                        $mensaje .= "https://aws27.ieti.site/register.php?token=$token_email";
                        // $mensaje .= "http://0.0.0.0:8080/register.php?token=$token_email";

                        $cabeceras = 'From: aws27.ieti.site' . "\r\n";

                        // Enviar el correo electrónico
                        mail($email, $asunto, $mensaje, $cabeceras);

                        logInfo("Mail para verificar el registro enviado correctamente", $_SERVER['PHP_SELF'], "Mail Registro");
                    }
                }
            } else {
                $notification_message = "Error al obtener el phonecode del país.";
                //echo "Error al obtener el phonecode del país.";
                echo "<script>
                document.getElementById('notification-registrado').innerHTML = '<div class=\"notificacion-error2\"><span class=\"cerrar-notificacion2\" onclick=\"cerrarNotificacion()\">&times;</span><p class=\"mensaje-notificacion2\">$notification_message</p></div>';
            </script>";
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            logInfo($e->getMessage(), $_SERVER['PHP_SELF'], "Conexión BD (INSERT)");
            exit;
        }
        unset($pdo);
        unset($phonecode_stmt);
        unset($user_exists_stmt);
        unset($insert_user_stmt);
    }
    ?>

</body>

</html>