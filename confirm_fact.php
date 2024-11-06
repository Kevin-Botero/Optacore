<?php
session_start();
if (!isset($_SESSION['carrito'])){
  header('location: index.php');
	exit;
}
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>
<div style="display: flex; justify-content: center; width:auto;"><div style="width:80%; margin:10px;">
<?php
if (isset($_GET['fact']) == 'confirm'){
$datos_cart = $_SESSION['carrito'];
echo ' <table class="table table-bordered"><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th>';
foreach($datos_cart as $key => $row ){
  $productoTotal = $row['Precio'] * $row['Cantidad'];
  $total += $productoTotal;
  
  echo '<tr>';
  echo '<td>'.$row['NombreProducto'].'</td>';
  echo '<td>$ '.number_format($row['Precio'],2,",",".").'</td>';
  echo '<input type="hidden" name="product_id" value="'.$key.'">';
  echo '<td style="display: flex; justify-content: center;" ><div>'.$row['Cantidad'].'</div></td>';
  echo '<td>$ '.number_format($productoTotal ,2,",",".").'</td>';
  echo '</tr>';
}
echo '<td colspan="4"><b>Correo de Facturación: </b>'.$_SESSION['info']['Email'].'</td>';
echo '</table>';
echo '<p> Total Final :  $ '.number_format($total ,2,",",".").'</p>';
if (isset($_SESSION['carrito'])){
unset($_SESSION['carrito']);
session_regenerate_id();
}
}
if (isset($_GET['fact']) == 'confirm'){
  header('location: list_compras.php');
}
?>
</div></div>
</body>
</html>