<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="CSS/styles.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
 .container{
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
    margin: 0;
  }

  .center-container {
    text-align: center;
    background: #ffffff; /* Fondo blanco */
    padding: 30px;
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
    max-width: 400px;
    width: 90%; /* Adaptabilidad en pantallas pequeñas */
  }

  .center-container a {
    margin: 10px 0;
    padding: 15px;
    width: 100%; /* Botón ocupa el ancho del contenedor */
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease; /* Animación al interactuar */
  }

  .center-container a:hover {
    background-color: #007bff; /* Fondo más oscuro al pasar */
    color: #fff; /* Texto blanco */
    transform: translateY(-2px); /* Efecto "levitación" */
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
  }

  .btn-info {
    background-color: #17a2b8;
    color: white;
    border: none;
  }

  .btn-info:hover {
    background-color: #138496;
  }
</style>
</head>
<body>
<?php include('nav.php'); ?>
<div class="container">
<div class="center-container">
  <h3>Generar Reportes</h3>
  <a href="INVOICE/Reporte_can_citas.php" class="btn btn-info">Reporte Citas Canceladas</a>
  <a href="INVOICE/Reporte_ranking_product.php" class="btn btn-info">Reporte Productos Más Vendidos</a>
</div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
