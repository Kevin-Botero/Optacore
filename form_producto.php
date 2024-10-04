<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
if ($_SESSION['info']['RolID'] <> "1") {
  header('location: index.php');
  exit;
}
include("BD/conexion.php");
$consulta_categoria = mysqli_query($con, "SELECT * FROM categorias");
$consulta_marca = mysqli_query($con, "SELECT * FROM marcas");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/producto_style.css">
    <link rel="stylesheet" href="CSS/index_style.css">
   
</head>
<body>
<?php include("nav.php"); ?>
<br> 
<div class="form-container">
<div class="container">
    <div class="image">
        <img src="IMAGENES/logopta.png" alt="20%" height="" width="30%">
    </div>
    <h2>Agregar Producto</h2>
<?php
if(isset($_POST['submit'])){
$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["NombreProducto"],ENT_QUOTES)));//Escanpando caracteres
$descripcion		     = mysqli_real_escape_string($con,(strip_tags($_POST["Descripcion"],ENT_QUOTES)));//Escanpando caracteres
$precio		     = mysqli_real_escape_string($con,(strip_tags($_POST["Precio"],ENT_QUOTES)));//Escanpando caracteres 
$stock	 = mysqli_real_escape_string($con,(strip_tags($_POST["Stock"],ENT_QUOTES)));//Escanpando caracteres
$imagen		     = file_get_contents($_FILES['Imagen']['tmp_name']);//Capturando Imagen en Bits
$categoria	     = mysqli_real_escape_string($con,(strip_tags($_POST["id_categoria"],ENT_QUOTES)));//Escanpando caracteres
$marca	     = mysqli_real_escape_string($con,(strip_tags($_POST["id_marca"],ENT_QUOTES)));//Escanpando caracteres
$fecha	     = mysqli_real_escape_string($con,(strip_tags($_POST["FechaAgregado"],ENT_QUOTES)));//Escanpando caracteres
$descuento	     = mysqli_real_escape_string($con,(strip_tags($_POST["Descuento"],ENT_QUOTES)));//Escanpando caracteres

$insert = $con->prepare("INSERT INTO productos(NombreProducto,Descripcion,Precio,Stock,Imagen,CategoriaID,MarcaID,FechaAgregado,Descuento) VALUES(?,?,?,?,?,?,?,?,?)");
if ($insert) {
    $insert->bind_param("sssssssss", $nombre,$descripcion,$precio, $stock, $imagen, $categoria, $marca, $fecha, $descuento);
    if ($insert->execute()) {
        echo 'El producto a sido guardado con Exito';
    }else{
        echo 'Error al guardar el producto'; 
    }
    $insert->close();
}else{
    echo 'Error en la preparación de la consulta'.$con->error;
}        

}
?>
    <form action="" method="POST" enctype="multipart/form-data">

        <label for="NombreProducto">Nombre del Producto:</label>
        <input type="text" id="NombreProducto" name="NombreProducto" required>

        <label for="Descripcion">Descripción:</label>
        <input type="text" id="Descripcion" name="Descripcion" required>

        <label for="Precio">Precio:</label>
        <input type="number" id="Precio" name="Precio" step="0.01" required>

        <label for="Stock">Stock:</label>
        <input type="number" id="Stock" name="Stock" required>

        <label for="Imagen">Imagen del Producto:</label>
        <input type="file" id="Imagen" name="Imagen" required>

        <label for="CategoriaID">Categoría:</label>
        <select name="id_categoria" class="form-control" id="">
        <?php 
            while ($categoria = mysqli_fetch_assoc($consulta_categoria)) {
                echo '<option value="'.$categoria['CategoriaID'].'">'.$categoria['NombreCategoria'].'</option>';
            }
		?>   
		</select>

        <label for="MarcaID">Marca:</label>
        <select name="id_marca" class="form-control" id="">
        <?php 
            while ($marca = mysqli_fetch_assoc($consulta_marca)) {
                echo '<option value="'.$marca['MarcaID'].'">'.$marca['NombreMarca'].'</option>';
            }
		?>   
		</select>

        <label for="FechaAgregado">Fecha Agregado:</label>
        <input type="date" id="FechaAgregado" name="FechaAgregado" required>

        <label for="Descuento">Descuento:</label>
        <input type="number" id="Descuento" name="Descuento" step="0.01" required>

        <input type="submit" name="submit" value="Crear Producto">
        <input type="reset" value="Borrar Datos" class="reset-button">
    </form>
</div>

</body>
</html>