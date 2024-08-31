<?php
session_start();
include("BD/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="CSS/style.css">
</head>
<?php include("nav.php"); ?>

<body>
  <form action="LOGIN/verif_usu.php" method="post">
    <div id="form_wrapper">
      <div id="form_left">
        <img src="IMAGENES/cara-de-hombre-con-gafas-y-perilla.png" alt="computer icon">
      </div>
      <div id="form_right">
        <h1>BIENVENIDO</h1>
        <?php
        if (isset($_SESSION['error_msg'])) {
          echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $_SESSION['error_msg'] . '</div>';
          unset($_SESSION['error_msg']);
        }
        ?>
        <div class="input_container">
          <i class="fas fa-envelope"></i>
          <input placeholder="Email" type="email" name="Email" id="field_email" class='input_field'>
        </div>
        <div class="input_container">
          <i class="fas fa-lock"></i>
          <input placeholder="Password" type="password" name="Password" id="field_password" class='input_field'>
        </div>
        <input type="submit" value="Login" name="Login" id='input_submit' class='input_field'>

        <span id='create_account'>
          <a href="registrar_usuario.php">Create your account ➡ </a>
        </span>
      </div>
    </div>
  </form>
</body>

</html>