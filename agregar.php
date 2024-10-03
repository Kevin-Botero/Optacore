<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$id = mysqli_real_escape_string($con,(strip_tags($_GET['id'],ENT_QUOTES)));
$consulta = mysqli_query($con, "SELECT * FROM productos WHERE ProductoID='$id'");
if(mysqli_num_rows($consulta) == 0){
  header("Location: index.php");
}else{
  $row = mysqli_fetch_assoc($consulta);
  if (!isset($_SESSION['carrito'])) {
    $datos_cart[0]['ProductoID'] = $row['ProductoID'];
    $datos_cart[0]['NombreProducto'] = $row['NombreProducto'];
    $datos_cart[0]['Cliente'] = $_SESSION['info'];
    $datos_cart[0]['Precio'] = $row['Precio'];
    $datos_cart[0]['Cantidad'] = 1;
    $datos_cart[0]['Imagen'] = $row['Imagen'];
    $datos_cart[0]['CategoriaID'] = $row['CategoriaID'];
    $datos_cart[0]['MarcaID'] = $row['MarcaID'];
    $datos_cart[0]['Descuento'] = $row['Descuento'];
    $_SESSION['carrito'] = $datos_cart;
  }else{
    $datos_cart = $_SESSION['carrito'];
    $cant = count($datos_cart);
    $datos_cart[$cant + 1]['ProductoID'] = $row['ProductoID'];
    $datos_cart[$cant + 1]['NombreProducto'] = $row['NombreProducto'];
    $datos_cart[$cant + 1]['Cliente'] = $_SESSION['info'];
    $datos_cart[$cant + 1]['Precio'] = $row['Precio'];
    $datos_cart[$cant + 1]['Cantidad'] = 1;
    $datos_cart[$cant + 1]['Imagen'] = $row['Imagen'];
    $datos_cart[$cant + 1]['CategoriaID'] = $row['CategoriaID'];
    $datos_cart[$cant + 1]['MarcaID'] = $row['MarcaID'];
    $datos_cart[$cant + 1]['Descuento'] = $row['Descuento'];
    $_SESSION['carrito'] = $datos_cart;
  }
}
header('location: carrito.php');
?>