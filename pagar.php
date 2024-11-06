<?php
session_start();
include("BD/conexion.php");
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
if (!isset($_SESSION['carrito'])){
  header('location: index.php');
	exit;
}
$stock = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>

<?php include("nav.php"); ?>
<?php
if (isset($_GET['id']) == 'pagar') {
  $total = 0;
  $id_usu = $_SESSION['info']['UsuarioID'];
  $Status_vent ='Pendiente';
  $datos_cart = $_SESSION['carrito'];
  $SID = session_id();
  foreach($datos_cart as $key => $row ){
    $total = $total + ($row['Precio']*$row['Cantidad']);
  }
//INSERTAR VENTA
  $insert_vent = $con->prepare("INSERT INTO tbventas(ClaveTrans,Total,Status_vent,UsuarioID) VALUES (?,?,?,?)");
  $insert_vent->bind_param("sdsi", $SID,$total,$Status_vent,$id_usu);
  $insert_vent->execute();
  $id_vent = $con->insert_id;

// INSERTAR DETALLE DE VENTA
  $datos_cart = $_SESSION['carrito'];
  foreach($datos_cart as $key => $row ){
    $sentencia = $con->prepare ("INSERT INTO tbdetalle_vent (id, ProductoID, Precio_unit, Cantidad) VALUES (?, ?, ?, ?)");
    $sentencia ->bind_param("iidi", $id_vent,$row['ProductoID'],$row['Precio'],$row['Cantidad']);
    $sentencia->execute();
  }
?>
<div style="display: flex;justify-content: center;">
<div class="alert alert-secondary text-center" role="alert" style="width:80%;margin: 20px;">
  <div class="container-fluid py-5">
    <form action="" method="get">
    <h1 class="alert-heading">¡Paso Final!</h1>
    <hr>
    <p class="mb-0">Estas a Punto de terminar el Pago
    <br>
    <br>
    <?php echo '<h4>'.number_format($total ,2,",",".").'</h4>'; ?>
    </p>
    <a href="confirm_fact.php?fact=confirm" class="btn btn-success">Pagar</a>
    </form>
  </div>
</div>
</div>
<?php
foreach($datos_cart as $key => $row ){
  $id = $row['ProductoID'];
  $sql = mysqli_query($con, "SELECT * FROM productos WHERE ProductoID='$id'");
  $key = mysqli_fetch_assoc($sql);
  $stock = $key['Stock'] - $row['Cantidad'];
  $update = $con->prepare ("UPDATE productos SET Stock = ? WHERE ProductoID = ?");
  $update ->bind_param("ii", $stock,$row['ProductoID']);
  $update->execute();
}
}else{
  header('location: carrito.php');
}
?>
<?php include('footer.php'); ?> 
</body>
</html>