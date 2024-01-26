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
            $(".user-input");

            var phoneInputField = $("<input>")
        .attr({
            type: "text",
            id: "username",
            name: "username",
            value: $("#username").val()  
        })
        .hide(); 
        $("form").append(phoneInputField);

           
            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".password-label");
            $('div[class="level-register"]').listview('refresh');
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
    });
    

    // Confirm password
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

        var phoneInputField = $("<input>")
        .attr({
            type: "password",
            id: "password",
            name: "password",
            value: $("#password").val()  
        })
        .hide(); 
        $("form").append(phoneInputField);




            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".confirm-password-label");
            $('div[class="level-register"]').listview('refresh');
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
                .addClass("confirm-password-button")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);


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
            

            var phoneInputField = $("<input>")
        .attr({
            type: "password",
            id: "confirm_password",
            name: "confirm_password",
            value: $("#confirm_password").val()  
        })
        .hide(); 

        $("form").append(phoneInputField);

            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-email")
                    .text("Continuar")
            );
            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);
            scrollTo(".email-lebel");
            $('div[class="level-register"]').listview('refresh');

        } else {
            mostrarError("La Contraseña no coincide. Por favor, inténtelo de nuevo.");
        }
    });


    // Confirmar email
    $(".level-register").on("click", ".volver-confirm-email", function () {
        $(".confirm-password-input").prop("disabled", false);

        $(".email-lebel").remove();
        $(".email-input").remove();

        var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-confirm-password-button")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);


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


            // Agregar el campo de entrada al formulario
            $("form").append(phoneInputField);

            $(".email-input");

            var phoneInputField = $("<input>")
            .attr({
                type: "text",
                id: "email",
                name: "email",
                value: $("#email").val()  
            })
            .hide(); 

        $("form").append(phoneInputField);
        
            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-phone")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".phone-label");
            $('div[class="level-register"]').listview('refresh');
        } else {
            mostrarError("Correo electrónico no válido. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-phone", function () {


        $(".phone-label").remove();
        $(".phone-input").remove();
        
        var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-email")
                    .text("Continuar")
            );
            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);


    });

    $(".level-register").on("click", ".volver-confirm-country", function () {

        $(".country-label").remove();
        $(".country-input").remove();      

        var newContent = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("confirm-phone")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);

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


           var phoneInputField = $("<input>")
           .attr({
               type: "text",
               id: "country",
               name: "country",
               value: $("#country").val()  
           })
           .hide(); 
           $("form").append(phoneInputField);

          

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

           scrollTo(".city-label");
           $('div[class="level-register"]').listview('refresh');

       } else {
           mostrarError("País no válido. Por favor, inténtelo de nuevo.");
       }
    }); 

    $(".level-register").on("click", ".volver-confirm-city", function () {
        $(".country-input").prop("disabled", false);

        $(".city-label").remove();
        $(".city-input").remove();

        var newContent = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("confirm-country")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);


     }); 

    $(".level-register").on("click", ".confirm-city", function () {
        if (validarCiudad()) {

            // Crear el label
            var labelpostal = $("<label>")
                .attr("for", "postal_code")
                .addClass("postal-code-lebel")
                .text("Código Postal:");

            // Crear el input
            var inputpostal = $("<input>")
                .attr({
                    type: "text",
                    id: "postal_code",
                    name: "postal_code"
                })
                .addClass("postal-code-input")
                .prop("required", true);

            // Agregar label e input al body (o al contenedor que prefieras)
            $(".city-input").after(labelpostal, inputpostal);


            var phoneInputField = $("<input>")
            .attr({
                type: "text",
                id: "city",
                name: "city",
                value: $("#city").val()  
            })
            .hide(); 
            $("form").append(phoneInputField);

           
            var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("volver-confirm-postal")
                    .text("Volver"),
                $("<a>")
                    .addClass("confirm-postal")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            scrollTo(".postal-code-lebel");
            $('div[class="level-register"]').listview('refresh');

        } else {
            mostrarError("Ciudad no válida, no debe tener digitos. Por favor, inténtelo de nuevo.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-postal", function () {

        $(".city-input").prop("disabled", false);

        $(".postal-code-lebel").remove();
        $(".postal-code-input").remove();

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


    });

    $(".level-register").on("click", ".confirm-postal", function () {

        if (validarPostal()) {

            var newContent = $("<div>")
                .addClass("button-forum")
                .append(
                    $("<a>")
                        .addClass("volver-confirm-postal-2")
                        .text("Volver"),
                    $("<button>")
                        .attr("type", "submit")
                        .addClass("form-button")
                        .append(
                            $("<i>")
                                .addClass("fas fa-user-plus")
                        )
                        .append(" Registrar")
                );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);



            var phoneInputField = $("<input>")
            .attr({
                type: "text",
                id: "postal_code",
                name: "postal_code",
                value: $("#postal_code").val()  
            })
            .hide(); 
            $("form").append(phoneInputField);


            scrollTo(".postal-code-lebel");
            $('div[class="level-register"]').listview('refresh');
        } else {
            mostrarError("Codigo postal invalido, son 5 digitos.");
        }
    });

    $(".level-register").on("click", ".volver-confirm-postal-2", function () {

        $(".postal-code-input").prop("disabled", false);

        var newContent = $("<div>")
        .addClass("button-forum")
        .append(
            $("<a>")
                .addClass("volver-confirm-postal")
                .text("Volver"),
            $("<a>")
                .addClass("confirm-postal")
                .text("Continuar")
        );

        // Reemplazar el contenido del div con la clase "button-forum"
        $(".button-forum").replaceWith(newContent);


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

    

    function validarPais() {
        var pais = $("#country").val();
        return pais !== null && pais !== "";
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

