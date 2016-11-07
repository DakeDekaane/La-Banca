<?php
    
    session_start();
    if( !isset($_SESSION['nickname']) ){
        header('location: ./index.php');
        exit();
    }

    else {

        require 'db.php';
     
        $nickname = $_SESSION['nickname'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO Cuentas (usuario) values(?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nickname));
        Database::disconnect();
        header('location: ./success.php');
        exit();
    }
?>