<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="stylesheet" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#fafafa"/>
    <title>Sabor Casero</title>
  </head>
  <body>
    <div class="container__pagina">
      <header class="header">
    <img class="header__logo" src="assets/img/svg/logo.svg" alt=""/>

       
        <section class="header__titulos"> 
          <h1 class="header__titulo">El sabor CASERO</h1>
          <h1 class="header__titulo2">Menús a domicilio</h1>
          <hr class="linea__division"/>
        </section>
      </header>
      <main class="main">
        <section class="main__entrar__general">
          <article class="main__php">
            <h2>
          <?php
            include("gerentes-dependientes/script/sesion_depen.php");

          ?>
          </h2>
          </article>
          <nav class="main__navegador"><a href="gerentes-dependientes/insertar_pedido_dependiente.php">
              <h4 class="insertar__pedido">NUEVO PEDIDO</h4></a>
              <a href="gerentes-dependientes/ver_pedidos_hoy_dependiente.php">
              <h4 class="insertar__pedido">PEDIDOS DE HOY</h4></a><a href="gerentes-dependientes/insertar_nuevo_cliente_dependiente.php">
              <h4 class="insertar__pedido">NUEVO CLIENTE</h4></a><a href="gerentes-dependientes/cambiar_datos_cliente_dependiente.php">
              <h4 class="insertar__pedido">VER/CAMBIAR DATOS CLIENTE</h4></a></nav>
          <section class="main__imagen"><img src="assets/img/desktop/entragar.jpg" alt=""/></section>
        </section>
      </main>
      <footer class="footer">  
        <hr class="linea__division__footer"/>
        <ul class="footer__logo"> 
          <li><img class="footer__logo_img" src="assets/img/svg/logo.svg" alt=""/></li>
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
          <li><a href="facebook/saborcasero"><img class="logo__face" src="assets/img//svg/logo_facebook.svg" alt=""/></a><a href="instagram/saborcasero"><img class="logo__insta" src="assets/img//svg/logo_insta.svg" alt=""/></a><a href="twitter/saborcasero"><img class="logo__twi" src="assets/img//svg/logo_twitter.svg" alt=""/></a></li>
        </ul>
      </footer>
    </div>
  </body>
</html>