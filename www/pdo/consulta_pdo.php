<?php
include("conex.php");
// nos conectamos y almacenamos en variables todos los datos para el registro del nuevo usuario
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $direccion=$_POST['direccion'];
    $cp=$_POST['cp'];
    $poblacion=$_POST['poblacion'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    $clave=$_POST['clave'];
    $clave_cifrada=password_hash($clave, PASSWORD_DEFAULT, array("cost=>15"));

try {
  
    $sql="INSERT INTO usuarios (email, clave, nombre,apellidos,direccion,cp,poblacion,tlf,id_rol) VALUES( :email,:clave,:nombre,:apellidos,:direccion,:cp,:poblacion,:tlf, 3)";
    //creamos la variable resultado que será el objeto conexion llmanado a la funcion prepare que prepara una sentencia para su ejecución y devuelve un objeto sentencia o sea el select
    $resultado=$base->prepare($sql);

    //este execute ejecuta la consulta anterior, lo que incluimos en el array será lo que el complete en la sentencia insert donde hemos colocado cada marcador, lo asociamos a las variables que hemos guardado anteriormente
    $resultado->execute(array(
    ":nombre"=>$nombre,
    ":apellidos"=>$apellidos,
    ":direccion"=>$direccion,
    ":cp"=>$cp,
    ":poblacion"=>$poblacion,
    ":email"=>$email,
    ":tlf"=>$telefono,
    ":clave"=>$clave_cifrada
        ));

    if($resultado){
        // si la inserción se ha realizado correctamente nos muestra los datos con los que se ha registrado
        echo "<h2>";
        echo "Te has inscrito correctamente, con lo siguientes datos:<br>";
        echo "Nombre: $nombre <br>";
        echo "Apellidos: $apellidos <br>";
        echo "Dirección: $direccion <br>";
        echo "Código Postal: $cp<br>";
        echo "Población: $poblacion<br>";
        echo "Email: $email<br>";
        echo "Teléfono: $telefono<br>";
        echo "</h2>";
        echo "<h2>Ingresa con tu email y contraseña</h2>";
        
    }else{
        // en caso contrario nos muestra que el usuario ya esta registrado
        echo "usuario ya registrado";}

}catch(Exception $e) {
    echo "la línea de error es: " . $e->getLine();

}finally{
    //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
    $base=null;
}

?>