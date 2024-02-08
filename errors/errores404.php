<?php
header('HTTP/1.0 404 Not Found');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <link href="../recursos/styles.css" rel="stylesheet">
</head>

<body>

    <main>
        <section>
            <h2>¡Oops! Página no encontrada</h2>
            <p>La página que estás buscando no existe. Puede ser que la dirección sea incorrecta o que la página haya sido eliminada.</p>
            <img src="../recursos/error404.png" alt="Error 404" class="errorpng">
        </section>

        <div class="button-container">
            <a href="../index.php">Volver a la página de inicio</a>
        </div>
    </main>



</body>

</html>
