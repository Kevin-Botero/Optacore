<?php
session_start();

if (isset($_SESSION['info']) && isset($_SESSION['isLogin'])) {
    unset($_SESSION['info']);
    $_SESSION['isLogin'] = false;
    header('location: login.php');
}else {
    $error = "No has iniciado Sesión, por lo tanto no es posible cerrarla";
    $_SESSION['error_msg'] = $error;
    header('location: login.php');
}

?>