<nav class="navbar">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            echo "<li><a href='dashboard.php'>DashBoard</a></li>";
            echo '<li><a href="create_poll.php">Crear Encuesta</a></li>';
            echo "<h3>Bienvenido, ".$_SESSION['nombre']." </h3>";
        }
        ?>
    </ul>
    <ul>
        <?php
        if (isset($_SESSION['usuario'])) {
            echo '<li><a href="logout.php">Cerrar Sesión</a></li>';
        } else {
            echo '<li><a href="login.php">Iniciar Sesión</a></li>';
            echo '<li><a href="register.php">Registrarse</a></li>';
        }
        ?>
    </ul>
</nav>