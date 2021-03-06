<?php
  session_start();
  if(isset($_SESSION['nickname'])) {
    header('location: ./index.php');
    exit();
  }

  if ( !empty($_POST)) {
    $nicknameError = null;
    $nombreError = null;
    $emailError = null;
    $passwordError = null;
     
    $nickname = $_POST['nickname'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password1'];
    $password_conf = $_POST['password2'];
    $email = $_POST['email'];
     
    $valid = true;
    if (empty($nickname)) {
      $nicknameError = 'Insertar nickname';
      $valid = false;
    }
    
    if (empty($nombre)) {
      $nombreError = 'Insertar nombre';
      $valid = false;
    }

    if (empty($password)) {
      $passwordError = 'Insertar password';
      $valid = false;
    }

    if ($password != $password_conf) {
      $passwordconfError = 'Las contraseñas ingresadas no coinciden';
      $valid = false; 
    }
     
    if (empty($email)) {
      $emailError = 'Insertar email';
      $valid = false;
    }
     
    if ($valid) {

      require 'db.php';
      
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO Usuarios (nickname,nombre,email,password) values(?,?,?,?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($nickname,$nombre,$email,$password));
      Database::disconnect();
      header('location: ./success.php');
      exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <title>La Banca - Registro</title>
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
              <form class="col l12" action="register.php" method="POST">
                <div class="row">
                  <div class="row center">
                    <h3>Registro de usuario</h3>
                    <div class="col l8 offset-l2">
                      <p>Por favor, llene los siguientes campos.</p>
                    </div>
                  </div>
                  
                  <div class="input-field col l6 offset-l2">
                    <input id="nickname" type="text" class="validate" name="nickname" <?php if(!empty($_POST['nickname'])) { echo ' value="'.$_POST['nickname'].'"'; } ?>>
                    <?php if (!empty($nicknameError)) { echo '<span class="red-text">'.$nicknameError.'</span>'; }?>
                    <label for="nickname">Nickname</label>
                    
                  </div>

                  <div class="input-field col l6 offset-l2">
                    <input id="password1" type="password" class="validate" name="password1">
                    <?php if (!empty($passwordError)) { echo '<span class="red-text">'.$passwordError.'</span>'; }?>
                    <label for="password1">Contraseña</label>
                    
                  </div>

                  <div class="input-field col l6 offset-l2">
                    <input id="password2" type="password" class="validate" name="password2">
                    <?php if (!empty($passwordconfError)) { echo '<span class="red-text">'.$passwordconfError.'</span>'; }?>
                    <label for="password2">Confirmar contraseña</label>
                    
                  </div>

                  <div class="input-field col l6 offset-l2">
                    <input id="nombre" type="text" class="validate" name="nombre"<?php if(!empty($_POST['nombre'])) { echo ' value="'.$_POST['nombre'].'"'; } ?>>
                    <?php if (!empty($nombreError)) { echo '<span class="red-text">'.$nombreError.'</span>'; } ?>
                    <label for="nombre">Nombre</label>
                    
                  </div>

                  <div class="input-field col l6 offset-l2">
                    <input id="email" type="email" class="validate" name="email"<?php if(!empty($_POST['email'])) { echo ' value="'.$_POST['email'].'"'; } ?>>
                    <?php if (!empty($emailError)) { echo '<span class="red-text">'.$emailError.'</span>'; } ?>
                    <label for="email">Correo electrónico</label>
                    
                  </div>
                </div>
                <div class="row center">
                  <button class="btn waves-effect waves-light grey darken-2" type="submit" name="action">Registrarse</button>
                </div>
              </form>
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