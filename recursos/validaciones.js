$(document).ready(function () {

    var userLabel = $("<label>")
        .attr("for", "username")
        .addClass("user-label")
        .text("Usuario:");

    // Crear el input de usuario
    var userInput = $("<input>")
        .attr({
            type: "text",
            id: "username",
            name: "username"
        })
        .addClass("user-input")
        .prop("required", true);

    // Crear el botón de continuar
    var continueButton = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("confirm-username")
                .text("Continuar")
        );

    // Agregar label, input y botón al div con la clase "level-register"
    $(".level-register").append(userLabel, userInput, continueButton);

    $(".level-register").on("click", ".confirm-username", function () {
        
        if (validarUsuario()) {
            var label = $("<label>")
                .attr("for", "password")
                .addClass("password-label")
                .text("Contraseña:");

            // Crear el input de contraseña
            var input = $("<input>")
                .attr({
                    type: "password",
                    id: "password",
                    name: "password"
                })
                .addClass("password-input")
                .prop("required", true);

            // Agregar label e input al body
            $("form .user-input").after(label, input);
            $(".user-input").prop("disabled", true);


            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-password-button")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".password-label");
        } else {
            mostrarError("Usuario no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-password-button", function () {
        $(".user-input").prop("disabled", false);
        $(".password-label").remove();
        $(".password-input").remove();

        var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-username")
                    .text("Continuar")
            );

        $(".button-forum").replaceWith(newContent);
        scrollTo(".user-label");
    });
    
    $(".level-register").on("click", ".confirm-password-button", function () {
        if (validarContraseña()) {
            var confirmLabel = $("<label>")
            .attr("for", "confirm_password")
            .addClass("confirm-password-label")
            .text("Confirmar Contraseña:");
    
        // Crear el input de confirmar contraseña
        var confirmInput = $("<input>")
            .attr({
                type: "password",
                id: "confirm_password",
                name: "confirm_password"
            })
            .addClass("confirm-password-input")
            .prop("required", true);
    
        // Agregar label e input al div con la clase "level-register"
        $(".password-input").after(confirmLabel, confirmInput);            
        $(".password-input").prop("disabled", true);



            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-confirm-password-button")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".confirm-password-label");
        } else {
            mostrarError("Contraseña no válida. La contraseña debe tener una longitud mínima de 8 caracteres e incluir al menos una letra mayúscula, una letra minúscula y un número. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-confirm-password-button", function () {
        $(".password-input").prop("disabled", false);

        $(".confirm-password-label").remove();
        $(".confirm-password-input").remove();
        var newContent = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("volver-confirm-password-button")
                .text("Volver"),
            $("<a>")
                .addClass("confirm-password-button")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);

        scrollTo(".password-label");

    });

    $(".level-register").on("click", ".confirm-confirm-password-button", function () {
        if (validarConfirmacionContraseña()) {
            // Crear el label de correo electrónico
            var emailLabel = $("<label>")
            .attr("for", "email")
            .addClass("email-lebel")
            .text("Correo Electrónico:");

            // Crear el input de correo electrónico
            var emailInput = $("<input>")
            .attr({
                type: "email",
                id: "email",
                name: "email"
            })
            .addClass("email-input")
            .prop("required", true);

            // Agregar label e input al div con la clase "level-register"
            $(".confirm-password-input").after(emailLabel, emailInput);

            $(".confirm-password-input").prop("disabled", true);
            
            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-email")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-email")
                    .text("Continuar")
            );
            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);
            scrollTo(".email-lebel");
        } else {
            mostrarError("La Contraseña no coincide. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-email", function () {
        $(".confirm-password-input").prop("disabled", false);

        $(".email-lebel").remove();
        $(".email-input").remove();

        var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-confirm-password-button")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

        scrollTo(".confirm-password-label");

    });


    $(".level-register").on("click", ".confirm-email", function () {

        if (validarCorreoElectronico()) {

            // Crear el label de teléfono
            var phoneLabel = $("<label>")
            .attr("for", "phone")
            .addClass("phone-label")
            .text("Teléfono (Sin codigo del país):");

            // Crear el input de teléfono
            var phoneInput = $("<input>")
                .attr({
                    type: "tel",
                    id: "phone",
                    name: "phone"
                })
                .addClass("phone-input")
                .prop("required", true);

            // Agregar label e input al div con la clase "level-register"
            $(".email-input").after(phoneLabel, phoneInput);

            $(".email-input").prop("disabled", true);


            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-phone")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-phone")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".phone-level");
        } else {
            mostrarError("Correo electrónico no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-phone", function () {

        $(".email-input").prop("disabled", false);

        $(".phone-label").remove();
        $(".phone-input").remove();
        
        var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-email")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-email")
                    .text("Continuar")
            );
            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

        scrollTo(".email-lebel");

    });

    $(".level-register").on("click", ".confirm-phone", function () {

        if (validarTelefono()) {


        // Crear el label de país
            var countryLabel = $("<label>")
                .attr("for", "country")
                .addClass("country-label")
                .text("País:");

            // Crear el select de país
            var countrySelect = $("<select>")
                .attr({
                    id: "country",
                    name: "country"
                })
                .addClass("country-input")
                .prop("required", true);

            /* // Agregar opciones al select desde la base de datos
            <?php
            // Asegúrate de que las opciones se hayan cargado previamente en $continentes_result
            while ($row = mysqli_fetch_assoc($continentes_result)) {
                echo "$('.country-input').append($('<option>', { value: '" . $row["name"] . "', text: '" . $row["name"] . "'}));";
            }
            ?> */
            // Agregar label y select al div con la clase "level-register"
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

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".country-lebel");
        } else {
            mostrarError("Número de teléfono no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-country", function () {
        $(".phone-input").prop("disabled", false);

        $(".country-label").remove();
        $(".country-input").remove();      

        var newContent = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("volver-confirm-phone")
                .text("Volver"),
            $("<a>")
                .addClass("confirm-phone")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);

        scrollTo(".phone-level");
    });

    $(".level-register").on("click", ".confirm-country", function () {

       if (validarPais()) {
            // Crear el label de ciudad
            var cityLabel = $("<label>")
                .attr("for", "city")
                .addClass("city-label")
                .text("Ciudad:");

            // Crear el input de ciudad
            var cityInput = $("<input>")
                .attr({
                    type: "text",
                    id: "city",
                    name: "city"
                })
                .addClass("city-input")
                .prop("required", true);

            // Agregar label e input al div con la clase "level-register"
            $(".country-input").after(cityLabel, cityInput);

           $(".country-input").prop("disabled", true);

           var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-city")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-city")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

           scrollTo(".city-lebel");
       } else {
           mostrarError("País no válido. Por favor, inténtelo de nuevo.");
       }
    }); 

    $(".volver-confirm-city").click(function () {
        $(".city-lebel, .city-input, .confirm-city, .volver-confirm-city").hide();
        $(".country-input").prop("disabled", false);
        $(".city-input").val("");
        $(".confirm-country, .volver-confirm-country").show();
        scrollTo(".country-lebel");

     }); 

    $(".confirm-city").click(function () {
        if (validarCiudad()) {
            $(".postal-code-lebel, .postal-code-input, .volver-confirm-postal, .confirm-postal").show();
            $(".city-input").prop("disabled", true);
            $(".confirm-city, .volver-confirm-city").hide();
            scrollTo(".postal-code-lebel");
        } else {
            mostrarError("Ciudad no válida, no debe tener digitos. Por favor, inténtelo de nuevo.");
        }
    });

    $(".confirm-postal").click(function () {
        if (validarPostal()) {
            $(".volver-confirm-postal-2, .form-button").show();
            $(".postal-code-input").prop("disabled", true);
            $(".volver-confirm-postal, .confirm-postal").hide();
            scrollTo(".postal-code-lebel");
        } else {
            mostrarError("Codigo postal invalido, son 5 digitos.");
        }
    });

    $(".volver-confirm-postal").click(function () {

        $(".postal-code-lebel, .postal-code-input, .volver-confirm-postal, .form-button").hide();
        $(".city-input").prop("disabled", false);
        $(".postal-code-input").val("");
        $(".confirm-city, .volver-confirm-city").show();
        scrollTo(".city-lebel");

    });
    

    function scrollTo(element) {
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 1200); 
    }

    function validarUsuario() {
        // Lógica de validación para la ciudad
        var usuario = $("#username").val();
        return usuario.trim() !== "";  
    }

    function validarContraseña() {
        // Verifica que la contraseña tenga al menos 8 caracteres de longitud
        var contraseña = $("#password").val();

        if (contraseña.length < 8) {
            return false;
        }
    
        // Verifica que la contraseña contenga al menos una letra mayúscula
        if (!/[A-Z]/.test(contraseña)) {
            return false;
        }
    
        // Verifica que la contraseña contenga al menos una letra minúscula
        if (!/[a-z]/.test(contraseña)) {
            return false;
        }
    
        // Verifica que la contraseña contenga al menos un número
        if (!/\d/.test(contraseña)) {
            return false;
        }
    
        // Si la contraseña pasa todas las verificaciones, es válida
        return true;
    }

    function validarConfirmacionContraseña() {
        // Lógica de validación para la confirmación de contraseña
        var contraseña = $("#password").val();
        var confirmacionContraseña = $("#confirm_password").val();
        // Verifica si la contraseña y la confirmación coinciden
        if (contraseña === confirmacionContraseña) {
            return true; // Devuelve true si es válida, false si no lo es
        } 
        
    }

    function validarCorreoElectronico() {
        // Lógica de validación para el correo electrónico
        var correoElectronico = $("#email").val();
        var expresionRegularCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (expresionRegularCorreo.test(correoElectronico)) {
            return true; 
        }
        
    }

    function validarTelefono() {
        var telefono = $("#phone").val();
    
        var expresionRegularTelefono = /^(\+\d{1,4}|00\d{1,4}|)?\d{10}$/;
    
        return expresionRegularTelefono.test(telefono);
    }

    function validarPais() {
        var pais = $("#country").val();
        return true
    }

    function validarCiudad() {
        var ciudad = $("#city").val();
        var formatoLetras = /^[A-Za-z]+$/;  // Expresión regular para solo letras
    
        return ciudad.trim() !== "" && formatoLetras.test(ciudad.trim());
    }

    function validarPostal() {
        var postal = $("#postal_code").val();
        var formatoPostal = /^\d{5}$/;  // Expresión regular para un código postal de 5 dígitos
    
        return postal.trim() !== "" && formatoPostal.test(postal.trim());
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
    
    
    
});
