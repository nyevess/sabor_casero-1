
<?php
include("../pdo/conex.php");
//obtenenos el ID_usuario a partir del correo con el que se inciia la sesion
$registros=$base->prepare("SELECT id_usuario FROM usuarios WHERE email='$user'");
$registros->execute();
    
$devuelve = $registros->fetch(PDO::FETCH_ASSOC);
$cliente=$devuelve['id_usuario'];
$cliente;
//lo guardamos en la variable cliente y a continuacion hacemos la consulta de los pedidos según el id_del cliente

$pedidos=$base->prepare("SELECT id_pedido, f_pedido, f_entrega, total, recoger_llevar FROM pedidos WHERE id_usuario='$cliente';");

$pedidos->execute(array());

$devuelve=$pedidos->fetchAll(PDO::FETCH_ASSOC);
//si la consulta ha tenido exito:
if ($devuelve) {
?>



<?php

    foreach ($devuelve as $pedido) {?>

    <!-- imprimimos todos los pedidos que tiene -->  
    <hr class="linea__division__footer"/>
    <p><b>Id Pedido :</b> <?php echo $pedido['id_pedido']; ?></p>
    <p><b>Realizado : </b><?php echo $pedido['f_pedido']; ?></p>
    <p><b>Fecha entrega:</b> <?php echo $pedido['f_entrega']; ?></p>
    <p><b>Importe Total: </b><?php echo $pedido['total'];  ?></p>
    <p><b>Recoger o llevar:</b> <?php echo $pedido['recoger_llevar'];?></p>
    <p><b>Platos:</b> </p>
        
<?php 
        //guardamos en la variable n_pedido el ID del pedido para consultar los platos
        $n_pedido=$pedido['id_pedido'];
        $platos=$base->prepare("SELECT plato,cantidad 
        FROM pedidos 
        JOIN contienen 
        USING(id_pedido) 
        JOIN platos USING(id_plato) 
        WHERE id_pedido='$n_pedido'");
        $platos->execute(array());
        $devuelve_platos=$platos->fetchAll(PDO::FETCH_ASSOC);
        if($devuelve_platos){
            foreach($devuelve_platos as $plato){
                // y nos mostrará los platos que contienen los pedidos
?>
        <p><b>- </b><?php echo $plato['plato']; ?> ----- <?php echo $plato['cantidad']; ?> /unds</p>


<?php }}}
// Si no hay pedidos anteriores nos muestra el siguiente mensaje
}else{echo "No hay pedidos";}?>
    