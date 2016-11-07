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

        $nuevosaldo = $saldo1 + $_POST['amount'];

        $sql = 'UPDATE Cuentas set saldo = ? WHERE id_cuenta = ?';
        // Prepara una sentencia para su ejecución y devuelve un objeto sentencia
        $q = $pdo->prepare($sql); 
        // Ejecuta una sentencia preparada
        $q->execute(array($nuevosaldo,$no_cuenta));
        Database::disconnect();
        header("Location: ./success.php");
        exit();
         
    }
?>