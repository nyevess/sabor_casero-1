<?php
include("../pdo/conex.php");
// nos conectamos y analizamos si el usuario ha pulsado el boton para registrar un nuevo plato, y guardamos en variables todos los datos pasados en el formulario
if (isset($_POST['registrar'])) {
    $nom=$_POST['nombre'];
    $descrip=$_POST['descrip'];
    $precio=$_POST['precio'];
    $foto=$POST['foto'];
   
    try {
   
        //creamos una variable para almacenar la consulta
        $sql="INSERT INTO platos (plato,foto, descripcion, pvp) VALUES( :nombre,:foto, :descripcion, :precio)";
        //creamos la variable resultado que será el objeto conexion llmanado a la funcion prepare que prepara una sentencia para su ejecución y devuelve un objeto sentencia o sea el Insert
        $resultado=$base->prepare($sql);

        //este execute ejecuta la consulta anterior, lo que incluimos en el array será lo que el complete en la sentencia insert donde hemos colocado cada marcador, lo asociamos a las variables que hemos guardado anteriormente
        $resultado->execute(array(
            ":nombre"=>$nom,
            ":foto"=>$foto,
            ":descripcion"=>$descrip,
            ":precio"=>$precio));
            // si la inserción se ha ejecutado correctamente nos devuelve los datos introducidos
        if ($resultado) {
            echo "<h3>";
            echo "El plato se ha insertado:</h3>";
            echo "<h4>Nombre: $nom <br>";
            echo "Descripcion: $descrip<br>";
           echo "Precio: $precio<br>";
            echo "</h4>";
        }else{
            //si no se ha realizado nos devuelve lo siguiente
            echo "no se ha registrado el plato";
        }
      
    } catch (Exception $e) {
        echo "la línea de error es: " . $e->getLine();
     
    } finally {
        //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
        $base=null;
    }
}
