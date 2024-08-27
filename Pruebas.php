
<?php
//$hoy = getdate();
//print_r($hoy);
$hoy = date("d/m/y");
print_r($hoy);
?>
<p>Hola, <?= $_SESSION['info']['Nombre']; ?> eres: <?= $_SESSION['info']['NombreRol']; ?></p>