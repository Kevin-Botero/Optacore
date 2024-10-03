<?php
session_start();
include("BD/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="CSS/style.css">
  <link rel="stylesheet" href="CSS/index_style.css">
</head>
<?php include("nav.php"); 
$id = mysqli_real_escape_string($con,(strip_tags($_GET["id"],ENT_QUOTES)));//Escapando Caracteres
$sql = mysqli_query($con, "SELECT * FROM productos WHERE ProductoID='$id'");
$row = mysqli_fetch_assoc($sql);
?>
<body>
<div>
<form action="carrito.php" class="container" style="box-shadow: 4px 4px 12px rgba(1, 1, 1, 0.1);">
<div id="form_wrapper">
<div class="border-right" style="display: flex;align-items: center; "> 
<?php echo '<img src="data:' .  ';base64,' . base64_encode($row['Imagen']) . '" class="card-img-top" alt="Imagen">';?>
</div>
<div id="form_right">
<h1><?php echo $row['NombreProducto'] ?></h1>
<h3>Descripción</h3>
<h6><?php echo $row['Descripcion'] ?></h6>
<div style="text-align: center;"><h3>Precio</h3><p>$ <?php echo number_format($row['Precio'],2,",",".");?></p></div>
<div style="text-align: center;"><?php echo '<a href="agregar.php?id='. $row ['ProductoID'].'" class="btn btn-primary">Agregar al Carrito</a>';?></div>

</div>
</div>
</form>
</div>
</body>
<?php include('footer.php'); ?>
</html>
