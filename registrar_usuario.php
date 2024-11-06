<?php
include("BD/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="CSS/style.css">

</head>
<body>
<?php include("nav.php");?>
    <div id="form_wrapper">
        <div id="form_left">
            <img src="IMAGENES/gente.png" alt="computer icon">
        </div>
        <div id="form_right">
            <h1>Registrate</h1>
</hr>
        <?php
			if(isset($_POST['add'])){
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));//Escanpando caracteres
                $apellido		     = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));//Escanpando caracteres
				$email		     = mysqli_real_escape_string($con,(strip_tags($_POST["Email"],ENT_QUOTES)));//Escanpando caracteres 
				$pwd_form	 = mysqli_real_escape_string($con,(strip_tags($_POST["pwd_form"],ENT_QUOTES)));//Escanpando caracteres
                $telefono		     = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres
                $direccion	     = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));//Escanpando caracteres
                $hoy = date("y/m/d");//Capturando la fecha actual Formato (dia/mes/año)
                $id_rol = 2;
				
                //Validación que la contraseña tenga 8 o más caracteres
				if (strlen($pwd_form) < 8) {
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La contraseña debe tener 8 o más caracteres</div>';
                    //echo'<script type="text/javascript">alert("La contraseña debe tener 8 o más caracteres");window.location.href="registrar_usuario.php";</script>';
				} else {
                    //Tomamos el largo de la contraseña y analizamos cada una de las posiciones de los caracteres para que tenga por lo menos 1 númerico
					$largo_pwd = strlen($pwd_form);
					$numerica = false;
				
					for ($i = 0; $i < $largo_pwd; $i++) {
						if (is_numeric($pwd_form[$i])) {
							$numerica = true;
							break;
						}
					}
				
					if ($numerica) {
                        //Validamos que la contraseña no contenga el nombre del usuario
						if (strpos($pwd_form, $nombre) !== false || strpos($pwd_form, $apellido) !== false) {
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La contraseña no puede contener el nombre o apellido del usuario</div>';
						} else {
							// La contraseña es válida
							$pwd_form = password_hash($pwd_form, PASSWORD_BCRYPT);//Conversión contraseña encriptada
							$resultados = mysqli_query($con, "SELECT * FROM usuarios WHERE Email='$email'");
							if(mysqli_num_rows($resultados) == 0){
									$insert = mysqli_query($con, "INSERT INTO usuarios(Nombre,Apellido,Email,Contrasena,Telefono,Direccion,FechaRegistro,RolID)
																		VALUES('$nombre','$apellido','$email', '$pwd_form', '$telefono', '$direccion','$hoy', $id_rol)") or die(mysqli_error($con));
									if($insert){
										echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! El usuario a sido guardado con éxito.</div>';
									}else{
										echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar el usuario !</div>';
									}
								 
							}else{
								echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>El email ya exite en la base de datos!</div>';
							}	
							//echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La contraseña es válida</div>';
						}
					} else {
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La contraseña debe contener al menos un número</div>';
					}
				}
				
			}	

			?>
<form action="" method="post">
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-envelope"></i>
                <input placeholder="Nombre" type="text"  name="name" id="field_name" class='input_field'>
            </div>
            <br>
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-envelope"></i>
                <input placeholder="Apellido" type="text"  name="apellido" id="field_apellido" class='input_field'>
            </div>
            <br>
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-envelope"></i>
                <input placeholder="Email" type="email"  name="Email" id="field_email" class='input_field'>
            </div>
            <br>
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-lock"></i>
                <input  placeholder="Contraseña" type="password"  name="pwd_form" id="field_password" class='input_field'>
            </div>
            <br>
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-envelope"></i>
                <input placeholder="Telefono" type="number"  name="telefono" id="field_telefono" class='input_field'>
            </div>
            <br>
            <div class="input_container" style="padding: 15px;">
                <i class="fas fa-envelope"></i>
                <input placeholder="Direccion" type="adress"  name="direccion" id="field_direccion" class='input_field'>
            </div>
            <br>
            <div class="submit">
                    <center><input type="submit" class="btn btn-sm btn-primary" name="add" value="ingresar"> <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a></center>
            </div>
</form>
        </div>
    </div> 
    
</body>
</html>