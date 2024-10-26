<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$consulta_hora = mysqli_query($con, "SELECT * FROM horas");
$consulta_especialista = mysqli_query($con, "SELECT * FROM especialistas");

$mostrarInput = false;

if ($_SESSION['info']['RolID'] <> "1") {
  header('location: index.php');
  exit;
}

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
<style>
.disabled-select {
background-color: #f0f0f0; /* Color de fondo para indicar que está deshabilitado */
pointer-events: none; /* No permite interacción */
color: #666; /* Color del texto para indicar que está deshabilitado */
}
</style>
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
$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));//Escapando Caracteres
$sql = mysqli_query($con, "SELECT * FROM Citas WHERE CitaID='$nik'");
if($sql === false || mysqli_num_rows($sql) == 0){
    header("Location: index.php");
}else{
    $row = mysqli_fetch_assoc($sql);
}

$fechaseleccionada = "";
$todasLasHoras = [];
$horasNoDisponibles = [];
$horaslibres =[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['date']) && !empty($_POST['especialista'])) {
  $fechaSeleccionada = mysqli_real_escape_string($con,(strip_tags($_POST["date"],ENT_QUOTES)));//Escanpando caracteres
  $especialistaID = mysqli_real_escape_string($con,(strip_tags($_POST["especialista"],ENT_QUOTES)));//Escanpando caracteres
  $mostrarInput = true;
  $consulta = $con->prepare("SELECT id_hora FROM citas WHERE FechaCita = ? AND especialistaID = ?");
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

if(isset($_POST['update'])){
$date		     = mysqli_real_escape_string($con,(strip_tags($_POST["date"],ENT_QUOTES)));//Escanpando caracteres
$time		     = mysqli_real_escape_string($con,(strip_tags($_POST["time"],ENT_QUOTES)));//Escanpando caracteres
$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));//Escanpando caracteres 
$doc	 = mysqli_real_escape_string($con,(strip_tags($_POST["Doc"],ENT_QUOTES)));//Escanpando caracteres
$esp     = mysqli_real_escape_string($con,(strip_tags($_POST["especialista"],ENT_QUOTES)));//Escanpando caracteres
$movito	     = mysqli_real_escape_string($con,(strip_tags($_POST["Motivo"],ENT_QUOTES)));//Escanpando caracteres
$estado =  mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));//Escanpando caracteres

$update_cita = $con->prepare("UPDATE citas SET FechaCita=?, id_hora=?, Nombre=?, Documento=?, MotivoCita=?, EstadoCita=?, especialistaID=? WHERE CitaID=? ");
$update_cita->bind_param("sisissii", $date,$time,$nombre,$doc,$movito,$estado,$esp,$nik);
if ($update_cita->execute()) {
  $_SESSION['mensaje'] = "La cita ha sido actualizada y reservada con éxito.";
  header("Location: list_citas.php");
  exit;
}else{
  $_SESSION['mensaje'] = "! Error, no se pudo reservar la cita.";
  header("Location: list_citas.php");
  exit;
}
  
}
?>
<form action="" method="POST" enctype="multipart/form-data">

<label>Fecha:</label>
<input type="date" id="" name="date" 
  <?php
  if($mostrarInput == false){
    echo 'value="'.$row['FechaCita'].'" required';
  }else{
    echo 'value="'.htmlspecialchars($fechaSeleccionada).'" required readonly';
  }
  ?> >
<label>Especialista:</label>
<?php if ($mostrarInput){ ?>
<select name="especialista" class="form-control disabled-select" required >
<?php
  while ($especialista = mysqli_fetch_assoc($consulta_especialista)) {
    $selected = ($especialista['especialistaID'] ==   $especialistaID) ? 'selected' : '';
    echo '<option value="'.$especialista['especialistaID'].'" '.$selected.'>'.$especialista['Nombre'].'</option>';
  }
?>
</select>
<?php }else{ ?>
<select name="especialista" class="form-control" required>
<?php
// Reinicia el puntero del resultado de la consulta de especialistas para poder recorrerla nuevamente
mysqli_data_seek($consulta_especialista, 0);
while ($especialista = mysqli_fetch_assoc($consulta_especialista)) {
    $selected = ($especialista['especialistaID'] == $row['especialistaID']) ? 'selected' : '';
    echo '<option value="'.$especialista['especialistaID'].'" '.$selected.'>'.$especialista['Nombre'].'</option>';
}
?>
</select>
<?php } ?>
<?php if ($mostrarInput){ ?>
<label>Hora:</label>
<select name="time" class="form-control" id="">
<?php 
// Convertir el valor de hora seleccionada desde la BD a entero para comparar
$selectedHoraId = (int) $row['id_hora'];

// Si la hora seleccionada está en la lista de horas ocupadas, la añadimos temporalmente a las horas libres
if (!in_array($selectedHoraId, $horasLibres)) {
    $horasLibres[] = $selectedHoraId;
    // Ordenar las horas para que aparezcan en orden en el select
    sort($horasLibres);
}

foreach ($horasLibres as $id_hora) { 
    // Aseguramos que la comparación sea entre enteros
    $id_hora_int = (int) $id_hora;
    $selected_hora = ($id_hora_int === $selectedHoraId) ? 'selected' : '';
?>
  <option value="<?php echo $id_hora_int; ?>" <?php echo $selected_hora; ?>>
      <?php echo htmlspecialchars($todasLasHoras[$id_hora_int]); ?>
  </option>
<?php                    
}
?>   
</select>
<label>Nombre:</label>
<input type="text" id="" name="Nombre" value="<?php echo $row['Nombre'] ?>" required>

<label>Documento:</label>
<input type="number" id="" name="Doc" value="<?php echo $row['Documento'] ?>" required>

<label>Motivo:</label>
<select name="Motivo" id="">
  <option value="Evaluación de la agudeza visual" <?php echo ($row['MotivoCita'] == 'Evaluación de la agudeza visual') ? 'selected' : ''; ?> >Evaluación de la agudeza visual</option>
  <option value="Refraccion" <?php echo ($row['MotivoCita'] == 'Refraccion') ? 'selected' : ''; ?> >Refracción</option>
  <option value="Terapia Visual" <?php echo ($row['MotivoCita'] == 'Terapia Visual') ? 'selected' : ''; ?> >Terapia Visual</option>
</select>
<br>
<br>
<?php
if ($_SESSION['info']['RolID'] == "1") {
  echo'
  <label>Estado:</label>
  <select name="estado" id="">
  <option value="Pendiente">Pendiente</option>
  <option value="Cancelada">Cancelada</option>
  <option value="Finalizada">Finalizada</option>
  </select>
  ';
}
?>
<br>
<br>
  <input type="submit" name="update" value="Actualizar">
  <input type="reset" value="Borrar" class="reset-button">
</form>

<?php } ?>
<br>
<br>
<?php
if ($mostrarInput == false) { ?>
  <input type="submit" name="select" value="Continuar">
  <input type="reset" value="Cancelar" class="reset-button">
<?php } ?>
</div>
</body>
</html>