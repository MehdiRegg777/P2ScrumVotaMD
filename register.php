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
    // (1.1) Conectamos a MySQL (host, usuario, contraseña)
    $conn = mysqli_connect('localhost', 'aws27', 'aws27mehdidiego');

    // (1.2) Elegimos la base de datos con la que trabajaremos
    mysqli_select_db($conn, 'vota_DDBB');

    // (1.3) Obtenemos la lista de continentes para el menú desplegable
    $continentes_query = "select name from country;";
    $continentes_result = mysqli_query($conn, $continentes_query);

    if (!$continentes_result) {
        $message  = 'Consulta invàlida: ' . mysqli_error($conn) . "\n";
        $message .= 'Consulta realitzada: ' . $continentes_query;
        die($message);
    }
    



?>
        
<main>
    <section>
        <h1>Registrar Usuario</h1>
        <form method="post" >
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


    foreach ($continentes_result as $pais) {
        echo 'countrySelect.append("<option value=\'" + \'' . $pais['name'] . '\' + "\' data-pref=\'" + \'' . $pais['name'] . '\' + "\'>" + \'' . $pais['name'] . '\' + "</option>");';
    }

    ?> 

    $(".phone-input").after(countryLabel, countrySelect);

    $(".phone-input").prop("disabled", true);

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
    } else {
        mostrarError("Número de teléfono no válido. Por favor, inténtelo de nuevo.");
    }
    });

    function validarTelefono() {
        var telefono = $("#phone").val();
        var expresionRegularTelefono = /^\d{10}$/;
        return expresionRegularTelefono.test(telefono);
    }

    function mostrarError(mensaje) {
        var notificacion = $("<div class='notificacion-error'></div>");
        var botonCerrar = $("<span class='cerrar-notificacion'>&times;</span>");
        notificacion.append(botonCerrar);
        notificacion.append("<span class='mensaje-notificacion'>" + mensaje + "</span>");
        $("#notification-container").prepend(notificacion); // Cambio aquí
    
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

</body>
</html>
