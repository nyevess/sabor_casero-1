<?php
//incluimos el script para la conexion con la base de deatos
include("../pdo/conex.php");
try {
  
    // y usamos la conexión para preparar la consulta a partir del email del usuario que tiene la sesión iniciada
    $registros=$base->prepare("SELECT * FROM usuarios WHERE email='$user'");
    $registros->execute();
    //almacenamos los resultado en un array asociativo y a continuación lo mostramos en un formulario para que el usuario pueda cambiar sus datos.
    $devuelve = $registros->fetch(PDO::FETCH_ASSOC);
  
    echo "<form action='";
    echo $_SERVER['PHP_SELF'];
    echo "' method='POST'>";
    echo "<h3>Modifica los datos :</h3>";
    echo "<label style=font-weight:bold>Nombre:</label><br>";
    echo " <input style=color:grey type='text' name='nombre' value='" . $devuelve['nombre']  . "'><br>";
    echo "<br>";
    echo "<label style=font-weight:bold>Apellidos:</label><br>";
    echo " <input style=color:grey type='text' name='apellidos' value='" . $devuelve['apellidos']  . "'><br>";
    echo "<br>";
    echo "<label style=font-weight:bold>Dirección:</label><br>";
    echo " <input style=color:grey type='text' name='direccion' value='" . $devuelve['direccion']  . "'><br>";
    echo "<br>";
    echo "<label style=font-weight:bold>C.P. :</label><br>";
    echo " <input style=color:grey type='text' name='cp' value='" . $devuelve['cp']  . "'><br>";
    echo "<br>";
    echo "<label style=font-weight:bold>Poblacion :</label><br>";
    echo " <input style=color:grey type='text' name='poblacion' value='" . $devuelve['poblacion']  . "'><br>";
    echo "<br>";
    echo "<label style=font-weight:bold>Telefono:</label><br>";
    echo " <input style=color:grey type='text' name='tel' value='" . $devuelve['tlf']  . "'><br>";
    echo "<br>";
    echo "<button type='submit' name='enviar' style=padding:10px>Actualizar</button>";
    echo "</form>";
    //con el siguiente if, analizamos si el usuario a pulsado el boton de actualizar y guardamos en variables todos los datos del formulario
    if (isset ($_POST['enviar'])) {
      $user=$_SESSION['username'];
      $nom=$_POST["nombre"];
      $ape=$_POST['apellidos'];
      $dir=$_POST["direccion"];
      $cp=$_POST["cp"];
      $pobla=$_POST['poblacion'];
       $tel=$_POST["tel"];
      {
        //y volvemos a hacer el mismo proceso con la consulta, se almacena en la variable, se prepara y se ejecuta, si se ha realizado con éxito nos muestra el mensaje
          $sql="UPDATE usuarios SET nombre='$nom', apellidos='$ape', direccion='$dir', cp='$cp', poblacion='$pobla', tlf='$tel' WHERE email='$user'";
  
          $resultado=$base->prepare($sql);
          $resultado->execute();
          if ($resultado) {
              echo "<h2>Tus datos ha sido cambiados</h2>";
          }
      }
  }
  
  }catch(Exception $e){
      //en el bloque del catch nos mostrará los errores que se hayan producido en el try, y nos devuelve la linea donde esta el error
      echo "la línea de error es: " . $e->getLine();
  }finally {
    //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera cerrará la conexion.
    $base=null;
}
  
  
