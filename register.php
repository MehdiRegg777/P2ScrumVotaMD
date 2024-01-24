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
        
<main>
    <section>
        <h1>Registrar Usuario</h1>
        <form method="post" action="">
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
                <a href="register.php"><i class="fas fa-user-plus"></i> Nuevo usuario</a>
                <?php
                    }
                ?>
                <a href="index.php"><i class="fas fa-home"></i> Volver Inicio</a>
            </div>
        </div>
        <div id="notification-registrado"></div>
    </section>
</main>


<script src='recursos/validaciones.js'></script>
<script>            
$(document).ready(function () {

    $(".level-register").on("click", ".confirm-phone", function () {

if (validarTelefono()) {


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
        echo 'countrySelect.append("<option value=\'" + \'' . $pais['name'] . '\' + "\' data-pref=\'" + \'' . $pais['name'] . '\' + "\'>" + \'' . $pais['name'] . '\' + "</option>");';
    }

    ?> 

    $(".phone-input").after(countryLabel, countrySelect);

    $(".phone-input").prop("disabled", true);

      // Crear dinámicamente un input para phone
      var phoneInputField = $("<input>")
                .attr({
                    type: "text",
                    id: "phone",
                    name: "phone",
                    value: $("#phone").val()  
                }).hide(); 

                  $("form").append(phoneInputField);


    var newContent = $("<div>")
    .addClass("button-forum")
    .append(
        $("<a>")
            .addClass("volver-confirm-country")
            .text("Volver"),
        $("<a>")
            .addClass("confirm-country")
            .text("Continuar")
    );

    $(".button-forum").replaceWith(newContent);

    scrollTo(".country-label");
    $('div[class="level-register"]').listview('refresh');
    } else {
        mostrarError("Número de teléfono no válido. Por favor, inténtelo de nuevo. Deben ser 9 dígitos");
    }
    });

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
    
        botonCerrar.click(function () {
            notificacion.fadeOut(500, function () {
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
</script>
<?php
error_reporting(0);

try {
    $hostname = "localhost";
    $dbname = "vota_DDBB";
    $username = "aws27";
    $pw = "aws27mehdidiego";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
} catch (PDOException $e) {

    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_POST)) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $postal_code = $_POST["postal_code"];

    //echo "<pre>".print_r($_POST,true)."</pre><br><br>";

    // Obtener el phonecode del país seleccionado
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

            echo "<br>El usuario con ese número de teléfono o email ya existe.";
            exit;
        }

        // Encriptar la contraseña
        $hashed_password = hash('sha512', $password);

        // Insertar el nuevo usuario en la tabla 'user'
        $insert_user_query = "INSERT INTO user (user_name, phone_number, email, password, registered, country_id, city, postal_code)
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

            echo "Error al registrar el usuario: " . $error_info[2]; 
        } else {

            echo "Usuario registrado con éxito.";
        }

    } else {

        echo "Error al obtener el phonecode del país.";
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
