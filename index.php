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
    <link rel="stylesheet" href="CSS/index_style.css">
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

        <div class="container">
        
            <img src="imagenes/logopta.png" alt="raptor_arriba" width="20%" height="10%">
            <div class="cotiza">
                <h1>Elije tus gafas</h1>
                <p>Consigue los mejore estilos</p>
                <p>Mira al mundo de otra manera</p>
            </div>
       
    
        <section class="section1">
       <div class="texto1">
        <h2>Acerca de Nosotros</h2>
        <p>Somos una entidad online la cual se dedica ala venta de lentes de todo tipo ya sea solar, medico, de paseo, deporte u otro fin.</p>
        <p>Nos distinguimos por el cumplimiento a la hora de la compra y ante todo la legalidad, confianza la cual nos destaca a diferencia de los demas.</p>
       </div></section>
       </div>
    </center>
    
   
        <div class="container-imagen">
           <center> <b><h1>Lentes Destacados</h1></b>
    <img src="IMAGENES/gafa6.jpg" alt="" height="130px" >
    <img src="IMAGENES/gafa0.jfif" alt="" height="130px" >
    <img src="IMAGENES/gafa1.webp" alt="" height="180px" >
    <img src="IMAGENES/gafa3.webp" alt="" height="130px"><br>
    <img src="IMAGENES/gafa4.jpg" alt="" height="130px" >
    <img src="IMAGENES/gafa9.jfif" alt="" height="130px" >
    <img src="IMAGENES/gafa5.jpg" alt="" height="130px" >
    <img src="IMAGENES/gafa8.webp" alt="" height="180px" >
       </div></center>

    <center><iframe width="560" height="315" src="https://www.youtube.com/embed/ZcrgtR3P91Q?si=GHK4BzXQoa6Dm6yH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></center>
        <center>
        <img src="IMAGENES/OAKLEY.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/persol.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/platini_1.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/polo.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/giorgio.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/dolce_1.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/coach.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/bvlgari_1.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/armani.jpg" alt="" height="90px" width="110px">
        <img src="IMAGENES/jean-monnier.jpg" alt="" height="90px" width="110px"></center>
        
        <footer>
          
          <div class="container-footer">
        <section class="footer-section2">
      <div>
        <h1><span>Nuestros Servicios</span></h1>
      </div>
      <div>
        <ul>
          <li><a href="index.html">Inicio</a></li>
          <li><a href="index.html">Citas Medicas</a></li>
          <li><a href="index.html">Trabaja con nosotros</a></li>
          <li><a href="#ubicacion">Monturas</a></li>
         
        </ul>
      </div>
     
    </section>
    <section class="footer-section2">
      <div>
        <h1><span>Productos</span></h1>
        <div>
          <ul>
            <li><a href="#">Oakley</a></li>
            <li><a href="#">Persol</a></li>
            <li><a href="#">Platini</a></li>
            <li><a href="#">Polo Ralph Lauren</a></li>
            <li><a href="#">Giorgio Armani</a></li>
            <li><a href="#">Dolce & Gabbana</a></li>
            <li><a href="#">Coach</a></li>
            <li><a href="#">Bvlgari</a></li>
            <li><a href="#">A|X Armani Exchange</a></li>
            <li><a href="#">Jean Monnier</a></li>
          </ul>
        </div>
      </div>
    </section>
   
    <section class="footer-section3">
      <div>
        <h1><span>Siguenos</span></h1>
      </div>
      <div>
        <ul>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Facebook</a></li>
        </ul>
      </div>
    </section>
      </div>
  </footer>

    
</body>
</html>