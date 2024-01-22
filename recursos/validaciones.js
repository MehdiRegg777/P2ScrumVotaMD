$(document).ready(function () {

    // Oculta todos los elementos de entrada excepto el primer conjunto
    $("  .volver-confirm-password-button, .confirm-password-button, .confirm-password-label, .confirm-password-input, .volver-confirm-confirm-password-button , .confirm-confirm-password-button, .email-lebel, .email-input, .confirm-email, .volver-confirm-email, .phone-level, .phone-input, .confirm-phone, .volver-confirm-phone, .country-lebel, .country-input, .confirm-country, .volver-confirm-country, .city-lebel, .city-input, .confirm-city , .volver-confirm-city , .postal-code-lebel, .postal-code-input, .volver-confirm-postal, .form-button, .volver-confirm-postal-2, .confirm-postal").hide();

    $(".confirm-username").click(function () {
        
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
            $(".confirm-username").hide();
            $(".volver-confirm-password-button, .confirm-password-button").show();

            scrollTo(".password-label");
        } else {
            mostrarError("Usuario no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".volver-confirm-password-button").click(function () {
        

        $(".password-label, .password-input, .confirm-password-button, .volver-confirm-password-button").hide();
        $(".user-input").prop("disabled", false);
        $(".password-input").val("");
        $(".confirm-username").show();
        scrollTo(".user-label");

    });

    $(".confirm-password-button").click(function () {
        if (validarContraseña()) {
            $(".confirm-password-label, .confirm-password-input, .confirm-confirm-password-button, .volver-confirm-confirm-password-button").show();
            $(".password-input").prop("disabled", true);
            $(".confirm-password-button, .volver-confirm-password-button").hide();
            scrollTo(".confirm-password-label");
        } else {
            mostrarError("Contraseña no válida. La contraseña debe tener una longitud mínima de 8 caracteres e incluir al menos una letra mayúscula, una letra minúscula y un número. Por favor, inténtelo de nuevo.");
        }
    });

    $(".volver-confirm-confirm-password-button").click(function () {

        $(".confirm-password-label, .confirm-password-input, .confirm-confirm-password-button, .volver-confirm-confirm-password-button").hide();
        $(".password-input").prop("disabled", false);
        $(".confirm-password-input").val("");
        $(".confirm-password-button, .volver-confirm-password-button").show();
        scrollTo(".password-label");

    });

    $(".confirm-confirm-password-button").click(function () {
        if (validarConfirmacionContraseña()) {
            $(".email-lebel, .email-input, .confirm-email, .volver-confirm-email").show();
            $(".confirm-password-input").prop("disabled", true);
            $(".confirm-confirm-password-button, .volver-confirm-confirm-password-button").hide();
            scrollTo(".email-lebel");
        } else {
            mostrarError("La Contraseña no coincide. Por favor, inténtelo de nuevo.");
        }
    });

    $(".volver-confirm-email").click(function () {

        $(".email-lebel, .email-input, .confirm-email, .volver-confirm-email").hide();
        $(".confirm-password-input").prop("disabled", false);
        $(".email-input").val("");
        $(".confirm-confirm-password-button, .volver-confirm-confirm-password-button").show();
        scrollTo(".confirm-password-label");

    });

    $(".confirm-email").click(function () {
        if (validarCorreoElectronico()) {
            $(".phone-level, .phone-input, .confirm-phone, .volver-confirm-phone").show();
            $(".email-input").prop("disabled", true);
            $(".confirm-email, .volver-confirm-email").hide();
            scrollTo(".phone-level");
        } else {
            mostrarError("Correo electrónico no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".volver-confirm-phone").click(function () {

        $(".phone-level, .phone-input, .confirm-phone, .volver-confirm-phone").hide();
        $(".email-input").prop("disabled", false);
        $(".phone-input").val("");
        $(".confirm-email, .volver-confirm-email").show();
        scrollTo(".email-lebel");

    });

    $(".confirm-phone").click(function () {
        if (validarTelefono()) {
            $(".country-lebel, .country-input, .confirm-country, .volver-confirm-country").show();
            $(".phone-input").prop("disabled", true);
            $(".confirm-phone, .volver-confirm-phone").hide();
            scrollTo(".country-lebel");
        } else {
            mostrarError("Número de teléfono no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".volver-confirm-country").click(function () {

        $(".country-lebel, .country-input, .confirm-country, .volver-confirm-country").hide();
        $(".phone-input").prop("disabled", false);
        $(".country-input").val("");
        $(".confirm-phone, .volver-confirm-phone").show();
        scrollTo(".phone-level");
    });

    $(".confirm-country").click(function () {
       if (validarPais()) {
           $(".city-lebel, .city-input, .confirm-city, .volver-confirm-city").show();
           $(".country-input").prop("disabled", true);
           $(".confirm-country, .volver-confirm-country").hide();
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
        return pais.trim() !== "";
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
