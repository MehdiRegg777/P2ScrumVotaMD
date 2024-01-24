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

        $pdo = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }

?>
        
<main>
    <section>
        <h1>Registrar Usuario</h1>
        <form method="post" action="">

            <div class="level-register">

            </div>
            <div id="notification-container"></div>
            <div id="notification-registrado"></div>

            <div class="buttons-registers">
                <div class="button-inicio">
                    <a href="index.php"><i class="fas fa-home"></i> volver Inicio</a>
                </div>
            </div>

        </form>
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
                    value: $("#phone").val()  // Puedes establecer el valor según la entrada del usuario
                }).hide(); 
                  // Opcionalmente oculta el campo si no quieres que sea visible en el formulario

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
if ($_SERVER["REQUEST_METHOD"] == "POST" || !empty($_POST)) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $city = $_POST["city"];
    $postal_code = $_POST["postal_code"];

    echo "<pre>".print_r($_POST,true)."</pre><br><br>";



} 
?>
</body>
</html>
