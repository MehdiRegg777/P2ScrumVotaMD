$(document).ready(function () {

    // Oculta todos los elementos de entrada excepto el primer conjunto
    $(".password-label, .password-input, .volver-confirm-password-button, .confirm-password-button, .confirm-password-label, .confirm-password-input, .volver-confirm-confirm-password-button , .confirm-confirm-password-button, .email-lebel, .email-input, .confirm-email, .volver-confirm-email, .phone-level, .phone-input, .confirm-phone, .volver-confirm-phone, .country-lebel, .country-input, .confirm-country, .volver-confirm-country, .city-lebel, .city-input, .confirm-city , .volver-confirm-city , .postal-code-lebel, .postal-code-input, .volver-confirm-postal, .form-button").hide();

    $(".confirm-username").click(function () {
        
        if (validarUsuario()) {
            $(".password-label, .password-input, .confirm-password-button, .volver-confirm-password-button").show();
            $(".user-input").prop("disabled", true);
            $(".confirm-username").hide();
            scrollTo(".password-label");
        } else {
            mostrarError("Usuario no válida. Por favor, inténtelo de nuevo.");
        }
    });

    $(".confirm-password-button").click(function () {
        if (validarContraseña()) {
            $(".confirm-password-label, .confirm-password-input, .confirm-confirm-password-button, .volver-confirm-confirm-password-button").show();
            $(".password-input").prop("disabled", true);
            $(".confirm-password-button, .volver-confirm-password-button").hide();
            scrollTo(".confirm-password-label");
        } else {
            mostrarError("Contraseña no válida. Por favor, inténtelo de nuevo.");
        }
    });

    $(".confirm-confirm-password-button").click(function () {
        if (validarConfirmacionContraseña()) {
            $(".email-lebel, .email-input, .confirm-email, .volver-confirm-email").show();
            $(".confirm-password-input").prop("disabled", true);
            $(".confirm-confirm-password-button, .volver-confirm-confirm-password-button").hide();
            scrollTo(".email-lebel");
        } else {
            mostrarError("La confirmación de contraseña no coincide. Por favor, inténtelo de nuevo.");
        }
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

    $(".confirm-city").click(function () {
        if (validarCiudad()) {
            $(".postal-code-lebel, .postal-code-input, .volver-confirm-postal, .form-button").show();
            $(".city-input").prop("disabled", true);

            $(".confirm-city, .volver-confirm-city").hide();
            scrollTo(".postal-code-lebel");
        } else {
            mostrarError("Ciudad no válida. Por favor, inténtelo de nuevo.");
        }
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
        return ciudad.trim() !== "";  
    }

    function mostrarError(mensaje) {
        // Crear elemento de notificación
        var notificacion = $("<div class='notificacion-error'></div>");
        notificacion.text(mensaje);
    
        // Agregar notificación al contenedor
        $("#notification-container").append(notificacion);
    
        // Desvanecer la notificación al hacer clic
        notificacion.click(function () {
            notificacion.fadeOut(500, function () {
                $(this).remove(); // Eliminar la notificación después de desvanecerse
            });
        });
    
        /* 
        setTimeout(function () {
            notificacion.fadeOut(500, function () {
                $(this).remove(); // Eliminar la notificación después de desvanecerse
            });
        }, 3000); // Desaparece después de 3 segundos (puedes ajustar este valor) */
    }
    
    
});
