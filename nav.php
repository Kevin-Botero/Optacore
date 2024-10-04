<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-light" style="text-align: center; ">
<a class="navbar-brand" href="index.php"><img src="IMAGENES/logopta.png" alt="" height="80px" width="100px"></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<div class="dropdown">
<button style="background-color: white; color:black;"  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Gafas</button>
<ul class="dropdown-menu">
  <!--<li><a class="dropdown-item" href="#">Gafas de Mujer</a></li>
  <li><a class="dropdown-item" href="#">Gafas de Hombre</a></li>-->
  <li><a class="dropdown-item" href="gallery_product.php">Ver Todas las Gafas</a></li>
</ul>
</div>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ml-auto">
<?php
if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
if ($_SESSION['info']['RolID'] == "1") {
echo '
<div class="dropdown">
  <button style="background-color: white; color:black;"  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Panel Administrativo
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="list_usu.php">Usuarios</a></li>
    <li><a class="dropdown-item" href="form_producto.php">Agregar Productos</a></li>
    <li><a class="dropdown-item" href="list_productos.php">Lista de Productos</a></li>
    <li><a class="dropdown-item" href="list_vent.php">Ventas</a></li>
  </ul>
</div>';
//echo '<li class="nav-item"><a class="nav-link" href="list_usu.php"><img src="IMAGENES/editar.png" alt="" height="40px" width="40px"></a></li>';
//echo '<li class="nav-item"><a class="nav-link" href="form_producto.php"><img src="IMAGENES/product.png" alt="" height="40px" width="40px"></a></li>';
}
echo '<li class="nav-item"><a class="nav-link" href="perfil.php"><img src="IMAGENES/profile.png" alt="" width="22px;"></a></li>';
echo '<li class="nav-item"><a class="nav-link" href="cerrar_sesion.php"><img src="IMAGENES/cerrar.png" alt="" width="22px"></a></li>';
echo '<li class="nav-item"><a class="nav-link" href="carrito.php"><img src="IMAGENES/carrito.png" alt="" width="22px"></a></li>';
} else {
echo '<li class="nav-item"><a class="nav-link" href="login.php"><img src="IMAGENES/usuario.png" alt=""  width="22px"></a></li>';
}
?>
</ul>
</div>
<!--<link rel="stylesheet" href="CSS/styles.css">
<link rel="stylesheet" href="CSS/index_style.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
</nav>


