<?php
session_start();
session_destroy();
//iniciamos la sesion y la cerramos al pulsar el boton de salir y nos redirige a la pagina de index.php
header('Location:../index.php');
exit();
?>