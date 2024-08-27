<?php
session_start();

include("BD/conexion.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include("nav.php");?>
    <section>
        <center>
            <marquee behavior="" direction="left" scrollamount="14">
                <p class="ve">
                    CALIDAD Y EXCLUSIVIDAD A UN CLICK 
                </p>
            </marquee>
    </section>
    <div class="container">
        <h1 class="text-center my-4">Bienvenido a Optacore</h1>
        <!-- Contenido de la página principal -->
    </div>


    <center>

        
        <div class="caja1">
            <img src="imagenes/logopta.png" alt="raptor_arriba" width="30%" height="20%">
            <div class="cotiza">
                <h1>Elije tus gafas</h1>
                <p>Consigue los mejore estilos</p>
                <p>Mira al mundo de otra manera</p>
            </div>
        </div>
    

    </center>

    
</body>
</html>