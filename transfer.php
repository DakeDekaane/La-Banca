<?php
    //se incluye el archivo de database.php
    session_start();
    if( !isset($_SESSION['nickname']) ){
        header('location: ./index.html');
        exit();
    }

    require 'db.php';
    $no_cuenta = 0;
     
    if ( !empty($_GET)) {
        //obtiene su valor de post
        $cuenta_origen = $_GET['no_cuenta'];
        $cuenta_destino = $_POST['account'];
        $cantidad = $_POST['amount'];
        
        echo $cuenta_origen;
        echo $cuenta_destino;

        // delete data
        $pdo = Database::connect();
        // le decimos a la conexión que reporte excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM Cuentas WHERE id_cuenta = ?';
        $q = $pdo->prepare($sql); 
        $q->execute(array($cuenta_origen));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $saldo_cuenta_origen = $data['saldo'];

        echo $saldo_cuenta_origen;
        if($cantidad > $saldo_cuenta_origen) {
          header("location: ./error-funds.php");
          exit();
        }

        $sql = 'SELECT * FROM Cuentas WHERE id_cuenta = ?';
        $q = $pdo->prepare($sql); 
        $q->execute(array($cuenta_destino));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        
        echo $data['id_cuenta'];
        if($data['id_cuenta'] == null) {
          header("location: ./error-account.php");
          exit();
        }
        
        $saldo_cuenta_destino = $data['saldo'];
        echo $saldo_cuenta_destino;
        $nuevo_saldo_cuenta_origen = $saldo_cuenta_origen - $cantidad;
        $nuevo_saldo_cuenta_destino = $saldo_cuenta_destino + $cantidad;
        echo $nuevo_saldo_cuenta_destino;
        echo $nuevo_saldo_cuenta_origen;

        $sql = 'UPDATE Cuentas set saldo = ? WHERE id_cuenta = ?';
        // Prepara una sentencia para su ejecución y devuelve un objeto sentencia
        $q = $pdo->prepare($sql); 
        // Ejecuta una sentencia preparada
        $q->execute(array($nuevo_saldo_cuenta_origen,$cuenta_origen));

        $sql = 'UPDATE Cuentas set saldo = ? WHERE id_cuenta = ?';
        // Prepara una sentencia para su ejecución y devuelve un objeto sentencia
        $q = $pdo->prepare($sql); 
        // Ejecuta una sentencia preparada
        $q->execute(array($nuevo_saldo_cuenta_destino,$cuenta_destino));

        Database::disconnect();
        header("location: ./success.php");
        exit();
         
    }
?>