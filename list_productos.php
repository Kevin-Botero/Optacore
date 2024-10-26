<?php
session_start();
// El isLogin es diferente de verdadero 
//El isset me verifica si existe algo ("!" El de exclamación me lo convierte en falso)
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
if ($_SESSION['info']['RolID'] <> "1") {
  header('location: index.php');
  exit;
}
include("BD/conexion.php");
$con_marca = mysqli_query($con, "SELECT * FROM marcas");
$marcas = [];
while ($nom_marca = mysqli_fetch_assoc($con_marca)) {
	$marcas[$nom_marca['MarcaID']] = $nom_marca['NombreMarca'];
}
$con_categoria = mysqli_query($con, "SELECT * FROM categorias");
$categorias = [];
while ($nom_categoria = mysqli_fetch_assoc($con_categoria)) {
	$categorias[$nom_categoria['CategoriaID']] = $nom_categoria['NombreCategoria'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/styles.css">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include('nav.php');?>
<div class="container">
<br>
<a href="form_producto.php" class="btn btn-info" style="width: 100%;">Agregar Producto</a>
<hr/>
<h2 style="text-align: center;">Inventario</h2>
<br>
<?php
if(isset($_GET['aksi']) == 'delete'){
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
	$cek = mysqli_query($con, "SELECT * FROM productos WHERE ProductoID ='$nik'");
	if(mysqli_num_rows($cek) == 0){
		echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
	}else{
		$delete = mysqli_query($con, "DELETE FROM productos WHERE ProductoID='$nik'");
		if($delete){
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>El producto ha sido eliminado correctamente.</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar el producto.</div>';
		}
	}
}
?>
<form class="form-inline" method="get">
</form>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
	<th>ProductoID</th>
	<th>Nombre</th>
	<th>Descripción</th>
	<th>Precio</th>
	<th>Cantidad en Stock</th>
	<th>Imagen</th>
	<th>Categoria</th>
	<th>Marca</th>
	<th>Descuento</th>
  <th>Acciones</th>
</tr>
<?php
$sql = mysqli_query($con, "SELECT * FROM productos ORDER BY ProductoID ASC");

if(mysqli_num_rows($sql) == 0){
    echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
while($row = mysqli_fetch_assoc($sql)){
    $nombreCategoria = isset($categorias[$row['CategoriaID']]) ? $categorias[$row['CategoriaID']] : 'Categoria no asignada';
    $nombreMarca = isset($marcas[$row['MarcaID']]) ? $marcas[$row['MarcaID']] : 'Marca no asignado';
    echo '
    <tr>
    <td>'.$row['ProductoID'].'</td>
    <td>'.$row['NombreProducto'].'</td>
    <td>'.$row['Descripcion'].'</td>
    <td>'. '$'.(number_format($row['Precio'],2,",",".")) .'</td>
    <td>'.$row['Stock'].'</td>
    <td>'.'<img src="data:' .  ';base64,' . base64_encode($row['Imagen']) . '" class="card-img-top" alt="Imagen">'.'</td>
    <td>'.$nombreCategoria.'</td>
    <td>'.$nombreMarca.'</td>
    <td>'.$row['Descuento'].'</td>
    <td>
    <a href="edit_product.php?nik='.$row['ProductoID'].'" title="Editar datos" class="btn btn-primary btn-sm"><i class="bx bx-up-arrow-circle bx-burst-hover" style="color:black"></i></a><a href="list_productos.php?aksi=delete&nik='.$row['ProductoID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar el Producto '.$row['NombreProducto'].'?\')" class="btn btn-danger btn-sm"><i class="bx bxs-trash bx-tada-hover" style="color:black"  ></i></a>
    </td>
    ';
}
	}
	?>
</table>

</div>
</div>
</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>