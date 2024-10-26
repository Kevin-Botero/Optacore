<?php
session_start();
// El isLogin es diferente de verdadero 
//El isset me verifica si existe algo ("!" El de exclamación me lo convierte en falso)
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$usu = $_SESSION['info']['UsuarioID'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/styles.css">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php include('nav.php');?>
<div class="container">
<hr/>
<h2 style="text-align: center;">Lista de Compras</h2>
<form class="form-inline" method="get">
<div class="table-responsive">
<table class="table table-striped table-hover">
<tr>
  <th style="text-align: center;" hidden>ID</th>
	<th style="text-align: center;">Clave de Transaccion</th>
	<th style="text-align: center;">Total</th>
  <th style="text-align: center;">Detalles</th>
</tr>
	<?php
	$cons_com = mysqli_query($con, "SELECT * FROM tbventas WHERE UsuarioID='$usu'");

	if(mysqli_num_rows($cons_com) == 0){
		echo '<tr><td colspan="8">No hay datos.</td></tr>';
	}else{
			while($row = mysqli_fetch_assoc($cons_com)){
			$email_usu = isset($usuarios[$row['UsuarioID']]) ? $usuarios[$row['UsuarioID']] : 'Error Email';
			echo '
			<tr>
      <td style="text-align: center;" hidden>'.$row['id'].'</td>
			<td style="text-align: center;">'.$row['ClaveTrans'].'</td>
			<td style="text-align: center;">$ ' .number_format($row['Total'] ,2,",",".").'</td>
      <td style="text-align: center;"><a href="detalle_compra.php?nik='.$row['id'].'" title="Detalles" class="btn btn-primary btn-sm"><i class="bx bx-right-arrow-alt"></i></a></td>';
		}
	}
	?>
</table>
</form>
</div>
</div>
</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
