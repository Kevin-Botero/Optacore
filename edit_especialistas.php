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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="CSS/index_perfil.css">
<link rel="stylesheet" href="CSS/index_style.css">
</head>
<?php include("nav.php"); ?>
<body>
<?php
$resultados = "";
$resultadosD = "";
$resultadosC = "";
$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));//Escapando Caracteres
$sql = mysqli_query($con, "SELECT * FROM especialistas WHERE especialistaID='$nik'");
if($sql === false || mysqli_num_rows($sql) == 0){
    header("Location: index.php");
}else{
    $row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update'])){
$name		     = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));//Escanpando caracteres
$documento		     = mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));//Escanpando caracteres
$carnet		     = mysqli_real_escape_string($con,(strip_tags($_POST["carnet"],ENT_QUOTES)));//Escanpando caracteres
$estado		     = mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres

$resultadosD = mysqli_query($con, "SELECT * FROM especialistas WHERE Documento = $documento ");
if($documento == $row['Documento']){
  $resultadosD = false;
}
$resultadosC = mysqli_query($con, "SELECT * FROM especialistas WHERE Carnet = $carnet ");
if($carnet == $row['Carnet']){
  $resultadosC = false;
}
if(($resultadosD === false || mysqli_num_rows($resultadosD) == 0) && ($resultadosC === false || mysqli_num_rows($resultadosC) == 0)){
    $update = $con->prepare("UPDATE especialistas SET Nombre=?, Documento=?, Carnet=?, Estado=? WHERE especialistaID=?");
    $update->bind_param("siisi", $name, $documento, $carnet, $estado, $nik);
    if ($update->execute()) {
        $_SESSION['mensaje'] = "Los datos han sido guardados con éxito.";
        header("Location: list_especialistas.php");
        exit;
    }else{
        $_SESSION['mensaje'] = "Error, no se pudo guardar los datos.";
        header("Location: list_especialistas.php");
        exit;
    }
}else{
    $_SESSION['mensaje'] = "El Documento o carnet ya exite en la base de datos!";
    header("Location: list_especialistas.php");
    exit;
}

    
}
?>
<div class="container rounded bg-white mt-5 mb-5">
<div class="row">
<div class="col-md-3 border-right">
<div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></div>
</div>
<div class="col-md-5 border-right">
<div class="p-3 py-5">
<div class="d-flex justify-content-between align-items-center mb-3">
<h4 class="text-right">ESPECIALISTAS</h4>
</div>
<form action="" method="post">
<div class="row mt-2">
<div class="col-md-6">
    <label class="labels">NOMBRE</label>
    <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $row['Nombre'] ?>">
</div>
</div>
<div class="row mt-3">
<div class="col-md-12">
    <label class="labels">DOCUMENTO</label>
    <input type="number" class="form-control" name="documento" placeholder="" value="<?php echo $row['Documento'] ?>">
</div>
<div class="col-md-12">
    <label class="labels">CARNET</label>
    <input type="number" class="form-control" name="carnet" placeholder="" value="<?php echo $row['Carnet'] ?>">

    <label class="labels">ESTADO</label>
    <select class="form-control" name="estado" id="">
        <option value="Activo" <?php echo ($row['Estado'] == 'Activo') ? 'selected' : ''; ?>>Activo</option>
        <option value="Inactivo" <?php echo ($row['Estado'] == 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
    </select>

    <br>
    <center><input type="submit" name="update" class="btn btn-sm btn-primary" value="Actualizar datos"><a href="index.php" class="btn btn-sm btn-danger">Cancelar</a></center>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>  
</body>
</html>