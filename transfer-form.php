<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>La Banca - Transferencia</title>
  <link rel="stylesheet" href="css/materialize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <div class="row">
    <div class="col l12 s12">
      <div class="card grey darken-2">
        <div class="card-content white-text">
          <span class="card-title">Transferencia</span>
          <p>Ingrese los siguientes datos</p>
          <form action="transfer.php?no_cuenta=<?php echo $_GET['no_cuenta']; ?>" method="POST">
            <div class="input-field"> 
              <div class="form-group">
                <input type="number" class="form-control" name="account" placeholder="Num. cuenta">
                <input type="number" class="form-control" name="amount" placeholder="Cantidad">
              </div>
            </div>
            <div class="card-action center">
            <button class="btn waves-effect waves-light" type="submit" name="action">Transferir</button>
            <a href="profile.php" class="waves-effect waves-light btn">Cancelar</a>
          </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</body>
</html>