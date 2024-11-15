<style>
/* Estilo para que el menú se despliegue al pasar el mouse */
.dropdown:hover .dropdown-menu {
    display: block; /* Mostrar el menú en hover */
}

.dropdown-menu {
    display: none; /* Ocultar el menú por defecto */
    position: absolute; /* Asegurar que el menú no desplace el contenido */
    z-index: 1000; /* Para que aparezca encima de otros elementos */
}
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-light" style="text-align: center;">
<a class="navbar-brand" href="index.php"><img src="IMAGENES/logop.png" alt="" height="90px" width="120px"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav"> <!-- Lista para "Gafas" -->
<div class="dropdown">
    <button style="background-color: white; color:black;" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Gafas</button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="gallery_product.php?cat=0">Ver Todas las Gafas</a></li>
        <li><a class="dropdown-item" href="gallery_product.php?cat=1">Polarizadas</a></li>
        <li><a class="dropdown-item" href="gallery_product.php?cat=2">Gafas Deportivas</a></li>
        <li><a class="dropdown-item" href="gallery_product.php?cat=3">Hombre</a></li>
        <li><a class="dropdown-item" href="gallery_product.php?cat=4">Mujer</a></li>
    </ul>
</div>
</ul>
<ul class="navbar-nav ml-auto"> <!-- Lista para el resto de elementos -->
<?php
if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
    if ($_SESSION['info']['RolID'] == "1") {
        echo '
        <div class="dropdown">
            <button style="background-color: white; color:black;" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Panel Administrativo
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="list_usu.php">Usuarios</a></li>
                <li><a class="dropdown-item" href="list_productos.php">Productos</a></li>
                <li><a class="dropdown-item" href="list_especialistas.php">Especialistas</a></li>
                <li><a class="dropdown-item" href="list_vent.php">Ventas</a></li>
                <li><a class="dropdown-item" href="reportes.php">Reportes</a></li>
                <li><a class="dropdown-item" href="list_citas.php">Citas</a></li>
            </ul>
        </div>';
    }
    echo '<li class="nav-item"><a class="nav-link" href="perfil.php"><img src="IMAGENES/profile.png" alt="" width="22px;"></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="cerrar_sesion.php"><img src="IMAGENES/cerrar.png" alt="" width="22px"></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="carrito.php"><img src="IMAGENES/carrito.png" alt="" width="22px"></a></li>';
} else {
    echo '<li class="nav-item"><a class="nav-link" href="login.php"><img src="IMAGENES/usuario.png" alt="" width="22px"></a></li>';
}
?>
</ul>
</div>
</nav>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
