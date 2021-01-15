<?php
    //analizamos si el usuario ha pulsado el boton de vaciar el carrito, si es así, vaciamos los productos de la sesion y recargamos la página             
  if(isset($_POST['vaciar'])){
    
    unset($_SESSION['carrito']);
    header("Location:".$_SERVER['PHP_SELF']);
 }

//si el usuario ha pulsado el boton de Siguiente para cursar el pedido, recogemos en variables todos los datos
if (isset($_POST['nuevo'])) {
    $cliente=$_POST['cliente'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $recoger=$_POST['recoger'];
    $total=0;

            foreach ($_SESSION['carrito'] as $indice=>$lineaPedido) {
                $total=$total+($lineaPedido['pvp']*$lineaPedido['cantidad']);
            }
 try {
    
    //hacemos una consulta para obtener el id del usuario a partir del email, para poderlo insertar en la tabla de pedidos
        $id_cliente=$base->prepare("SELECT id_usuario FROM usuarios WHERE email= '$cliente' ");
        $id_cliente->execute();
        $result=$id_cliente->fetch(PDO::FETCH_ASSOC);
        $ver=$result['id_usuario'];
      
        //creamos una variable para almacenar la consulta que inserta el pedido
        $sql="INSERT INTO pedidos (f_pedido, f_entrega, h_entrega, id_usuario, total, recoger_llevar) VALUES( NOW(), :f_entrega, :h_entrega, :id_usuario, :total, :recoger_llevar)";
        //creamos la variable resultado que será el objeto conexion llmanado a la funcion prepare que prepara una sentencia para su ejecución y devuelve un objeto sentencia o sea el Insert
        $resultado=$base->prepare($sql);

        //este execute ejecuta la consulta anterior, lo que incluimos en el array será lo que el complete en la sentencia insert donde hemos colocado cada marcador, lo asociamos a las variables que hemos guardado anteriormente
        $resultado->execute(array(
            
            ":f_entrega"=>$fecha,
            ":h_entrega"=>$hora,
            ":id_usuario"=>$ver,
            ":total"=>$total,
            ":recoger_llevar"=>$recoger
        ));
         //con esta sentencia recuperamos el útilmo id insertado en la colsulta anterior en la tabla de pedidos y lo usamos para insertar los datos en la tabla contienen
         $idpedido=$base->lastInsertId();
        
         //volvemos a usar el foreach para la información del carrito 
         foreach ($_SESSION['carrito'] as $indice=>$lineaPedido) {
             $sentecia=$base->prepare("INSERT INTO 
         contienen (id_contiene, id_pedido, id_plato, n_linea, cantidad, precio)
          VALUES (NULL, :id_pedido, :id_plato, 1, :cantidad, :precio); 
         /* sentencia para que las lineas del pedido vayan correlativas */
         SET @n=0;
         UPDATE contienen
         set n_linea=(@n:=@n+1)
         WHERE id_pedido=:id_pedido
         ORDER BY id_contiene;"    
         
     );
 
             //e insertamos los datos en la tabla contienen
             $sentecia->execute(
                 array(
             ":id_pedido"=>$idpedido,
             ":id_plato"=>$lineaPedido['id_plato'],
             ":cantidad"=>$lineaPedido['cantidad'],
             ":precio"=>$lineaPedido['pvp']
         ));
         }   
      //si las dos consultas se han ejecutado correctamente nos vacía el carrito y nos devuelve "pedido realizado"
        if ($resultado || $sentencia) {
            unset($_SESSION['carrito']);
            echo"<br>";
            echo "Pedido Realizado";
           
        }else{echo "problemas";}

           

        
    
    } catch (Exception $e) {
        echo "la línea de error es: " . $e->getLine();
    } finally {
        //este bloque lo ejecutará siempre, osea siempre que haga o no haga lo que hay en try cojera la conexion y la cerrará
        $base=null;
    }
}