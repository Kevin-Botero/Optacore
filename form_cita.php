<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$consulta_hora = mysqli_query($con, "SELECT * FROM horas");
$consulta_especialista = mysqli_query($con, "SELECT * FROM especialistas WHERE Estado = 'Activo' ");

$mostrarInput = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar</title>
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
    <h2>Reservar Cita</h2>
<?php
$fechaseleccionada = "";
$todasLasHoras = [];
$horasNoDisponibles = [];
$horaslibres =[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['Date']) && !empty($_POST['Especialista'])) {
  $fechaSeleccionada = $_POST['Date'];
  $especialistaID = $_POST['Especialista'];
  $mostrarInput = true;

  $consulta = $con->prepare("SELECT id_hora FROM citas WHERE FechaCita = ? AND especialistaID = ? AND EstadoCita != 'Cancelada'");
  $consulta->bind_param ("si", $fechaSeleccionada,$especialistaID);
  $consulta->execute();
  $resultado = $consulta->get_result();

  while ($fila = $resultado->fetch_assoc()) {
    $horasNoDisponibles[] = $fila['id_hora'];
}

while ($time = mysqli_fetch_assoc($consulta_hora)) {
  $todasLasHoras[$time['id_hora']] = $time['hora']; // Almacena id_hora como clave y la hora como valor
}

$horasLibres = array_diff(array_keys($todasLasHoras), $horasNoDisponibles);

}
}

if(isset($_POST['submit'])){
$date		     = mysqli_real_escape_string($con,(strip_tags($_POST["Date"],ENT_QUOTES)));//Escanpando caracteres
$id =       $_SESSION['info']['UsuarioID'];
$time		     = mysqli_real_escape_string($con,(strip_tags($_POST["time"],ENT_QUOTES)));//Escanpando caracteres
$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));//Escanpando caracteres 
$doc	 = mysqli_real_escape_string($con,(strip_tags($_POST["Doc"],ENT_QUOTES)));//Escanpando caracteres
$esp     = mysqli_real_escape_string($con,(strip_tags($_POST["Especialista"],ENT_QUOTES)));//Escanpando caracteres
$movito	     = mysqli_real_escape_string($con,(strip_tags($_POST["Motivo"],ENT_QUOTES)));//Escanpando caracteres
$estado = "Pendiente";



$insert_cita = $con->prepare("INSERT INTO citas(UsuarioID,FechaCita,id_hora,Nombre,Documento,MotivoCita,EstadoCita,especialistaID) VALUES (?,?,?,?,?,?,?,?)");
  $insert_cita->bind_param("isisissi", $id,$date,$time,$nombre,$doc,$movito,$estado,$esp);
if ($insert_cita->execute()) {
  $_SESSION['mensaje'] = "La cita ha sido reservada con éxito.";
  header("Location: form_cita.php");
  exit;
}else{
  echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>! Error, no se pudo reservar la cita.</div>';
}
  
}
if (isset($_SESSION['mensaje'])) {
  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $_SESSION['mensaje'] . '</div>';
  unset($_SESSION['mensaje']);
}

?>
<form action="" method="POST" enctype="multipart/form-data">

<label>Fecha:</label>
<input type="date" id="" name="Date" value="<?php echo htmlspecialchars($fechaSeleccionada); ?>" required <?php if ($mostrarInput == true) {
  echo 'readonly';
} ?> >

<label >Especialista:</label>
<select name="Especialista" class="form-control" id="" <?php if ($mostrarInput == true) {
  echo 'readonly';
} ?> >
<?php 
  while ($especialista = mysqli_fetch_assoc($consulta_especialista)) {
    $selected = ($especialista['especialistaID']) == $especialistaID ? 'selected' : '';
    echo '<option value="'.$especialista['especialistaID'].'" '.$selected.'>'.$especialista['Nombre'].'</option>';
  }
?>   
</select>

<?php
if ($mostrarInput == true) { ?>

<label>Hora:</label>
<select name="time" class="form-control" id="">
<?php 
foreach ($horasLibres as $id_hora){ ?>
<option value="<?php echo $id_hora; ?>"><?php echo htmlspecialchars($todasLasHoras[$id_hora]); ?></option>
<?php                    
}
?>   
</select>

<label>Nombre:</label>
<input type="text" id="" name="Nombre" required>

<label>Documento:</label>
<input type="number" id="" name="Doc" required>

<label>Motivo:</label>
<select name="Motivo" id="">
  <option value="Evaluación de la agudeza visual">Evaluación de la agudeza visual</option>
  <option value="Refraccion">Refracción</option>
  <option value="Terapia Visual">Terapia Visual</option>
</select>
<br>
<br>
  <input type="submit" name="submit" value="Reservar">
  <input type="reset" value="Borrar" class="reset-button">
</form>

<?php } ?>
<br>
<br>
<?php
if ($mostrarInput == false) { ?>
  <input type="submit" name="select" value="Guardar">
  <input type="reset" value="Borrar" class="reset-button">
<?php } ?>
</div>

</body>
</html>