<?php


if (isset($_POST["agregar"])) {
    //y le decimos que si pulsa el boton de agregar guarde los datos pasado en variables
    $id_plato=$_POST["id_plato"];
    $plato=$_POST['plato'];
    $pvp=$_POST['pvp'];
    $cantidad=$_POST['anadir'];
                
    //ahora vamos con la sesion del carrito
    if (!isset($_SESSION['carrito'])) {
        //si no existe la sesion carrito la creará y guardará lainformacion del plato
        $lineaPedido=array(
          'id_plato'=>$id_plato,
          'plato'=>$plato,
          'pvp'=>$pvp,
          'cantidad'=>$cantidad
     );
        //y la guardará en la posiscion 0
        $_SESSION['carrito'][0]=$lineaPedido;
    } else {
        //usamos el ese para si ya existe un producto en el carrito contamos lo que hay en la sesion carrito y lo almacenamos en $numeroproductos, volvemos a recolectaar la informacion y lo volvemos a almacenar en la sesion,
        $numeroProductos=count($_SESSION['carrito']);
        $lineaPedido=array(
               'id_plato'=>$id_plato,
               'plato'=>$plato,
               'pvp'=>$pvp,
               'cantidad'=>$cantidad
          );
        $_SESSION['carrito'][$numeroProductos]=$lineaPedido;
    }
}

if(!empty($_SESSION['carrito'])){
//Si la sesion carrito no está vacia creamos una tabla para mostrar los detalles del pedido
?>

<table>
    <tbody>
        <tr>
        <th>Plato:</th>
        <th>Precio:</th>
        <th>Cantidad:</th>
        <th>Total: </th>
        </tr>
<?php
//creamos la variable $total y la declaramos a 0
$total=0;
//y utilizamos el foreach para que nos muestre de cada plato que se va añadiendo el nombre, el precio, la cantidad y el total de la linea, también del total de todo el pedido
 foreach($_SESSION['carrito'] as $indice=>$lineaPedido){?>
        <tr>
        <td><?php echo $lineaPedido['plato'] ?></td>
        <td><?php echo $lineaPedido['pvp'] ?> € </td>
        <td><?php echo $lineaPedido['cantidad'] ?></td>
        <td><?php echo number_format($lineaPedido['pvp']*$lineaPedido['cantidad'],2); ?> €</td>
        
        </tr>
        <?php $total=$total+($lineaPedido['pvp']*$lineaPedido['cantidad']);
        ?>
        <?php } 
  
        
        
        ?>

        <tr>
            <td><br><b>Importe total pedido = </b></td>
            <td><br><b><?php echo number_format($total,2);?> €</b></td>
        </tr>
    </tbody>
</table>

<?php
}else{
    //si todavia no se han añadido productos al pedido nos muestra el siguiente mensaje
    echo "<h4>Añade productos al pedido</h4>";
}


?>
