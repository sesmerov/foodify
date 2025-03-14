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
        $dsn = "pgsql:host=" . DB_SERVER . ";port=5432;dbname=" . DATABASE . ";options='--client_encoding=UTF8'";
        $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
}


//AÑADIR AQUI FUNCIONES


public function numdishes(){
    $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM dish");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;

}

public function numusers(){
    $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM user");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;

}


public function numorder(){
    $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM order");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;

}
public function getdishes($first,$many){
   $dishes=[];
   $stmt = $this->dbh->prepare("SELECT * FROM dish limit $first,$many");
   $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');

   if ($stmt->execute()) {
       while ($dish = $stmt->fetch()) {
           $dishes[] = $dish;
       }

   } 
   return $dishes;

}

public function getusers($first,$many){
    $users=[];
    $stmt = $this->dbh->prepare("SELECT * FROM user limit $first,$many");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
 
    if ($stmt->execute()) {
        while ($user = $stmt->fetch()) {
            $users[] = $user;
        }
 
    } 
    return $users;
 
 }

 public function getorders($first,$many){
    $orders=[];
    $stmt = $this->dbh->prepare("SELECT * FROM Order limit $first,$many");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
 
    if ($stmt->execute()) {
        while ($order = $stmt->fetch()) {
            $orders[] = $order;
        }
 
    } 
    return $orders;
 
 }

 public function filter($filter){
    $dishes = [];
    $stmt = $this->dbh->prepare("SELECT * FROM dish WHERE type LIKE :filter");
    $stmt->bindParam(':filter', $filter);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
    if ($stmt->execute()) {
        while ($dish = $stmt->fetch()) {
            $dishes[] = $dish;
        }

    }
    return $dishes;

 }

 public function Sortable($order,$first,$many,$table){
    $result = [];
    $stmt = $this->dbh->prepare("SELECT * FROM $table ORDER BY $order limit $first, $many");
    $stmt->setFetchMode(PDO::FETCH_CLASS, $table);
    if ($stmt->execute()) {
        while ($res = $stmt->fetch()) {
            $result[] = $res;
        }

    }
    return $result;
 }

 //GETS 
 public function getDish($id){
    $stmt = $this->dbh->prepare("SELECT * FROM dish WHERE id_dish = $id");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
    $stmt->execute();
    $dish = $stmt->fetch();
    return $dish;
 }

 public function getuser($id){
    $stmt = $this->dbh->prepare("SELECT * FROM user WHERE id_user = $id");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
 }



public function getorder($id){
    $stmt = $this->dbh->prepare("SELECT * FROM order WHERE id_order = $id");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
    $stmt->execute();
    $order = $stmt->fetch();
    return $order;
 }

 public function getallergen($id){
    $stmt = $this->dbh->prepare("SELECT * FROM allergen where id  = $id");
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Allergen');
    $stmt->execute();
    $allergen = $stmt->fetch();
    return $allergen;
 }

 public function getallergendish($id_dish){
    $allergens = [];
    $stmt  = $this->dbh->prepare("SELECT id_allergen from dish_allergen where id_dish = $id_dish");
    $stmt->execute();
    while ($res = $stmt->fetch()) {
        $allergen = $this->getallergen($res['id_allergen']);
        $allergens[] = $allergen;
        }
        return $allergens;

 }

 public function getsorderdishes($id){
    $dishes = [];
    $stmt  = $this->dbh->prepare("SELECT id_dish FROM order_detail where id_order= $id");
    $stmt->execute();
    while ($res = $stmt->fetch()) {
        $dish = $this->getDish($res['id_dish']);
        $dishes[] = $dish;
        }
        return $dishes;
 }


//UPDATES 

 public function moddish($dish){
 $stmt = $this->dbh->prepare("UPDATE dish SET name=:name,price=:price,type=:type WHERE id_dish=:id");
 $stmt->bindParam(':name', $dish->name);
 $stmt->bindParam(':price', $dish->price);
 $stmt->bindParam(':type', $dish->type);
 $stmt->bindParam(':id', $dish->id_dish);
 
 $stmt->execute();
 $resu = ($stmt->rowCount () == 1);
 return $resu;
 }

 public function moduser($user){
$stmt  = $this->dbh->prepare("UPDATE user SET first_name=:first_name,password=:password,last_name=:last_name,email=:email,address=:address,role=:role Where id_user=:id");
$stmt->bindParam(':first_name', $user->first_name);
$stmt->bindParam(':password', $user->password);
$stmt->bindParam(':last_name', $user->last_name);
$stmt->bindParam(':email', $user->email);
$stmt->bindParam(':address', $user->address);
$stmt->bindParam(':role', $user->role);
$stmt->bindParam(':id', $user->id_user);
$stmt->execute();
    $resu = ($stmt->rowCount () == 1);
    return $resu;

 }

 public function modorder($order){
    // entiendo que solo nos interesa actualizar el status
    $stmt = $this->dbh->prepare("UPDATE order SET status=:status WHERE id_order=:id");
    $stmt->bindParam(':status', $order->status);
    $stmt->bindParam(':id', $order->id_order);
    $stmt->execute();
    $resu = ($stmt->rowCount () == 1);
    return $resu;
    }

    public function adddish($dish){
        $stmt = $this->dbh->prepare("INSERT INTO dish (name, price, type) VALUES (:name, :price, :type)");
        $stmt->bindParam(':name', $dish->name);
        $stmt->bindParam(':price', $dish->price);
        $stmt->bindParam(':type', $dish->type);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }

    //AÑADIR
    public function register($user){
        $stmt = $this->dbh->prepare("INSERT INTO user (first_name, password, last_name, email, address, role) VALUES (:first_name, :password, :last_name, :email, :address, :role)");
        $stmt->bindParam(':first_name', $user->first_name);
        $stmt->bindParam(':password', $user->password);
        $stmt->bindParam(':last_name', $user->last_name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':address', $user->address);
        $stmt->bindParam(':role', $user->role);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }

    public function neworder($order){
        $stmt = $this->dbh->prepare("INSERT INTO order (order_date, total_price, delivery_address,status,id_user) VALUES (:order_date, :total_price, :delivery_address,:status,:id_user)");
        $stmt->bindParam(':order_date', $order->order_date);
        $stmt->bindParam(':total_price', $order->total_price);
        $stmt->bindParam(':delivery_address', $order->delivery_address);
        $stmt->bindParam(':status', $order->status);
        $stmt->bindParam(':id_user', $order->id_user);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }


    //BORRAR
    public function deletedish($id){
        $stmt = $this->dbh->prepare("DELETE FROM dish WHERE id_dish = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }

    public function deleteuser($id){
        $stmt = $this->dbh->prepare("DELETE FROM user WHERE id_user = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }

    public function deleteorder($id){
        $stmt = $this->dbh->prepare("DELETE FROM order WHERE id_order = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resu = ($stmt->rowCount () == 1);
        return $resu;
    }








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