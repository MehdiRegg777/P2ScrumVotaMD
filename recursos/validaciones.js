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
    $(".level-register").append(userLabel, userInput);

    // Confirmar usuario
    $(".level-register").on("keydown", ".user-input", function (event) {
        // Verificar si la tecla presionada es Tab o Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            console.log("confirm-username");
            if (validarUsuario()) {

                $(this).nextAll().remove();

                localStorage.setItem('username', $(this).val());

                document.cookie = "username="+ $(this).val();

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
    
                // Agregar label e input después del campo de usuario
                $(this).after(label, input);
    

                var newContent = $("<div>")
                    .addClass("button-forum")
                    .append(
                        $("<a>")
                            .addClass("confirm-password-button")
                            .text("Continuar")
                    );
                    
                        
                // Reemplazar el contenido del div con la clase "button-forum"
                $(".button-forum").replaceWith(newContent);
    
                // Colocar el foco en el nuevo campo de contraseña
                $(".password-input").focus();
    
                // Realizar alguna acción adicional si es necesario
    
                // Detener la propagación del evento para evitar comportamientos predeterminados
                event.preventDefault();
                event.stopPropagation();
            } else {
                mostrarError("Usuario no válido. Por favor, inténtelo de nuevo.");
            }
        }
    });
    


    $(".level-register").on("keydown", ".password-input", function (event) {
        // Verificar si el evento es un clic o una tecla Tab/Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            console.log("contra")
            if (validarContraseña()) {

                localStorage.setItem('contra', $(this).val());
                document.cookie = "contra="+ $(this).val();

                $(this).nextAll().remove();

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
    
                // Agregar label e input después del campo de contraseña
                $(".password-input").after(confirmLabel, confirmInput);
    
    
                var newContent = $("<div>")
                    .addClass("button-forum")
                    .append(
                        $("<a>")
                            .addClass("confirm-confirm-password-button")
                            .text("Continuar")
                    );
    
                // Reemplazar el contenido del div con la clase "button-forum"
                $(".button-forum").replaceWith(newContent);

                $(".confirm-password-input").focus();
    
                
    
                // Colocar el foco en el nuevo campo de confirmar contraseña
    
                // Realizar alguna acción adicional si es necesario
    
                // Detener la propagación del evento para evitar comportamientos predeterminados
                event.preventDefault();
                event.stopPropagation();
            } else {
                mostrarError("Contraseña no válida. La contraseña debe tener una longitud mínima de 8 caracteres e incluir al menos una letra mayúscula, una letra minúscula y un número. Por favor, inténtelo de nuevo.");
            }
        }
    });
    

    // $(".level-register").on("click", ".confirm-password-input", function () {
    //     console.log("contra2");
    //     $(".password-input").prop("disabled", false);

    //     $(".confirm-password-label").remove();
    //     $(".confirm-password-input").remove();
    //     var newContent = $("<div>")
    //     .addClass("button-forum")
    //     .append(
    //         $("<a>")
    //             .addClass("confirm-password-button")
    //             .text("Continuar")
    //     );

    //     // Reemplazar el contenido del div con la clase "button-forum"
    //     $(".button-forum").replaceWith(newContent);


    // });

    $(".level-register").on("keydown", ".confirm-password-input", function (event) {
        // Verificar si la tecla presionada es Tab o Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            console.log("contra 2");
            event.preventDefault();  // Detener la propagación del evento para evitar comportamientos predeterminados
    
            if (validarConfirmacionContraseña()) {

                localStorage.setItem('contra2', $(this).val());
                document.cookie = "contra2="+ $(this).val();

                $(this).nextAll().remove();

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
    
                var newContent = $("<div>")
                    .addClass("button-forum")
                    .append(
                        $("<a>")
                            .addClass("confirm-email")
                            .text("Continuar")
                    );

                // Reemplazar el contenido del div con la clase "button-forum"
                $(".button-forum").replaceWith(newContent);
                
                $("#email").focus();

                
            } else {
                mostrarError("La Contraseña no coincide. Por favor, inténtelo de nuevo.");
            }
        }
    });
    

    // // Confirmar email
    // $(".level-register").on("click", ".volver-confirm-email", function () {
    //     $(".confirm-password-input").prop("disabled", false);

    //     $(".email-lebel").remove();
    //     $(".email-input").remove();

    //     var newContent = $("<div>")
    //         .addClass("button-forum")
    //         .append(
    //             $("<a>")
    //                 .addClass("confirm-confirm-password-button")
    //                 .text("Continuar")
    //         );

    //         // Reemplazar el contenido del div con la clase "button-forum"
    //         $(".button-forum").replaceWith(newContent);


    // });

    // Confirmar email
    $(".level-register").on("keydown", ".email-input", function (event) {
        // Verificar si la tecla presionada es Tab o Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            event.preventDefault();  // Detener la propagación del evento para evitar comportamientos predeterminados
    
            if (validarCorreoElectronico()) {

                localStorage.setItem('email', $(this).val());
                document.cookie = "email="+ $(this).val();

                $(this).nextAll().remove();

                // Crear el label de teléfono
                var phoneLabel = $("<label>")
                    .attr("for", "phone")
                    .addClass("phone-label")
                    .text("Teléfono (Sin código del país):");
    
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
    
                var newContent = $("<div>")
                    .addClass("button-forum")
                    .append(
                        $("<a>")
                            .addClass("confirm-phone")
                            .text("Continuar")
                    ); 

                
                $('#phone').focus();
                
                // Reemplazar el contenido del div con la clase "button-forum"
                $(".button-forum").replaceWith(newContent);
    
                scrollTo(".phone-label");
                
            } else {
                mostrarError("Correo electrónico no válido. Por favor, inténtelo de nuevo.");
            }
        }
    });
    

    // $(".level-register").on("click", ".volver-confirm-phone", function () {

    //     $(".phone-label").remove();
    //     $(".phone-input").remove();
        
    //     var newContent = $("<div>")
    //         .addClass("button-forum")
    //         .append(
    //             $("<a>")
    //                 .addClass("confirm-email")
    //                 .text("Continuar")
    //         );
    //         // Reemplazar el contenido del div con la clase "button-forum"
    //         $(".button-forum").replaceWith(newContent);
    // });

    // $(".level-register").on("click", ".volver-confirm-country", function () {

    //     $(".country-label").remove();
    //     $(".country-input").remove();      

    //     var newContent = $("<div>")
    //     .addClass("button-forum")
    //     .append(
    //         $("<a>")
    //             .addClass("confirm-phone")
    //             .text("Continuar")
    //     );

    //     // Reemplazar el contenido del div con la clase "button-forum"
    //     $(".button-forum").replaceWith(newContent);

    // });

    $(".level-register").on("click", ".country-input", function () {

       if (validarPais()) {

        localStorage.setItem('pais', $(this).val());
        document.cookie = "pais="+ $(this).val();

        $(this).nextAll().remove();

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


           var newContent = $("<div>")
            .addClass("button-forum")
            .append(
                $("<a>")
                    .addClass("confirm-city")
                    .text("Continuar")
            );

            // Reemplazar el contenido del div con la clase "button-forum"
            $(".button-forum").replaceWith(newContent);

            $("#city").focus();
           scrollTo(".city-label");
           

       } else {
           mostrarError("País no válido. Por favor, inténtelo de nuevo.");
       }
    }); 

    // $(".level-register").on("click", ".volver-confirm-city", function () {
    //     $(".country-input").prop("disabled", false);

    //     $(".city-label").remove();
    //     $(".city-input").remove();

    //     var newContent = $("<div>")
    //     .addClass("button-forum")
    //     .append(
    //         $("<a>")
    //             .addClass("confirm-country")
    //             .text("Continuar")
    //     );

    //     // Reemplazar el contenido del div con la clase "button-forum"
    //     $(".button-forum").replaceWith(newContent);
    //  }); 

    $(".level-register").on("keydown", ".city-input", function (event) {
        // Verificar si la tecla presionada es Tab o Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            console.log("city-input");
            event.preventDefault();  // Detener la propagación del evento para evitar comportamientos predeterminados
    
            if (validarCiudad()) {

                localStorage.setItem('ciudad', $(this).val());
                document.cookie = "ciudad="+ $(this).val();

                $(this).nextAll().remove();

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

    
                var newContent = $("<div>")
                    .addClass("button-forum")
                    .append(
                        $("<a>")
                            .addClass("confirm-postal")
                            .text("Continuar")
                    );
    
                // Reemplazar el contenido del div con la clase "button-forum"
                $(".button-forum").replaceWith(newContent);
                    
                $("#postal_code").focus();
                scrollTo(".postal-code-lebel");
                
            } else {
                mostrarError("Ciudad no válida, no debe tener dígitos. Por favor, inténtelo de nuevo.");
            }
        }
    });
    

    // $(".level-register").on("click", ".volver-confirm-postal", function () {

    //     $(".city-input").prop("disabled", false);

    //     $(".postal-code-lebel").remove();
    //     $(".postal-code-input").remove();

    //     var newContent = $("<div>")
    //         .addClass("button-forum")
    //         .append(
    //             $("<a>")
    //                 .addClass("volver-confirm-city")
    //                 .text("Volver"),
    //             $("<a>")
    //                 .addClass("confirm-city")
    //                 .text("Continuar")
    //         );

    //         // Reemplazar el contenido del div con la clase "button-forum"
    //         $(".button-forum").replaceWith(newContent);
    // });

    $(".level-register").on("keydown", "#postal_code", function (event) {
        // Verificar si la tecla presionada es Tab o Enter
        if (event.key === 'Tab' || event.key === 'Enter') {
            console.log("confirm-postal");
            event.preventDefault();  // Detener la propagación del evento para evitar comportamientos predeterminados
    
            if (validarPostal()) {

                localStorage.setItem('postal_cod', $(this).val());
                document.cookie = "postal_cod="+ $(this).val();

                $(this).nextAll().remove();

                console.log("boton submit");
            // Crear el botón de submit
            var submitButton = $("<button>")
                .attr("type", "submit")
                .addClass("form-button")
                .append(
                    $("<i>")
                        .addClass("fas fa-user-plus")
                )
                .append(" Registrar");

            // Agregar el botón después del input de código postal
            $(".level-register").append(submitButton);
    
                scrollTo(".postal-code-lebel");
                
            } else {
                mostrarError("Código postal inválido, deben ser 5 dígitos.");
            }
        }
    });
    

    // $(".level-register").on("click", ".volver-confirm-postal-2", function () {

    //     $(".postal-code-input").prop("disabled", false);

    //     var newContent = $("<div>")
    //     .addClass("button-forum")
    //     .append(
    //         $("<a>")
    //             .addClass("confirm-postal")
    //             .text("Continuar")
    //     );

    //     // Reemplazar el contenido del div con la clase "button-forum"
    //     $(".button-forum").replaceWith(newContent);


    // });
    
    // Al acceder a un <input> se eliminan los de debajo
    $(".level-register").on("click"), ".user-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), ".password-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), ".confirm-password-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), ".email-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), ".country-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), ".city-input", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }
    $(".level-register").on("click"), "#postal-code", function (event) {
        if (!$(this).is(":last-child")) {
            $(this).nextAll().remove();
        }
        event.stopPropagation();
    }



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

