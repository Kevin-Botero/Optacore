<?php
session_start();
include("BD/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuestros Productos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<?php include 'nav.php'; ?>
<body class="body">
<?php
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
?>
<div class="container text-center "> 
<div class="row ">
<?php
if ($cat == 0) {
  $sql = mysqli_query($con, "SELECT * FROM productos ORDER BY ProductoID ASC");
}elseif ($cat == 1) {
  $sql = mysqli_query($con, "SELECT * FROM productos WHERE CategoriaID = 1 ");
}
elseif ($cat == 2) {
  $sql = mysqli_query($con, "SELECT * FROM productos WHERE CategoriaID = 2 ");
}
elseif ($cat == 3) {
  $sql = mysqli_query($con, "SELECT * FROM productos WHERE CategoriaID = 3 ");
}
elseif ($cat == 4) {
  $sql = mysqli_query($con, "SELECT * FROM productos WHERE CategoriaID = 4 ");
}else{
  $sql = mysqli_query($con, "SELECT * FROM productos ORDER BY ProductoID ASC");
}
if(mysqli_num_rows($sql) == 0){
    echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
while($row = mysqli_fetch_assoc($sql)){ ?>
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
}?>
</div>
</div>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>
<?php include('footer.php'); ?>
</html>
