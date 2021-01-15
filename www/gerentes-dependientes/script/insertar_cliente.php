<?php
include("../pdo/conex.php");
//nos conectamos a la base de datos y analizamos si se ha pulsago el boton de registrar, guardamos todos los datos recogidos en el formulario en variables
if (isset($_POST['registrar'])) {
    $nom=$_POST["nombre"];
      $ape=$_POST['apellido'];
      $email=$_POST["email"];
      $dir=$_POST["direccion"];
      $cp=$_POST["cp"];
      $pobla=$_POST['poblacion'];
      $tel=$_POST["tel"];
    $clave=$_POST['clave'];
    $clave_cifrada=password_hash($clave, PASSWORD_DEFAULT, array("cost=>15")); 

    try {
        //creamos una variable para almacenar la consulta
        $sql="INSERT INTO usuarios (nombre, apellidos,email, direccion, cp, poblacion, tlf,clave, id_rol) VALUES( :nombre,:apellido,:email,:direccion,:cp,:poblacion, :telefono, :clave, 3)";
        //creamos la variable resultado que será el objeto conexion llmanado a la funcion prepare que prepara una sentencia para su ejecución y devuelve un objeto sentencia o sea el select
        $resultado=$base->prepare($sql);

        //este execute ejecuta la consulta anterior, lo que incluimos en el array será lo que el complete en la sentencia insert donde hemos colocado cada marcador, lo asociamos a las variables que hemos guardado anteriormente
        $resultado->execute(array(
    ":nombre"=>$nom,
    ":apellido"=>$ape,
    ":email"=>$email,
    ":direccion"=>$dir,
    ":cp"=>$cp,
    ":poblacion"=>$pobla,
     ":telefono"=>$tel,
    ":clave"=>$clave_cifrada));

       
// si la inserción de datos se ha realizado correctamente nos muestra los datos con los que se ha registrado el usuario
        if ($resultado) {
            echo "<h3>";
            echo "El cliente se ha registrado con los siguientes datos:</h3>";
            echo "<h4>Nombre: $nom <br>";
            echo "<h4>Apellido: $ape <br>";
            echo "Teléfono: $tel<br>";
            echo "Email: $email<br>";
            echo "Dirección: $dir<br>";
            echo "CP: $cp<br>";
            echo "Población: $pobla<br>";
            echo "Contraseña: $clave<br>";
            echo "</h4>";
        }else{
            // en caso contrario nos dice que este usuario ya esta registrado
            echo "El email ya está registrado!";
        }
      
    } catch (Exception $e) {
         //si hay algun error nos dará la línea del error
         echo "la línea de error es: " . $e->getLine();
     
    } finally {
        //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
        $base=null;
    }
}
