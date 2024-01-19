<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="recursos/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="recursos/logo.png" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>


<main>
    <section>
        <h1>Registrar Usuario</h1>
        <form method="post" >

            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            
            <div class="button-forum confirm-username">
                <a>Confirmar</a>
            </div>

            <label for="password" class="password-label">Contraseña:</label>
            <input type="password" id="password" name="password" class="password-input" required>
           
            <div class="button-forum confirm-password-button">
                <a>Confirmar</a>
            </div>

            <label for="confirm_password" class="confirm-password-label">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="confirm-password-input" required>

            <div class="button-forum confirm-confirm-password-button">
                <a>Confirmar</a>
            </div>

            <label for="email" class="email-lebel">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="email-input" required>

            <div class="button-forum confirm-email">
                <a>Confirmar</a>
            </div>

            <label for="phone" class="phone-level">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="phone-input">

            <div class="button-forum confirm-phone">
                <a>Confirmar</a>
            </div>

            <label for="country" class="country-lebel">País:</label>
            <input type="text" id="country" name="country" class="country-input">

            <div class="button-forum confirm-country">
                <a>Confirmar</a>
            </div>

            <label for="city" class="city-lebel">Ciudad:</label>
            <input type="text" id="city" name="city" class="city-input">

            <div class="button-forum confirm-city">
                <a>Confirmar</a>
            </div>

            <label for="postal_code" class="postal-code-lebel">Código Postal:</label>
            <input type="text" id="postal_code" name="postal_code" class="postal-code-input">

            <button type="submit" class="form-button"><i class="fas fa-user-plus"></i> Registrar</button>
            <div class="button-inicio">
                <a href="index.php"><i class="fas fa-home"></i> volver Inicio</a>
            </div>
        </form>
    </section>
</main>


<script src='recursos/validaciones.js'></script>

</body>
</html>
