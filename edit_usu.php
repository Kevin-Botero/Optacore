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

$consulta = mysqli_query($con, "SELECT * FROM roles");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
  crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="CSS/style.css">
  <title>Editar Usuario</title>
</head>
<?php include("nav.php"); ?>
<body id="body">
  <br>
  <?php
    $nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));//Escapando Caracteres
    $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE UsuarioID='$nik'");
    if(mysqli_num_rows($sql) == 0){
     header("Location: index.php");
    }else{
      $row = mysqli_fetch_assoc($sql);
    }
    if(isset($_POST['update'])){
  $name		     = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));//Escanpando caracteres
  $apellido		     = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));//Escanpando caracteres
  $email		     = mysqli_real_escape_string($con,(strip_tags($_POST["Email"],ENT_QUOTES)));//Escanpando caracteres 
  $telefono		     = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
  $direccion		     = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));//Escanpando caracteres 
  $id_rol		= intval(mysqli_real_escape_string($con,(strip_tags($_POST["id_rol"],ENT_QUOTES))));//Escanpando caracteres

  $resultados = mysqli_query($con, "SELECT * FROM usuarios WHERE Email='$email'");
  //Validamos si el email es el mismo que tiene el usuario en la base de datos
  if($email == $row['Email']){
    $resultados = 0;
  }
  if(mysqli_num_rows($resultados) == 0 ){
    $update = mysqli_query($con, "UPDATE usuarios SET Nombre ='$name', Apellido='$apellido', Email='$email',  Telefono=$telefono, Direccion='$direccion', RolID='$id_rol' WHERE UsuarioID='$nik'") or die(mysqli_error($con));
    if($update){
      header("Location: edit_usu.php?nik=".$nik."&pesan=sukses");
    }else{
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
    }
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>El email ya exite en la base de datos!</div>';
  }
}

if(isset($_GET['pesan']) == 'sukses'){
  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
}
  ?>
<div id="form_wrapper">
<div id="form_left">
  <img src="IMAGENES/Edit.jpeg" alt="computer icon">
</div>
<div id="form_right">
<h1>Editar</h1>
<form action="" method="post">
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <input placeholder="Nombre" type="text" name="name" id="field_name" value="<?php echo $row['Nombre'] ?>" class='input_field' required>
    </div>
    <br>
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <input placeholder="Apellido" type="text" name="apellido" id="field_apellido" value="<?php echo $row['Apellido'] ?>" class='input_field' required>
    </div>
    <br>
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <input placeholder="Email" type="email" name="Email" id="field_email" value="<?php echo $row['Email'] ?>" class='input_field' required>
    </div>
    <br>
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <input placeholder="Telefono" type="number" name="telefono" id="field_telefono" value="<?php echo $row['Telefono'] ?>" class='input_field' required>
    </div>
    <br>
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <input placeholder="Direccion" type="adress" name="direccion" id="field_direccion" value="<?php echo $row['Direccion'] ?>" class='input_field' required>
    </div>
    <br>
    <div class="input_container">
        <i class="fas fa-envelope"></i>
        <select name="id_rol" id="" required>
        <?php 
								while ($rol = mysqli_fetch_assoc($consulta)) {
									$selected = ($rol['RolID'] == $row['RolID']) ? 'selected' : '';
									echo '<option value="'.$rol['RolID'].'" '.$selected.'>'.$rol['NombreRol'].'</option>';
								}
							?>
        </select>
    </div>
    <br>
      <center><input type="submit" name="update" class="btn btn-sm btn-primary" value="Guardar datos"><a href="index.php" class="btn btn-sm btn-danger">Cancelar</a></center>
</form>
</div>
</div>
</body>
</html>