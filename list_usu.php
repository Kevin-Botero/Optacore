<?php
session_start();
// El isLogin es diferente de verdadero 
//El isset me verifica si existe algo ("!" El de exclamación me lo convierte en falso)
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
if ($_SESSION['info']['NombreRol'] <> "Administrador") {
  header('location: index.php');
  exit;
}
include("BD/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
		<?php include('nav.php');?>
	<div class="container">
		<div class="content">
			<h2>Lista de Usuarios</h2>
			<hr/>
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM usuarios WHERE UsuarioID ='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM usuarios WHERE UsuarioID='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>
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
					<th>Acciones</th>
				</tr>
				<?php
				$sql = mysqli_query($con, "SELECT * FROM usuarios ORDER BY UsuarioID ASC");
		
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
						<td>'.$row['UsuarioID'].'</td>
						<td>'.$row['Nombre'].'</td>
                        <td>'.$row['Apellido'].'</td>
                        <td>'.$row['Email'].'</td>
                        <td>'.$row['Telefono'].'</td>
                        <td>'.$row['Direccion'].'</td>
                        <td>'.$row['FechaRegistro'].'</td>
						<td>
						<a href="edit_usu.php?nik='.$row['UsuarioID'].'" title="Editar datos" class="btn btn-primary btn-sm"><i class="bx bx-up-arrow-circle bx-burst-hover" style="color:black"></i></a>
						<a href="list_usu.php?aksi=delete&nik='.$row['UsuarioID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Nombre'].'?\')" class="btn btn-danger btn-sm"><i class="bx bxs-trash bx-tada-hover" style="color:black"  ></i></a>
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
