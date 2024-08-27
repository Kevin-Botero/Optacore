<?php
session_start();

require '../BD/conexion.php';

    if(isset($_POST['Login'])){
        $email = $_POST["Email"];
        $pwd_form = $_POST["Password"];

    }else{
        header('location:../login.php');
    }
// Validamos si el correo No es Válido
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "El email no es valido";
    $_SESSION['error_msg'] = $error;
    header('location: ../login.php');
    exit;
}
// Validamos si la contraseña tiene una longitud igual a 0
if (strlen($pwd_form) == 0) {
    $error = "La contraseña esta vacia";
    $_SESSION['error_msg'] = $error;
    header('location: ../login.php');
    exit;
}

         /* echo $email . '<br>';
            echo $pwd_form;  */

$consultaIniciarSesion = mysqli_query($con, "SELECT u.UsuarioID, u.Nombre, u.Email, r.NombreRol, u.RolID, u.Contrasena FROM usuarios u INNER JOIN roles r ON u.RolID = r.RolID WHERE u.Email = '$email'");
    //Verificamos la cantidad de registros
if (mysqli_num_rows($consultaIniciarSesion) == 1) {
    // Email si existe
    $usuario = mysqli_fetch_assoc($consultaIniciarSesion);
    // ↑ La función mysqli_fetch_assoc() es usada para regresar una representación asociativa de la siguiente fila en el resultado, representado por el parámetro resultado , donde cada llave en la matriz representa el nombre de las columnas en el resultado.
    $psw_bd_encriptada = $usuario['Contrasena'];
    // ESTA FUNCION NOS SIRVE PARA VERIFICAR LA CONTRASEÑA ↓
    if (password_verify($pwd_form, $psw_bd_encriptada)) {
        //Las contraseñas son iguales, con el header lo enviamos al index
        //echo "Las contraseñas son iguales";
        $_SESSION['isLogin'] = 'true';
        $_SESSION['info'] = $usuario;
        header('location: ../index.php');
    } else {
        //Las contraseñas no son iguales
        $error = "La contraseña no es correcta";
        $_SESSION['error_msg'] = $error;
        header('location: ../login.php');
    }
} else {
    // Email no existe
   $error = "El email no existe";
   $_SESSION['error_msg'] = $error;
   header('location: ../login.php');
}
?>