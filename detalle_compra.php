<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>
<?php include('nav.php');?>
<div class="container">
<br>
<h2 style="text-align: center;">Detalle</h2>
<?php
$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
$sql = mysqli_query($con, "SELECT * FROM tbdetalle_vent WHERE id ='$nik'");
if(mysqli_num_rows($sql) == 0){

}else{
  echo ' <table class="table table-striped"><tr class="table-info"><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr>';
  while ($row = mysqli_fetch_assoc($sql)) {
    $id_product = "";
    $productoTotal = $row['Precio_unit'] * $row['Cantidad'];
    $id_product = $row['ProductoID'];
    $stmt = mysqli_prepare($con, "SELECT NombreProducto FROM productos WHERE ProductoID = ?");
    if ($stmt) {
    // Enlazar el parámetro (el tipo "i" indica un entero)
    mysqli_stmt_bind_param($stmt, "i", $id_product);
    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    // Obtener el resultado
    mysqli_stmt_bind_result($stmt, $nombre_producto);
    mysqli_stmt_fetch($stmt);
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
  }
    $total += $productoTotal;
    echo '<tr>';
  echo '<td>'.$nombre_producto.'</td>';
  echo '<td>$ '.number_format($row['Precio_unit'],2,",",".").'</td>';
  echo '<td style="display: flex; justify-content: center;" ><div>'.$row['Cantidad'].'</div></td>';
  echo '<td>$ '.number_format($productoTotal ,2,",",".").'</td>';
  echo '</tr>';
  }
echo '</table>';
echo '<p> Total Final :  $ '.number_format($total ,2,",",".").'</p>';
} 

?>
<form class="form-inline" method="get">
<div class="text-right mb-2">
  <a href="INVOICE/ReporteProductos.php?nik=<?php echo urlencode($nik); ?>" class="btn btn-info"><i class='bx bxs-file-pdf'></i> Generar PDF</a>
</div>
</form>
</div>

</body>
</html>