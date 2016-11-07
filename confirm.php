<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <title>La Banca - Perfil de usuario</title>
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
              Invitado
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
              
              <div class="col10 offset-l1">
                <h3>Juego en JS</h3>
                <?php
                  echo $_POST['nickname'].'<br>';
                  echo $_POST['password'].'<br>';
                ?>
                <script>
                  function login() {
                    $.post("login.php", { nickname: '<?php echo $_POST['nickname']; ?>', password: '<?php echo $_POST['password']; ?>' });
                  }
                </script>
                <button onclick="login()" id="confirm" type="button" class="btn waves-effect waves-light">Confirmar</button>
                
              </div>
              
            <!--Fin de contenido de la página-->
            </div>
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