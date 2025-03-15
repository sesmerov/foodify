<?php


include_once 'app/config/configDB.php';

require_once 'app/models/Dish.php';

require_once 'app/models/Order.php';

require_once 'app/models/User.php';

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
        // configurado el puerto 5432. Modificar si es necesario
        $dsn = "pgsql:host=" . DB_SERVER . ";port=5432;dbname=" . DATABASE . ";options='--client_encoding=UTF8'";
        $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }
}


//AÑADIR AQUI FUNCIONES



// ==== COUNTS ====

public function getNumDishes() {
    $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM public.dish");
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function getNumUsers() {
    $stmt = $this->dbh->prepare("SELECT count(*) FROM public.user");
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function getNumOrders() {
    $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM public.order");
    $stmt->execute();
    return $stmt->fetchColumn();
}


// ==== GETS PARA LISTAS ====

public function getDishes($limit, $offset) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.dish LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
    $stmt->execute();
    return $stmt->fetchAll();
}

public function getUsers($limit, $offset) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.user LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    return $stmt->fetchAll();
}

public function getOrders($limit, $offset) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.order LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
    $stmt->execute();
    return $stmt->fetchAll();
}


// ==== GET POR ID ====

public function getDish($id) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE id_dish = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
    $stmt->execute();
    return $stmt->fetch();
}

public function getUser($id) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.user WHERE id_user = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
    $stmt->execute();
    return $stmt->fetch();
}

public function getOrder($id) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.order WHERE id_order = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
    $stmt->execute();
    return $stmt->fetch();
}

public function getAllergen($id) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.allergen WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Allergen');
    $stmt->execute();
    return $stmt->fetch();
}


// ==== FILTRADO, ORDENAR ====

public function FilterDishes($filter) {
    $filter = "%$filter%";
    $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE type LIKE :filter");
    $stmt->bindParam(':filter', $filter);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
    $stmt->execute();
    return $stmt->fetchAll();
}

public function getSortable($order, $offset, $limit, $table) {
    $stmt = $this->dbh->prepare("SELECT * FROM public.$table ORDER BY $order LIMIT :offset, :limit");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $table);
    $stmt->execute();
    return $stmt->fetchAll();
}


// ==== REELACIONES? ====


public function getAllergensByDish($dishId) {
    $stmt = $this->dbh->prepare("SELECT id_allergen FROM public.dish_allergen WHERE id_dish = :dishId");
    $stmt->bindParam(':dishId', $dishId, PDO::PARAM_INT);
    $stmt->execute();
    $allergens = [];
    while ($row = $stmt->fetch()) {
        $allergens[] = $this->getAllergen($row['id_allergen']);
    }
    return $allergens;
}

public function getOrderDishes($orderId) {
    $stmt = $this->dbh->prepare("SELECT id_dish FROM public.order_detail WHERE id_order = :orderId");
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();
    $dishes = [];
    while ($row = $stmt->fetch()) {
        $dishes[] = $this->getDish($row['id_dish']);
    }
    return $dishes;
}


// ==== UPDATES ====

public function UpdateDish($dish) {
    $stmt = $this->dbh->prepare("UPDATE public.dish SET name = :name, price = :price, type = :type, details = :details WHERE id_dish = :id");
    $stmt->bindParam(':name', $dish->name);
    $stmt->bindParam(':price', $dish->price);
    $stmt->bindParam(':type', $dish->type);
    $stmt->bindParam(':details', $dish->details);
    $stmt->bindParam(':id', $dish->id_dish);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

public function UpdateUser($user) {
    $stmt = $this->dbh->prepare("UPDATE public.user SET first_name = :first_name, password = :password, last_name = :last_name, email = :email, address = :address, role = :role WHERE id_user = :id");
    $stmt->bindParam(':first_name', $user->first_name);
    $stmt->bindParam(':password', $user->password);
    $stmt->bindParam(':last_name', $user->last_name);
    $stmt->bindParam(':email', $user->email);
    $stmt->bindParam(':address', $user->address);
    $stmt->bindParam(':role', $user->role);
    $stmt->bindParam(':id', $user->id_user);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

public function UpdateOrder($order) {
    $stmt = $this->dbh->prepare("UPDATE public.order SET status = :status WHERE id_order = :id");
    $stmt->bindParam(':status', $order->status);
    $stmt->bindParam(':id', $order->id_order);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}


// ==== ADDS ====

public function AddDish($dish) {
    $stmt = $this->dbh->prepare("INSERT INTO public.dish (name, price, type, details) VALUES (:name, :price, :type, :details)");
    $stmt->bindParam(':name', $dish->name);
    $stmt->bindParam(':price', $dish->price);
    $stmt->bindParam(':type', $dish->type);
    $stmt->bindParam(':details', $dish->details);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

public function RegisterUser($user) {
    $stmt = $this->dbh->prepare("INSERT INTO public.user (first_name, password, last_name, email, address, role) VALUES (:first_name, :password, :last_name, :email, :address, :role)");
    $stmt->bindParam(':first_name', $user->first_name);
    $stmt->bindParam(':password', $user->password);
    $stmt->bindParam(':last_name', $user->last_name);
    $stmt->bindParam(':email', $user->email);
    $stmt->bindParam(':address', $user->address);
    $stmt->bindParam(':role', $user->role);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

// ==== DELETE====

public function DeleteDish($id) {
    $stmt = $this->dbh->prepare("DELETE FROM public.dish WHERE id_dish = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

public function DeleteUser($id) {
    $stmt = $this->dbh->prepare("DELETE FROM public.user WHERE id_user = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

public function DeleteOrder($id) {
    $stmt = $this->dbh->prepare("DELETE FROM public.order WHERE id_order = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount() === 1;
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