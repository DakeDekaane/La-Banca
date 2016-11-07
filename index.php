<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <title>La Banca - Inicio</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  
  <body>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.modal-trigger').leanModal();
      });
      $(document).ready(function(){
        $('ul.tabs').tabs();
      });
    </script>
    <main>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper grey darken-4">
            <a class="brand-logo">La Banca</a>
            <ul class="right hide-on-med-and-down">
              <li class="greeting">Bienvenido, 
              <?php
                if(!isset($_SESSION['nickname'])) {
              ?>
              Invitado</li>
              <?php
                }
                else {
                  echo $_SESSION['nickname'];
                }
              ?>
              </li>
              <li><a href="index.php">Inicio</a></li>
              <?php
                if(!isset($_SESSION['nickname'])) {
              ?>
              <li><a href="register.php">Crear cuenta</a></li>
              <li><a href="#modal-login" class="modal-trigger">Iniciar sesión</a></li>
              <?php
                }
                else {
              ?>
              <li><a href="profile.php">Mi perfil</a></li>
              <li><a href="logout.php">Cerrar sesión</a></li>
              <?
                }
              ?>
            </ul>
          </div>
        </nav>
      </div>
    
      <div id="modal-login" class="modal">
        <div class="modal-content">
          <div class="row">
            <form class="col l12" method="POST" action="login.php">
              <div class="row">
                <div class="col l8 center">
                  <p>Ingrese sus datos</p>
                </div>
                
                <div class="input-field col l8 offset-l2">
                  <input id="nickname" type="text" class="validate" name="nickname">
                  <label for="nickname">Nickname</label>
                </div>

                <div class="input-field col l8 offset-l2">
                  <input id="password" type="password" class="validate" name="password">
                  <label for="password">Contraseña</label>
                </div>
              </div>
              
              <div class="row center">
                <button class="btn waves-effect waves-light" type="submit" name="action">Iniciar sesión</button>
                <p> ¿No tiene una cuenta? <a href="register.php">Regístrase.</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="row" style="margin-bottom: 0px;">

        <div class="header row grey darken-4 z-depth-1">
          <div class="col l12 s12">
            <h1 class="center">La Banca</h1>
          </div>
        </div>

        <div class="row">
          <div class="col l8 offset-l2 s10 offset-s1 z-depth-1">
            <div class="row" style="margin-top: 11.25px;">
            <!--Inicio de contenido de la página-->
              <div class="col s12">
                <ul class="tabs">
                  <li class="tab col l3 s3"><a class="active grey-text text-darken-4" href="#welcome">Inicio</a></li>
                  <li class="tab col l3 s3"><a class="grey-text text-darken-4" href="#history">Historia</a></li>
                  <li class="tab col l3 s3"><a class="grey-text text-darken-4" href="#info">Información</a></li>
                  <li class="tab col l3 s3"><a class="grey-text text-darken-4" href="#services">Servicios</a></li>
                  <div class="indicator"></div>
                </ul>
              </div>
              <div id="welcome" class="col l10 offset-l1 s12">
                <h3>Inicio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo pariatur illo quae magni laudantium excepturi iure, nemo maxime! Natus, nobis.</p>
              </div>
              <div id="history" class="col l10 offset-l1 s12">
                <h3>Historia</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam praesentium, mollitia id laborum quisquam sunt possimus necessitatibus iste laudantium quidem nam ex fuga ipsa dolore modi a incidunt, aperiam. Earum hic officiis dolorem fuga nostrum iste repellat numquam ratione possimus.</p>
              </div>
              <div id="info" class="col l10 offset-l1 s12">
                <h3>Informacion</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate similique nobis expedita molestias blanditiis, dolorum temporibus beatae iusto, ut mollitia dicta doloremque minima labore earum minus, animi repellendus veniam tenetur neque ad quisquam sed nihil quod ullam? Deserunt, eos aut!</p>
              </div>
              <div id="services" class="col l10 offset-l1 s12">
                <h3>Servicios</h3>
                <div class="row">
                  <div class="col l12">
                    <div class="card grey darken-4">
                      <div class="card-content white-text">
                        <span class="card-title">Cuenta Bancaria</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae aut fuga consequuntur minima quod nemo! Deserunt, reiciendis molestias maxime. Qui vel dolorem, harum neque autem magni, doloremque sunt animi suscipit.</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col l12">
                    <div class="card grey darken-4">
                      <div class="card-content white-text">
                        <span class="card-title">Préstamos</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi aperiam voluptas esse assumenda, porro magni labore excepturi, at blanditiis. Quasi quisquam maiores animi eum accusantium, iusto nostrum ut magnam quis?</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col l12">
                    <div class="card grey darken-4">
                      <div class="card-content white-text">
                        <span class="card-title">Envío de dinero</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque at, a cumque recusandae labore saepe ullam voluptatibus praesentium eveniet autem. Rerum aperiam hic eum minus magni dolores illo molestiae, possimus?</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--Fin de contenido de la página-->
          </div>

          <div class="col l2">
            <ul class="collection with-header twitter-container z-depth-1">
              <li class="collection-header blue lighten-3">
                Twitter
              </li>
              <?php
                include 'app-twitter.php';
              ?>
            </ul>

            <ul class="collection with-header z-depth-1">
              <li class="collection-header grey lighten-3">
                Lista de usuarios
              </li>
              <?php
                include 'db.php';
                $pdo = Database::connect();
                $sql = 'SELECT nickname FROM Usuarios';
                foreach ($pdo->query($sql) as $row) {
                  echo '<li class="collection-item">'.$row['nickname'].'</li>';
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </main>
  
    <footer class="page-footer grey darken-4">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">La Banca</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="about-us.php">About us</a></li>
              <li><a class="grey-text text-lighten-3" href="comments.php">Comentarios</a></li>
            </ul>
          </div>
          <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Contáctanos</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="http://www.twitter.com/La-Banca" target="_blank">Twitter</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
          © 2016 Copyright
        </div>
      </div>
    </footer>
  </body>
</html>