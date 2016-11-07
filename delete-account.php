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
        $no_cuenta = $_GET['no_cuenta'];
         
        // delete data
        $pdo = Database::connect();
        // le decimos a la conexión que reporte excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM Cuentas WHERE id_cuenta = ?';
        $q = $pdo->prepare($sql); 
        $q->execute(array($no_cuenta));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $saldo1 = $data['saldo'];

        $sql = 'SELECT * FROM Cuentas WHERE usuario =\''.$_SESSION['nickname'].'\' LIMIT 1';
        $q = $pdo->prepare($sql); 
        $q->execute(array($no_cuenta));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $cuenta = $data['id_cuenta'];
        $saldo2 = $data['saldo']; 
        $nuevosaldo = $saldo1 + $saldo2;        

        $sql = 'UPDATE Cuentas set saldo = ? WHERE id_cuenta = ?';
        $q = $pdo->prepare($sql); 
        $q->execute(array($nuevosaldo,$cuenta));

        $sql = 'DELETE FROM Cuentas WHERE id_cuenta = ?';
        // Prepara una sentencia para su ejecución y devuelve un objeto sentencia
        $q = $pdo->prepare($sql); 
        // Ejecuta una sentencia preparada
        $q->execute(array($no_cuenta));
        Database::disconnect();
        header("Location: ./success.php");
        exit();
         
    }
?>