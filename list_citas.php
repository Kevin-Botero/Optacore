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
$consulta_espe = mysqli_query($con, "SELECT * FROM especialistas");
$especialistas = [];
while ($espe = mysqli_fetch_assoc($consulta_espe)) {
	$especialistas[$espe['especialistaID']] = $espe['Nombre']; // Guardar los roles en un array asociativo con RolID como clave
}
$consulta_hora = mysqli_query($con, "SELECT * FROM horas");
$horas = [];
while ($hora = mysqli_fetch_assoc($consulta_hora)) {
	$horas[$hora['id_hora']] = $hora['hora']; // Guardar los roles en un array asociativo con RolID como clave
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/styles.css">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include('nav.php');?>
<?php
if(isset($_GET['aksi']) == 'delete'){
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
	$cek = mysqli_query($con, "SELECT * FROM citas WHERE CitaID ='$nik'");
	if(mysqli_num_rows($cek) == 0){
        $_SESSION['mensaje'] = " No se encontraron datos.";
        header("Location: list_citas.php");
        exit;
	}else{
		$delete = mysqli_query($con, "DELETE FROM citas WHERE CitaID='$nik'");
		if($delete){
            $_SESSION['mensaje'] = "La cita ha sido eliminada correctamente.";
            header("Location: list_citas.php");
            exit;
		}else{
            $_SESSION['mensaje'] = "Error, no se pudo eliminar la cita";
            header("Location: list_citas.php");
            exit;
		}
	}
}
?>
<div class="container">
<br>
<a href="form_cita.php" class="btn btn-info" style="width: 100%;">Programar Cita</a>
<hr/>
<h2 style="text-align: center;">Citas</h2>
<?php 
if (isset($_SESSION['mensaje'])) {
echo '<div class="alert alert-success alert-dismissable">' . $_SESSION['mensaje'] . '</div>';
unset($_SESSION['mensaje']);  
}
?>
<form class="form-inline" method="get">
</form>
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
	<th>CitaID</th>
	<th>Fecha</th>
	<th>Hora</th>
	<th>Nombre</th>
	<th>Documento</th>
	<th>Motivo</th>
	<th>Estado Cita</th>
	<th>Especialista</th>
  <th>Acciones</th>
</tr>
	<?php
	$sql = mysqli_query($con, "SELECT * FROM citas ORDER BY CitaID ASC");

	if(mysqli_num_rows($sql) == 0){
		echo '<tr><td colspan="8">No hay datos.</td></tr>';
	}else{
			while($row = mysqli_fetch_assoc($sql)){
			$nombre_espe = isset($especialistas[$row['especialistaID']]) ? $especialistas[$row['especialistaID']] : 'Error Nombre de Especialista';
      $dato_hora = isset($horas[$row['id_hora']]) ? $horas[$row['id_hora']] : 'Rol no asignado';
			echo '
			<tr>
			<td>'.$row['CitaID'].'</td>
			<td>'.$row['FechaCita'].'</td>
			<td>'.$dato_hora.'</td>
			<td>'.$row['Nombre'].'</td>
			<td>'.$row['Documento'].'</td>
			<td>'.$row['MotivoCita'].'</td>
			<td>'.$row['EstadoCita'].'</td>
			<td>'.$nombre_espe.'</td>
      <td>
			<a href="edit_cita.php?nik='.$row['CitaID'].'" title="Editar datos" class="btn btn-primary btn-sm"><i class="bx bx-up-arrow-circle bx-burst-hover" style="color:black"></i></a><a href="list_citas.php?aksi=delete&nik='.$row['CitaID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar la cita de '.$row['Nombre'].'?\')" class="btn btn-danger btn-sm"><i class="bx bxs-trash bx-tada-hover" style="color:black"  ></i></a>
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