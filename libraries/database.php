<?php 

class Database {
    private static $instance = null;

    /**
     * Returns connection to database
     * @return PDO
     */
    public static function getPdo(): PDO {
        // self == this for static functions
        if(self::$instance === null){ 
            // Attention, on précise ici deux options :
            // - Le mode d'erreur : le mode exception permet à PDO de nous prévenir violament quand on fait une connerie ;-)
            // - Le mode d'exploitation : FETCH_ASSOC veut dire qu'on exploitera les données sous la forme de tableaux associatifs 
            self::$instance = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } 
        return self::$instance;
    }

}
?>