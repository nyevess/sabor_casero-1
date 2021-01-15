<?php
try {
//analizamos si se ha iniciado la sesion
  $user=$_SESSION['username3'];
  //si no se ha iniciaco la sesion será porque no hemos hecho el login, por lo tanto nos redirige a la página de inicio

  if (!isset($user)) {
      header("Location:../index.php");
  }else{
      // si por el contrario si que se ha iniciado la sesion nos recibe con el email de usuario y tenemos un boton para cerrar la sesion y salir
      echo "<h2> Bienvenid@ $user</h2> <br>";
      echo "<h4><a style='color:white;','background-color:grey;','padding:20px;', href='salir.php'>SALIR</a></h4>";

      echo "<br><br>";
  }
}catch(Exception $e) {
  echo "la línea de error es: " . $e->getLine();

}finally{
  //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
  $base=null;
}

?>