<?php
  session_start();
  if(!isset($_SESSION['nickname'])) {
    header('location: ./index.php');
    exit();
  }
?>
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
              <div class="row">
                <div class="col l6 s12 m6">
                  <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                      <span class="card-title">Perfil de usuario</span>
                      <p><b>Nickname:</b>
                      <?php
                        echo $_SESSION['nickname'];
                      ?>
                      </p>
                      <p><b>Nombre:</b>
                      <?php
                        echo $_SESSION['nombre'];
                      ?></p>
                      <p><b>Correo electrónico:</b>
                      <?php
                        echo $_SESSION['email'];
                      ?></p>
                      <p><b>Saldo total:</b>
                      <?php
                        include 'db.php';
                        $saldo_total = 0;
                        $pdo = Database::connect();
                        $sql = 'SELECT saldo FROM Cuentas WHERE usuario=\''.$_SESSION['nickname'].'\'';
                          foreach ($pdo->query($sql) as $row) {
                          $saldo_total += $row['saldo'];
                        }
                        Database::disconnect();
                        echo '$'.$saldo_total;
                      ?></p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col l12 s12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th>Número de cuenta</th>
                        <th>Saldo Actual</th>
                        <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 0;
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM Cuentas WHERE usuario=\''.$_SESSION['nickname'].'\'';
                        foreach ($pdo->query($sql) as $row) {
                      ?>
                      <tr>
                        <td>
                        <?php
                          echo $row['id_cuenta'];
                        ?>
                        </td>
                        <td>
                        <?php
                          echo '$'.$row['saldo'];
                        ?>
                        </td>
                        <td>
                          <div class="row">
                            <a href="deposit-form.php?no_cuenta=<?php echo $row['id_cuenta']?>" class="waves-effect waves-light btn btn-table light-green modal-trigger">Depositar</a>
                          </div>
                          <div class="row">
                            <a href="withdraw-form.php?no_cuenta=<?php echo $row['id_cuenta']?>" class="waves-effect waves-light btn btn-table orange lighten-1 modal-trigger">Retirar</a>
                          </div>
                          <div class="row">
                            <a href="transfer-form.php?no_cuenta=<?php echo $row['id_cuenta']?>" class="waves-effect waves-light btn btn-table blue lighten-2 modal-trigger">Transferir</a>
                          </div>
                          <div class="row">
                          <?php
                            if($i != 0){
                          ?>
                            <a href="delete-confirm.php?no_cuenta=<?php echo $row['id_cuenta']?>" class="waves-effect waves-light btn btn-table deep-orange lighten-1 modal-trigger">Eliminar</a>
                          <?php
                            }
                            else {
                          ?>
                            <a class="waves-effect waves-light btn btn-table disabled">Eliminar</a>
                          <?php
                            }
                            $i += 1;
                          ?>
                          </div>
                        </td>
                        <?php
                          }
                          Database::disconnect();
                        ?>
                      </tr>
                    </tbody>
                  </table>
                </div>  
                <div class="row">
                  <a href="create-account.php" class="waves-effect waves-light btn btn-table light-green">Crear cuenta</a>
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