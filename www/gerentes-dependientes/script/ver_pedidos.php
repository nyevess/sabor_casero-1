
<?php
include("../pdo/conex.php");
//iniciamos la sesión y preparamos la consulta para ver los pedidos que tenemos en el día de hoy
$pedidos=$base->prepare("SELECT id_pedido,f_entrega,h_entrega,n_linea,plato,cantidad,recoger_llevar, id_usuario, nombre, contienen.total
FROM pedidos
JOIN contienen USING(id_pedido)
JOIN platos USING(id_plato)
JOIN usuarios USING(id_usuario)
WHERE DATE(f_entrega)=DATE(NOW())
ORDER BY id_pedido;");
//la ejecutamos y guardamos en un array
$pedidos->execute(array());

$devuelve=$pedidos->fetchAll(PDO::FETCH_ASSOC);

if ($devuelve) {
    //si se ejecuta bien la consulta nos muestra una tabla con la información devuelva por la consulta
    foreach ($devuelve as $pedido) {?>
<table border cellpadding="" cellspacing="5">
   <tr>
        <th>Id pedido:</th>
        <th>Entrega:</th>
        <th>Hora:</th>
        <th>Línea: </th>
        <th>Plato: </th>
        <th>Cantidad: </th>
        <th>Cliente: </th>
        <th>Método: </th>
        <th>Total: </th>
    </tr>
     <tr>
            <td><?php echo $pedido['id_pedido']; ?></td>
            <td><?php echo $pedido['f_entrega']; ?> </td>
            <td><?php echo $pedido['h_entrega']; ?></td>
            <td><?php echo $pedido['n_linea'];  ?></td>
            <td><?php echo $pedido['plato'];  ?></td>
            <td><?php echo $pedido['cantidad'];  ?></td>
            <td><?php echo $pedido['nombre'];  ?> </td><br>
            <td><?php echo $pedido['recoger_llevar'];  ?> </td><br>
            <td><?php echo $pedido['total'];  ?> </td><br>
        </tr>
</table>

        <?php  
        //con esta nueva consulta obtendremos el total a partir de id_pedido
        $idpedido=$pedido['id_pedido'];
        $totales=$base->prepare("SELECT total FROM pedidos WHERE id_pedido=$idpedido");
        $totales->execute(array());
        $total=$totales->fetch(PDO::FETCH_ASSOC);



        // y con esta otra consulta obtenemos los datos del usuario según el pedido
        $cliente=$pedido['id_usuario'];
    
        $dir=$base->prepare("SELECT direccion, cp, poblacion, tlf FROM usuarios WHERE id_usuario='$cliente'");
        $dir->execute(array());
        $direccion=$dir->fetch(PDO::FETCH_ASSOC);
       if($direccion || $total){
           // si las dos consultas se han ejecutado nos muestra la salida de los datos
        echo "<br>";
        echo "<b>Total del pedido:</b>".$total['total']."<br>";
        echo "<br>";
           echo "<b>Direccion: </b>" .$direccion['direccion']. ",<b> CP: </b>" .$direccion['cp']. "," .$direccion['poblacion']. ",<b>TLF: </b>" .$direccion['tlf'];
       }

    }
}else{
    // si el usuario no tiene pedidos anteriores nos muestra el mensaje:
    echo "No hay pedidos";}


        
        ?>