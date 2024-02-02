<?php
include 'logger.php';

session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Redirige a la página de inicio de sesión si no ha iniciado sesión
    header("Location: index.php");
    exit();
}

// Cierra la sesión actual
session_destroy();

logInfo("Se ha cerrado la sesión: ".$_SESSION['nombre'], $_SERVER['PHP_SELF'], "Cierre Sesión");

// Redirige a la página de inicio de sesión
header("Location: index.php");
exit();
?>