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
                               

                <div class="button-forum ">
                    <a class="volver-confirm-city">Volver</a>
                    <a class="confirm-city">Continuar</a>
                </div>

                <label for="postal_code" class="postal-code-lebel">Código Postal:</label>
                <input type="text" id="postal_code" name="postal_code" class="postal-code-input" required>

                <div class="button-forum ">
                    <a class="volver-confirm-postal">Volver</a>
                    <a class="confirm-postal">Continuar</a>
                </div>
                <div class="button-forum ">
                    <a class="volver-confirm-postal-2">Volver</a>
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
