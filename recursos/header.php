<nav class="navbar">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            echo '<li>';
            if (basename($_SERVER['PHP_SELF']) !== 'dashboard.php') {
                echo '<a href="dashboard.php">DashBoard</a>';
            } else {    
                echo 'DashBoard';
            }
            echo '</li>';
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
            // Comprobar si el usuario está en la página login.php
            $currentPage = basename($_SERVER['PHP_SELF']);
            if ($currentPage !== 'login.php') {
                echo '<li><a href="login.php">Iniciar Sesión</a></li>';
            }
            echo '<li><a href="register.php">Registrarse</a></li>';
        }
        ?>
    </ul>
</nav>
<nav class="navbar">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['usuario'])) {
            echo '<li>';
            if (basename($_SERVER['PHP_SELF']) !== 'dashboard.php') {
                echo '<a href="dashboard.php">DashBoard</a>';
            } else {    
                echo 'DashBoard';
            }
            echo '</li>';
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
            // Comprobar si el usuario está en la página login.php
            $currentPage = basename($_SERVER['PHP_SELF']);
            if ($currentPage !== 'login.php') {
                echo '<li><a href="login.php">Iniciar Sesión</a></li>';
            }
            echo '<li><a href="register.php">Registrarse</a></li>';
        }
        ?>
    </ul>
</nav>
