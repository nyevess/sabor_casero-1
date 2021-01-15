<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- links de estilos-->
    <link rel="stylesheet" href="css/main.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#fafafa"/>
  </head>
  <body>
    <div class="container__pagina">
      <header class="header">
        <form class="header__form" action="loguear.php" method="POST"><img class="header__logo" src="assets/img/svg/logo.svg" alt=""/>
          <article class="header__inputs">
            <label class="header__login">LOGIN</label>
            <input class="input__user" type="text" name="user" placeholder="usuario"/>
            <input class="input__pass" type="password" name="clave" placeholder="contraseña"/>
            <button class="input__buton" type="submit">Entrar</button>
          </article>
        </form>
        <section class="header__titulos"> 
          <h1 class="header__titulo">El sabor CASERO</h1>
          <h1 class="header__titulo2">Menús a domicilio</h1>
          <hr class="linea__division"/>
        </section>
      </header>
      <main class="main">
        <?php
        require ("pdo/consulta_pdo.php");
        ?>
        <div class="main__index">
          <h4 class="main__titulo">Nuestros Platos</h4>
          <section class="main__menu">
            <figure class="menu__1">
            <h4>Ensalada</h4><img class="menu__1__img" src="assets/img/desktop/ensalada.jpg" alt=""/>
              <figcaption class="menu__1__descrip">Ensalada verde con aguacate, brotes tiernos, tomate cherry, zanahoria y aliño césar</figcaption>
              <figcaption class="menu__1__descrip">Precio: 4 €/plato </figcaption>
            </figure>
            <figure class="menu__2">
              <h4>Entrecot</h4><img class="menu__2__img" src="assets/img/desktop/entrecot.jpg" alt=""/>
              <figcaption class="menu__2__descrip">Entrecot de ternera a la parrilla con verduritas y patatas fritas</figcaption>
              <figcaption class="menu__1__descrip">Precio: 8.5 €/plato </figcaption>
            </figure>
            <figure class="menu__3">
              <h4>Espaguetis</h4><img class="menu__3__img" src="assets/img/desktop/espaguetis.jpg" alt=""/>
              <figcaption class="menu__3__descrip">Espaguetis con salsa boloñesa y carne picada de ternera             
              </figcaption>
              <figcaption class="menu__1__descrip">Precio: 4.5 €/plato </figcaption>
            </figure>
            <figure class="menu__4">
              <h4>Pechugas rebozadas</h4><img class="menu__4__img" src="assets/img/desktop/rebozado.jpg" alt=""/>
              <figcaption class="menu__4__descrip">Pechugas de pollo rebozadas con patatas fritas.</figcaption>
              <figcaption class="menu__1__descrip">Precio: 5.5 €/plato </figcaption>
            </figure>
          </section>
          <section class="main__form">
            <article class="main__form__tit">
              <h2>Lo recoges en el local o te lo llevamos donde quieras</h2>
              <h2>TÚ DECIDES</h2>
            </article>
            <form class="main__form__registro" method="POST" action="index_registrado.php">
              <h4>REGISTRATE</h4>
              <label for="nombre">Nombre:</label>
              <input type="text" name="nombre" placeholder="Introduce tu nombre"/>
              
              <label for="apellidos">Apellidos:</label>
              <input type="text" name="apellidos" placeholder="Introduce tus apellidos"/>

              <label for="direccion">Dirección:</label>
              <input type="text" name="direccion" placeholder="Introduce tu direccion"/>

              <label for="cp">Código postal:</label>
              <input type="text" name="cp" placeholder="Introduce tu CP"/>

              <label for="poblacion">Población:</label>
              <input type="text" name="poblacion" placeholder="Introduce tu poblacion"/>
              <label for="telefono">Teléfono:</label>
              <input type="text" name="telefono" placeholder="Introduce tu telefono"/>
              <label for="email">Email:</label>
              <input type="email" name="email" placeholder="Introduce tu email"/>
              <label for="clave">Contraseña:</label>
              <input type="password" name="clave" placeholder="Introduce tu clave"/>
              <button type="submit" name="enviar">REGISTRO</button>
            </form>
          </section>

        </div>
      </main>
      <footer class="footer">  
        <hr class="linea__division__footer"/>
        <ul class="footer__logo"> 
          <li><img class="footer__logo_img" src="/assets/img/svg/logo.svg" alt=""/></li>
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