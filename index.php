<?php
session_start();

include("BD/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="CSS/style.css">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>
    <?php include("nav.php");?>
<ul class="nav justify-content-center">
    <!---<li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Gafas de Sol</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Gafas Oftàlmicas</a>
    </li> --->
<li class="nav-item">
  <a class="nav-link li_nav" href="form_cita.php">Pide tu Cita</a>
</li>
<li class="nav-item">
  <a class="nav-link li_nav" href="conocenos.php">Conócenos</a>
</li>
</ul>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
<div class="carousel-indicators">
  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
</div>
<div class="carousel-inner ">
<div class="carousel-item active d-item">
<img src="IMAGENES/fondo5.jpg" class="d-block w-100 d-img" alt="slider 1">
<div class="carousel-caption d-none d-md-block">
<h5>AGENDA TU REVISION ANUAL Y CUIDA TU VISION CN NOSOTROS </h5><br>
<h5>Somos lideres en la salud visual, siempre estamos pensando en tu bienestar.</h5>
<a class="btn btn-primary px-4 py-2 fs-5 mt-5" href="form_cita.php">Agenda aqui</a>
</div>
</div>
<div class="carousel-item d-item">
<img src="IMAGENES/fondo2.webp" class="d-block w-100 d-img" alt="slider 1">
<div class="carousel-caption d-none d-md-block">
<h5>Aprovecha esta oportunidad</h5><br>
<h5>Por la compra de montura + lente, obten </h5><br>
<h3>30% DE DCTO.</h3>
<h3>En productos selecionados.</h3>
<a class="btn btn-primary px-4 py-2 fs-5 mt-5" href="gallery_product.php">Compra aqui</a>
</div>
</div>
<div class="carousel-item d-item">
<img src="IMAGENES/transitions_1.jpg" class="d-block w-100 d-img" alt="slider 1">
<div class="carousel-caption d-none d-md-block">
<h3>Estrena look bajo el sol</h3><br>
<h3>30% DCTO EN GAFAS DE SOL.</h3><br>
<h3>En productos selecionados.</h3>
<a class="btn btn-primary px-4 py-2 fs-5 mt-5" href="gallery_product.php">Compra aqui</a>
</div>
</div>
</div>
</div>

<section>
<center>
<marquee behavior="" direction="left" scrollamount="14">
  <p class="ve">CALIDAD Y EXCLUSIVIDAD A UN CLICK </p>
</marquee>
</section>

            
<b><h1>Lentes Destacados</h1></b> 
<div class="container text-center "> 
<div class="row">
<?php
$sql = mysqli_query($con, "SELECT * FROM productos ORDER BY ProductoID ASC");
if(mysqli_num_rows($sql) == 0){
    echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
while($row = mysqli_fetch_assoc($sql) ){ 
if ($row['ProductoID'] <= 9 ){ ?>
<div class="card mb-3 p-2 flex-fill card" style="width: 18rem; margin:10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); ">
  <?php echo '<img src="data:' .  ';base64,' . base64_encode($row['Imagen']) . '" class="card-img-top" alt="Imagen">';?>
  <div class="card-body">
  <h6 class="card-title"><?php echo $row['NombreProducto']; ?></h6>
  <h6 class="card-title">$ <?php echo number_format($row['Precio'],2,",",".");?></h6>
  <?php 
  echo '<a href="agregar.php?id='. $row ['ProductoID'].'" class="btn btn-outline-secondary"><img src="IMAGENES/carrito.png" style="height: 25px;" alt=""></a>'; 
  echo '<a href="detalle_product.php?id='. $row ['ProductoID'].'" class="btn btn-outline-primary">Detalles</a>';
  ?>
  </div>
</div>
<?php
}
}
}?>
<!--<img src="IMAGENES/gafa6.jpg" alt="" height="80em" >
<img src="IMAGENES/gafa0.jfif" alt="" height="80em" >
<img src="IMAGENES/gafa1.webp" alt="" height="180px" >
<img src="IMAGENES/gafa3.webp" alt="" height="80em">
<img src="IMAGENES/gafa4.jpg" alt="" height="80em" >
<img src="IMAGENES/gafa9.jfif" alt="" height="80em" >
<img src="IMAGENES/gafa5.jpg" alt="" height="80em" >-->
</div>
</div>
<div style="text-align: center;">
<a href="gallery_product.php" class="btn btn-outline-primary" style="width: 58.9%;">Más Resultados</a>
</div>
<hr>
<div class="container-1">
<img src="IMAGENES/michael.jpg" alt=""width="20%" height="20%">
<img src="IMAGENES/ray.jpg" alt=""width="20%" height="20%">
<img src="IMAGENES/emporio.jpg" alt="" width="20%" height="20%">
<img src="IMAGENES/kilyan.jpg" alt=""width="20%" height="20%">
</div>
<?php include('footer.php'); ?>
</body>
</html>