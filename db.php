<?php
//limitar acceso de este archivo!!!
class Database {
    private static $dbName = 'La Banca' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Funcion init no permitida');
    }
     
    public static function connect() {
      // una sóla conexión en toda la aplicación
      if ( null == self::$cont )
      {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e) {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
    }
     
    public static function disconnect() {
        self::$cont = null;
    }
}
?>