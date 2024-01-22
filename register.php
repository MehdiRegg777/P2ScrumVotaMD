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
                <label for="username" class="user-label">Usuario:</label>
                <input type="text" id="username" name="username" class="user-input" required>
                
                <div class="button-forum ">
                    <a class="confirm-username">Continuar</a>
                </div>

                <label for="password" class="password-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="password-input" required>
            
                <div class="button-forum ">
                    <a class="volver-confirm-password-button">Volver</a>
                    <a class="confirm-password-button">Continuar</a>
                </div>

                <label for="confirm_password" class="confirm-password-label">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="confirm-password-input" required>

                <div class="button-forum ">
                    <a class="volver-confirm-confirm-password-button">Volver</a>
                    <a class="confirm-confirm-password-button">Continuar</a>
                </div>

                <label for="email" class="email-lebel">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="email-input" required>

                <div class="button-forum ">
                    <a class="volver-confirm-email">Volver</a>
                    <a class="confirm-email">Continuar</a>
                </div>

                <label for="phone" class="phone-level">Teléfono [incluye el código de tu país (+34.. o 0034..)]:</label>
                <input type="tel" id="phone" name="phone" class="phone-input" required>

                <div class="button-forum">
                    <a class="volver-confirm-phone">Volver</a>
                    <a class="confirm-phone">Continuar</a>
                </div>
                <label for="country" class="country-lebel">País:</label>
                <select id="country" name="country" class="country-lebel" required>
                    <?php
                    // Mostrar opciones del menú desplegable con los paises
                    while ($row = mysqli_fetch_assoc($continentes_result)) {
                        echo "<option class='country-input' value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                    }
                    ?>
                </select>



                <div class="button-forum ">
                    <a class="volver-confirm-country">Volver</a>
                    <a class="confirm-country">Continuar</a>
                </div>

                <label for="city" class="city-lebel">Ciudad:</label>
                <input type="text" id="city" name="city" class="city-input" required>

                <div class="button-forum ">
                    <a class="volver-confirm-city">Volver</a>
                    <a class="confirm-city">Continuar</a>
                </div>

                <label for="postal_code" class="postal-code-lebel">Código Postal:</label>
                <input type="text" id="postal_code" name="postal_code" class="postal-code-input" required>

                <div class="button-forum ">
                    <a class="volver-confirm-postal">Volver</a>
                    <button type="submit" class="form-button"><i class="fas fa-user-plus"></i> Registrar</button>
                </div>
            </div>
            <div id="notification-container"></div>

            <div class="buttons-registers">
                <div class="button-inicio">
                    <a href="index.php"><i class="fas fa-home"></i> volver Inicio</a>
                </div>
            </div>

        </form>
    </section>
</main>


<script src='recursos/validaciones.js'></script>

</body>
</html>
