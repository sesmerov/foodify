<?php

class DatabaseConnection {
    
    private static $model = null;
    private $dbh = null;
    
    public static function getModel(){
        if (self::$model == null){
            self::$model = new DatabaseConnection ();
        }
        return self::$model;
    }
    
   // Constructor privado  Patron singleton

   private function __construct() {
    try {
        // configurado el puerto 5433. Modificar si es necesario
        $dsn = "pgsql:host=" . DB_SERVER . ";port=5433;dbname=" . DATABASE . ";options='--client_encoding=UTF8'";
        $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
}


//AÑADIR AQUI FUNCIONES












    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$model != null){
            $obj = self::$model;
            // Cierro la base de datos
            $obj->dbh = null;
            self::$model = null; // Borro el objeto.
        }
    }



     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no está permitida', E_USER_ERROR); 
    }

}