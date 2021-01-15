<?php
include("../pdo/conex.php");
//analizamos con este if si el cliente ha pulsado el boton de buscar el cliente o el de actualizar sus datos y guardamos en la variable $cliente su email
if (isset($_POST['buscar']) OR isset($_POST['enviar'])) {
    $cliente = $_POST['email'];
    //si ha pulsado el boton de actulizar los datos guardamos en variables todos los datos del formulario y realizamos el update en la tabla de usuarios
   if (isset ($_POST['enviar'])) {
      $nom=$_POST['nombre'];
      $ape=$_POST['apellidos'];
      $dir=$_POST['direccion'];
      $cp=$_POST['cp'];
      $pobla=$_POST['poblacion'];
      $email=$_POST['email'];
      $tel=$_POST['tlf'];
               
      $sql="UPDATE usuarios SET  email='$email', nombre='$nom', apellidos='$ape', direccion='$dir', cp='$cp', poblacion='$pobla', tlf='$tel' WHERE email
              ='$email'";
      $resultado=$base->prepare($sql);
      $resultado->execute();
         if ($resultado) {
              echo "<h2>Los datos ha sido cambiados</h2>";
         } else {
           echo "algo ha ido mal";
          }         
               
          }
            try {
              //con esta consulta mostramos un formulario con los datos del cliente del cual hemos introdocido el email en "buscar cliente"
                $registros = $base->prepare("SELECT * FROM usuarios Where email= '$cliente' ");
                $registros->execute();
                $devuelve = $registros->fetch(PDO::FETCH_ASSOC);
                //guardamos el resultado en un array asociativo para mostrar los datos en un formulario
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
                    echo "<label style=font-weight:bold>Población :</label><br>";
                    echo " <input style=color:grey type='text' name='poblacion' value='" . $devuelve['poblacion']  . "'><br>";
                    echo "<br>";
                    echo "<label style=font-weight:bold>Email:</label><br>";

                    echo " <input style=color:grey type='text' name='email' value='" . $devuelve['email']  . "'><br>";
                    echo "<br>";
                    echo "<label style=font-weight:bold>Telefono:</label><br>";
                    echo " <input style=color:grey type='text' name='tlf' value='" . $devuelve['tlf']  . "'><br>";
                    echo "<br>";
                    
                  
                    echo "<button type='submit' name='enviar' style=padding:10px>Actualizar</button>";
                    echo "</form>";
                
            }catch (Exception $e) {
              //si hay algun error nos dará la línea del error
              echo "la línea de error es: " . $e->getLine();
            } finally {
              //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
              $base = null;
            }
          }

          ?>