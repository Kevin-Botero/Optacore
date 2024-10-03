<?php
session_start();
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
	header('location: login.php');
	exit;
}
include("BD/conexion.php");
$consulta = mysqli_query($con, "SELECT * FROM roles");
$usu = $_SESSION['info']['UsuarioID'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/index_perfil.css">
    <link rel="stylesheet" href="CSS/index_style.css">
</head>
<body>
    <?php include("nav.php");
    $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE UsuarioID='$usu'");
    ?> 
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?php echo $_SESSION['info']['Nombre'];?></span><span class="text-black-50"><?php echo $_SESSION['info']['Email'];?></span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Mi Perfil</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['info']['Nombre'];?>"></div>
                    <div class="col-md-6"><label class="labels">Apellido</label><input type="text" class="form-control" value="<?php echo $_SESSION['info']['Apellido'];?>" placeholder=""></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Direccion</label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['info']['Direccion'];?>"></div>
                    <div class="col-md-12"><label class="labels">Email </label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['info']['Email'];?>"></div>
                    <div class="col-md-12"><label class="labels">Telefono</label><input type="text" class="form-control" placeholder="" value="<?php echo $_SESSION['info']['Telefono'];?>"></div>
                </div>
               
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include('footer.php'); ?>  

    
</body>
</html>