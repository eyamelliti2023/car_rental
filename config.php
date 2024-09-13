<?php
class config
{
    private static $pdo = null ;
    public static function getConnexion(){
        if(!isset(self::$pdo)){
        $host = 'localhost';
        $dbname = 'web';
        $username = 'root';
        $password = '';
        
        try{
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname",
               $username,
               $password,
               [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
               ]
            );
            
        }
        catch(Exception $e){
            die('error:' . $e->getMessage());
        }
      }
      return self::$pdo ;
    }

}

config::getConnexion() ;
?>
