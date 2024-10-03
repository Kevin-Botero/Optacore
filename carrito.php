<?php
session_start();
include("BD/conexion.php");
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
if (isset($_POST['add']) || isset($_POST['down'])) {
    $productId = $_POST['product_id'];
    $action = isset($_POST['add']) ? 'add' : 'down';

    if (isset($_SESSION['carrito'][$productId])) {
        if ($action == 'add') {
            $_SESSION['carrito'][$productId]['Cantidad']++;
        } elseif ($action == 'down' && $_SESSION['carrito'][$productId]['Cantidad'] > 1) {
            $_SESSION['carrito'][$productId]['Cantidad']--;
        }
    }
}
if (isset($_POST['remove'])) {
    $removeProductId = $_POST['product_id'];
    unset($_SESSION['carrito'][$removeProductId]);
    if (empty($_SESSION['carrito'])) {
        unset($_SESSION['carrito']);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>

<?php include("nav.php"); ?>
<form action="" method="post">
<center>
<div style="width: 80%; margin: 10px; padding: 5px; text-align:center;">
<?php
$total = 0;
if (isset($_SESSION['carrito'])) {
    $datos_cart = $_SESSION['carrito'];
    echo ' <table class="table table-bordered" ><th> Imagen del Producto</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th>';
    foreach($datos_cart as $key => $row ){
        $productoTotal = $row['Precio'] * $row['Cantidad'];
        $total += $productoTotal;
        
        echo '<tr><td style="text-align:center;"><img src="data:' .  ';base64,' . base64_encode($row['Imagen']) . '" class="card-img-top" style="width: 120px;" alt="Imagen"></td>';
        echo '<td>'.$row['NombreProducto'].'</td>';
        echo '<td>$ '.number_format($row['Precio'],2,",",".").'</td>';
        echo '<form action="" method="post" style="display:inline;">';
        echo '<input type="hidden" name="product_id" value="'.$key.'">';
        echo '<td style="display: flex; justify-content: center;" ><div style="padding: 3px; border: black, 1px, solid; margin: 3px; width:50%;">'.$row['Cantidad'].'</div><input type="submit" value="+" name="add" class="btn btn-info"><input type="submit" value="-" name="down" class="btn btn-danger">'.'</td>';
        echo '<td>'.number_format($productoTotal ,2,",",".").'</td>';
        echo '<td><input type="submit" value="Eliminar" name="remove" class="btn btn-danger"></td>';
        echo '</form>';
        
        echo '</tr>';
    }
    echo '</table>';
    echo '<p> Total Final :  $ '.number_format($total ,2,",",".").'</p>';
    echo '<a href="pagar.php?id=pagar" name="pagar" class="btn btn-success">Comprar</a>';
}else{
    echo 'No hay productos en el carrito';
}
?>
</div></center>
</form>
<?php include('footer.php'); ?> 

</body>
</html>