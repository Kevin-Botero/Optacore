<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="IMAGENES/logopta.png" alt="" height="80px" width="100px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>

            <?php
            if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {

                echo '<li class="nav-item"><a class="nav-link" href="cerrar_sesion.php">Cerrar</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>';
            }
            ?>

        </ul>
    </div>
</nav>