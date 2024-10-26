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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="CSS/style.css">

</head>
<body>
<?php include("nav.php");?>
<center>
<div id="container" style="margin: 20px; width: 30%;">
<?php
if(isset($_POST['add'])){
  $nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));//Escanpando caracteres
  $documento		     = mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));//Escanpando caracteres
  $carnet		     = mysqli_real_escape_string($con,(strip_tags($_POST["carnet"],ENT_QUOTES)));//Escanpando caracteres 

$resultadosD = mysqli_query($con, "SELECT * FROM especialistas WHERE Documento = $documento ");
if($documento == $row['Documento']){
  $resultadosD = false;
}
$resultadosC = mysqli_query($con, "SELECT * FROM especialistas WHERE Carnet = $carnet ");
if($carnet == $row['Carnet']){
  $resultadosC = false;
}

if(($resultadosD === false || mysqli_num_rows($resultadosD) == 0) && ($resultadosC === false || mysqli_num_rows($resultadosC) == 0)){
  $insert = $con->prepare("INSERT INTO especialistas(Nombre,Documento,Carnet) VALUES(?,?,?)");
  if ($insert) {
  $insert->bind_param("sii", $nombre,$documento,$carnet);
  if ($insert->execute()) {
    $_SESSION['mensaje'] = "El Especialista ha sido registrado correctamente.";
    header("Location: list_especialistas.php");
    exit;
  }else{
    $_SESSION['mensaje'] = "Error, no se pudo guardar los datos.";
    header("Location: list_especialistas.php");
    exit;
  }
  $insert->close();
  }else{
    echo 'Error en la preparación de la consulta'.$con->error;
}
}else{
  $_SESSION['mensaje'] = "El Documento o carnet ya exite en la base de datos!";
  header("Location: list_especialistas.php");
  exit;
}
}	
?>
<form action="" method="post">
<h1>Registrar Especialista</h1>
<br>
<div class="input_container" style="padding: 15px;">
    <i class="fas fa-envelope"></i>
    <input placeholder="Nombre" type="text" name="name" id="field_name" class='input_field'>
</div>
<br>
<div class="input_container" style="padding: 15px;">
    <i class="fas fa-envelope"></i>
    <input placeholder="Documento" type="number" name="documento" id="field_apellido" class='input_field'>
</div>
<br>
<div class="input_container" style="padding: 15px;">
    <i class="fas fa-envelope"></i>
    <input placeholder="Carnet" type="number" name="carnet" id="field_email" class='input_field'>
</div>
<br>
<div class="submit">
<center><input type="submit" class="btn btn-sm btn-primary" name="add" value="Guardar"> <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a></center>
</div>
</form>
</div>
</center>  
</body>
</html>