<?php 

session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- App Web, inidicar al navegador que elementos mostrar en un JSON-->
    <link rel="manifest" href="site.webmanifest"/>
    <!-- icono de acceso para IOS-->
    <link rel="apple-touch-icon" href="icon.png"/>
    <!-- Recordar que favicon.ico tiene que estar en el directorio inicial-->
    <!-- links de estilos-->
 
    <link rel="stylesheet" href="../css/main.css"/>
    <link rel="stylesheet" href="../css/pedidos.css"/>
 
    <!--Google Fonts-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Se cambia el tema de algunos navegadores-->
    <meta name="theme-color" content="#fafafa"/><link rel="stylesheet" href="../css/main.css"/>
  </head>
  <body>
    <div class="container__pagina">
      <header class="header">
      <a href="../index.php">
    <img class="header__logo" src="../assets/img/svg/logo.svg" alt="" />
    </a>  
   
        <section class="header__titulos"> 
          <h1 class="header__titulo">El sabor CASERO</h1>
          <h1 class="header__titulo2">Menús a domicilio</h1>
          <hr class="linea__division"/>
        </section>
      </header>
      <main class="main">
        <section class="main__insertar__menu">
          <article class="main__insertar__php">
          <h2>
          <?php
          include("script/sesion_depen.php");

          ?></h2>
          </article>
          <nav class="main__insertar__nav"><a href="cambiar_datos_cliente_dependiente.php"
            ><h4 class="insertar__pedido">VER/CAMBIAR DATOS CLIENTE</h4></a
          >
          <a href="insertar_pedido_dependiente.php"
            ><h4 class="insertar__pedido">NUEVO PEDIDO</h4></a
          >
          <a href="ver_pedidos_hoy_dependiente.php">
            <h4 class="insertar__pedido">PEDIDOS DE HOY</h4></a
          >
          <a href="insertar_nuevo_cliente_dependiente.php">
            <h4 class="insertar__pedido">NUEVO CLIENTE</h4></a
          ></nav>
          <section class="main__insertar__imgs">
   
            <h4 class="main__titulo">Nuestros Platos</h4>
            <?php 
             include("../pdo/conex.php");
            //nos conectamos y creamos una consulta nueva que nos mostrará los platos
         
          $sql=$base->prepare("SELECT * FROM platos");
          $sql->execute();
          $listaproductos=$sql->fetchAll(PDO::FETCH_ASSOC);
          //y guardamos en $listaproductos lo que obtiene la consulta
          ?>
            <section class="main__menu">
            <?php
            //ahora hacemos un for each para que nos devuelva la información de los platos que  imprimirá la tarjeta con el plato img y descripcion tantas veces como platos hata
          foreach ($listaproductos as $producto) {
              ?>
              <figure class="menu__1">
                <!-- aquí saldrá en nombre del plato -->
                <h4><?php echo $producto['plato']; ?></h4>
                <!-- aqui saldrá la foto del plato -->
                
                <img class="menu__1__img" src=<?php echo $producto['foto']; ?> alt=""/>
                <figcaption class="menu__1__descrip"><?php echo $producto['descripcion']; ?>
                <h5>Precio: <?php echo $producto['pvp']; ?> €/plato</h5>
              </figcaption>
                <label class="label__anadir1" for="anadir">Cantidad:</label>
                <form action="" method="post">
                <select name="anadir">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>

                </select>
                <!-- creamos un formulario que recojera los datos del pedido y ponemos en su value lo que queremos recojer de cada pedido, lo ocultamos para que no se vea, ya que el cliente ya ve los datos en la tarjeta del plato -->
                <input type="hidden" name="id_plato" value="<?php echo $producto['id_plato']; ?>">
                <input type="hidden" name="plato"  value="<?php echo $producto['plato']; ?>">
                <input type="hidden" name="pvp" value="<?php echo $producto['pvp']; ?>">
               
              <!-- cuando apretemos el boton agregar ira al archivo carrito que guardara lo que hayamos elegido y lo mostrara en el mensaje debajo del nuevo pe -->
                <button type="submit" name="agregar">Añadir</button>
                </form>
              </figure>

              <?php
              } 
              ?>
     
            </section>
        
          
        </section>
        <section class="main__ver__pedido">
          <form class="ver__pedido" action="
            <?php echo $_SERVER     ['PHP_SELF']   ; ?>" method="post">
            
              <?php  
              include("script/carrito_junto.php");
              ?>
                <hr class="linea__division__footer"/>
         
              <label for="cliente"><b>Email del cliente:</b></label>
              <select  id="cliente" name="cliente"><br>
                <?php 
                include("/../pdo/conex.php");
                //creamos una variable para almacenar la consulta
                $sql="SELECT email FROM usuarios";
                $clientes=$base->prepare($sql);
                $clientes->execute();
                while ($devuelve=$clientes->fetch(PDO::FETCH_ASSOC)){
                    extract($devuelve);
                    ?>
                    <option value="<?php echo $email; ?>"> <?php echo $email;?></option><br><?php
                }
                ?><br>
              </select>
              <label class="label" for="fecha">Fecha:</label>
              <input class="input" type="date"  min="<?php echo date("Y-m-d",strtotime(date("Y-m-d")));?>"  name="fecha"><br>
              <label class="label" for="hora">Hora (desde 12:00 hasta 18:00):</label>
              <input class="input" type="time" value="12:00" min="12:00" max="18:00" step="900" name="hora"><br>
              <label class="label" for="recoger">Recoger o llevar:</label>
              <select name="recoger" id="recoger">
                <option value="llevar">Llevar a casa</option>
                <option value="recoger">Recoger en local</option>

              </select>
              <button class="input" type="submit" name="nuevo">Siguiente</button>
              <button class="input"  type="submit" name="vaciar">Vaciar Carrito</button>
              <?php
              include("script/inserta_pedido.php");
              ?>
              </form>
            

            </article>
        </section>
      </main>
      <footer class="footer">  
        <hr class="linea__division__footer"/>
        <ul class="footer__logo"> 
          <li><img class="footer__logo_img" src="../assets/img/svg/logo.svg" alt=""/></li>
          <li>
            <h4>El sabor CASERO</h4>
          </li>
        </ul>
        <ul class="footer__contact">
          <h3>El sabor CASERO</h3>
          <li>C/ Pascual, 25 Bajos, Marratxi</li>
          <li>Tel. 655858585</li>
          <li>info@saborcasero.es</li>
        </ul>
        <ul class="footer__redes">
          <h3>Síguemos en redes sociales:</h3>
          <li><a href="facebook/saborcasero"><img class="logo__face" src="../assets/img//svg/logo_facebook.svg" alt=""/></a><a href="instagram/saborcasero"><img class="logo__insta" src="../assets/img//svg/logo_insta.svg" alt=""/></a><a href="twitter/saborcasero"><img class="logo__twi" src="../assets/img//svg/logo_twitter.svg" alt=""/></a></li>
        </ul>
      </footer>
    </div>
  </body>
</html>
<?php
ob_end_flush();
?>