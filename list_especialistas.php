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
$consulta = mysqli_query($con, "SELECT * FROM especialistas");
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de especialistas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="CSS/index_perfil.css">
    <link rel="stylesheet" href="CSS/stylescard.css">
<head>
<title>Lista de especialistas</title>
</head>
<body>
<?php include('nav.php');?>
<?php
if(isset($_GET['aksi']) == 'delete'){
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
	$cek = mysqli_query($con, "SELECT * FROM especialistas WHERE especialistaID ='$nik'");
    $cit = mysqli_query($con, "SELECT * FROM citas WHERE especialistaID ='$nik'");
	if(mysqli_num_rows($cek) == 0){
        $_SESSION['mensaje_error'] = " No se encontraron datos.";
        header("Location: list_especialistas.php");
        exit;
	}elseif(mysqli_num_rows($cit) > 0 ){
        $_SESSION['mensaje_error'] = " No se puede eliminar el Especialista, tiene citas aginadas.";
        header("Location: list_especialistas.php");
        exit;
    }else{
		$delete = mysqli_query($con, "DELETE FROM especialistas WHERE especialistaID='$nik'");
		if($delete){
            $_SESSION['mensaje'] = "El Especialista ha sido eliminado correctamente.";
            header("Location: list_especialistas.php");
            exit;
		}else{
            $_SESSION['mensaje_error'] = "Error, no se pudo eliminar el especialista";
            header("Location: list_especialistas.php");
            exit;
		}
	}
}
?>
<br>
<div class="container" style="padding-bottom: 30px;">
<br>
<a href="form_especialista.php" class="btn btn-info" style="width: 100%;">Agregar Especialista</a>
<br>
<br>
<h2 style="text-align: center;">Lista de especialistas</h2>
<ul>
<?php if (isset($_SESSION['mensaje'])) {
    echo '<div class="alert alert-success alert-dismissable">' . $_SESSION['mensaje'] . '</div>';
    unset($_SESSION['mensaje']);
}if (isset($_SESSION['mensaje_error'])) {
    echo '<div class="alert alert-danger alert-dismissable">' . $_SESSION['mensaje_error'] . '</div>';
    unset($_SESSION['mensaje_error']);
} ?>
<table class="table table-striped table-hover">
<thead>
<tr>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>CEDULA</th>
    <th>CARNET</th>
    <th>ESTADO</th>
    <th>ACCIONES</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$sql = mysqli_query($con, "SELECT * FROM especialistas ORDER BY especialistaID ASC");

if(mysqli_num_rows($sql) == 0){
    echo '<tr><td colspan="8">No hay datos.</td></tr>';
}else{
    while($row = mysqli_fetch_assoc($sql)){
    echo '
    <tr>
    <td>'.$row['especialistaID'].'</td>
    <td>'.$row['Nombre'].'</td>
    <td>'.$row['Documento'].'</td>
    <td>'.$row['Carnet'].'</td>
    <td>'.$row['Estado'].'</td>
    <td>
    <a href="edit_especialistas.php?nik='.$row['especialistaID'].'" title="Editar datos" class="btn btn-primary btn-sm"><i class="bx bx-up-arrow-circle bx-burst-hover" style="color:black"></i></a><a href="list_especialistas.php?aksi=delete&nik='.$row['especialistaID'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Nombre'].'?\')" class="btn btn-danger btn-sm"><i class="bx bxs-trash bx-tada-hover" style="color:black"  ></i></a>
    </td>
    ';
    }
}
?>
</tr>
</tbody>
</table>
</div>
</body>
</html>