<?php
include("../pdo/conex.php");
// nos conectamos y analizamos si el usuario ha pulsado el boton para registrar un nuevo trabajador, guardamos todos los datos pasados en el formulario en variables
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
         //creamos una variable para almacenar la consulta, como el usuario que vamos a insertar va a ser un trabajador, ya establecemos que el ID_rol va a ser el número 2.
        $sql="INSERT INTO usuarios (nombre, apellidos,email, direccion, cp, poblacion, tlf,clave, id_rol) VALUES( :nombre,:apellido,:email,:direccion,:cp,:poblacion, :telefono, :clave, 2)";
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

       

        if ($resultado) {
            // si la inserción se ha realizado correctamente nos devuelve los datos
            echo "<h3>";
            echo "El trabajador se ha registrado con los siguientes datos:</h3>";
            echo "<h4>Nombre: $nom <br>";
            echo "Teléfono: $tel<br>";
            echo "Usuario: $email<br>";
            echo "Contraseña: $clave<br>";
            echo "</h4>";
        }else{
            //si no se ha realizado nos devuelve lo siguiente:
            echo "El email ya está registrado!";
        }
      
    } catch (Exception $e) {
        echo "la línea de error es: " . $e->getLine();
    } finally {
        //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
        $base=null;
    }
}
