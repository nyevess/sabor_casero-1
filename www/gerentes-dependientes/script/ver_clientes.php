<?php

// analizamos si se ha pulsado el boton de ver los clientes
if(isset($_POST['clientes'])){
// si es así mostramos todos los clientes de la tabla usuarios con el foreach
    $mostrar=$base->prepare("SELECT nombre, apellidos, email, direccion, cp, tlf FROM usuarios WHERE id_rol=3");

    $mostrar->execute(array());
    $ver=$mostrar->fetchAll(PDO::FETCH_ASSOC);

    if($ver){
        
        foreach ($ver as $ver){
            echo "<br>";
            echo "<b>Nombre: </b>" .$ver['nombre']. "<br>";
            echo "<b>Apellidos: </b>" .$ver['apellidos']. "<br>";
            echo "<b>Email: </b>" .$ver['email']. "<br>";
            echo "<b>Dirección: </b>" .$ver['direccion']. "<br>";
            echo "<b>CP: </b>" .$ver['cp']. "<br>";
            echo "<b>Teléfono: </b>" .$ver['tlf']. "<br>";
            echo  "<hr class='linea__division__footer' />";
        }
    }


}





?>