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
$cons_vent = mysqli_query($con, "SELECT * FROM tbventas");
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
<hr/>
<h2>Lista de ventas</h2>
<hr/>
<form class="form-inline" method="get">
</form>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
	<th>UsuarioID</th>
	<th>Nombre</th>
	<th>Apellido</th>
	<th>Email</th>
	<th>Telefono</th>
	<th>Dirección</th>
	<th>Fecha de Registro</th>
	<th>Rol</th>
	<th>Acciones</th>
</tr>
	<?php
	$sql = mysqli_query($con, "SELECT * FROM usuarios ORDER BY UsuarioID ASC");

	if(mysqli_num_rows($sql) == 0){
		echo '<tr><td colspan="8">No hay datos.</td></tr>';
	}else{
			while($row = mysqli_fetch_assoc($sql)){
			$nombreRol = isset($roles[$row['RolID']]) ? $roles[$row['RolID']] : 'Rol no asignado';
			echo '
			<tr>
			<td>'.$row['UsuarioID'].'</td>
			<td>'.$row['Nombre'].'</td>
									<td>'.$row['Apellido'].'</td>
									<td>'.$row['Email'].'</td>
									<td>'.$row['Telefono'].'</td>
									<td>'.$row['Direccion'].'</td>
									<td>'.$row['FechaRegistro'].'</td>
									<td>'.$nombreRol.'</td>
			<td>
			<a href="edit_usu.php?nik='.$row['UsuarioID'].'" title="Editar datos" class="btn btn-primary btn-sm"><i class="bx bx-up-arrow-circle bx-burst-hover" style="color:black"></i></a><a href="list_usu.php?aksi=delete&nik='.$row['UsuarioID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Nombre'].'?\')" class="btn btn-danger btn-sm"><i class="bx bxs-trash bx-tada-hover" style="color:black"  ></i></a>
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
