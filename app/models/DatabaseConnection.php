<?php


include_once 'app/config/configDB.php';

require_once 'app/models/Dish.php';

require_once 'app/models/Order.php';

require_once 'app/models/User.php';

class DatabaseConnection
{

    private static $model = null;
    private $dbh = null;

    public static function getModel()
    {
        if (self::$model == null) {
            self::$model = new DatabaseConnection();
        }
        return self::$model;
    }

    // Constructor privado  Patron singleton

    private function __construct()
    {
        try {
            // configurado el puerto 5432. Modificar si es necesario
            $dsn = "pgsql:host=" . getenv('DB_SERVER') . ";port=5432;dbname=" . getenv('DATABASE') . ";options='--client_encoding=UTF8'";
            $this->dbh = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASSWD'));
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }


    //AÑADIR AQUI FUNCIONES



    // ==== COUNTS ====

    public function getNumDishes()
    {
        $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM public.dish");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getNumUsers()
    {
        $stmt = $this->dbh->prepare("SELECT count(*) FROM public.user");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getNumOrders()
    {
        $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM public.order");
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    // ==== GETS PARA LISTAS ====


    public function getAllDishes(): array
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getDishes($limit, $offset)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getRandomDishes($limit = 6)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish ORDER BY RANDOM() LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUsers($limit, $offset)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.user LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOrders($limit, $offset)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.order LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getAllDishTypes(): array
    {
        $sql = "SELECT unnest(enum_range(NULL::public.dish_type_enum)) AS type";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getAllAllergens(): array
    {
        $sql = "SELECT name FROM public.allergen ORDER BY name";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public function getDishesByFilters(array $types, array $allergens): array
    {
        // Construimos dinámicamente los placeholders para los IN()
        $inTypes  = implode(',', array_fill(0, count($types), '?'));
        $params   = $types;

        $sql  = "SELECT d.* 
             FROM public.dish AS d
             WHERE d.type IN ($inTypes)";

        if (!empty($allergens)) {
            // Si hay alérgenos, añadimos la subconsulta NOT IN(...)
            $inAll = implode(',', array_fill(0, count($allergens), '?'));
            $sql  .= " AND d.id_dish NOT IN (
                      SELECT da.id_dish
                      FROM public.dish_allergen AS da
                      JOIN public.allergen     AS a  ON a.id_allergen = da.id_allergen
                      WHERE a.name IN ($inAll)
                   )";
            // Al final de $params van los alérgenos
            $params = array_merge($params, $allergens);
        }

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Dish');
    }


    // ==== GET POR ID ====

    public function getDish($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE id_dish = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUser($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.user WHERE id_user = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getOrder($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.order WHERE id_order = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllergen($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.allergen WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Allergen');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getDishById($id){
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE id_dish = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllergenByDishID($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish_allergen WHERE id_dish = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Allergen');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    


    // ==== FILTRADO, ORDENAR ====

    public function getDishesByType($filter)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE type = :filter");
        $stmt->bindParam(':filter', $filter);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getSortable($order, $offset, $limit, $table)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.$table ORDER BY $order LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $table);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // ==== REELACIONES? ====


public function getAllergensByDish(int $dishId): array
{
    $sql = "SELECT a.name FROM public.dish_allergen da JOIN public.allergen a ON a.id_allergen = da.id_allergen WHERE da.id_dish = :dishId ORDER BY a.name";
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':dishId', $dishId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

    public function getOrderDishes($orderId)
    {
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

    public function updateDish($dish)
    {
        $stmt = $this->dbh->prepare("UPDATE public.dish SET name = :name, price = :price, type = :type, details = :details WHERE id_dish = :id");
        $stmt->bindParam(':name', $dish->name);
        $stmt->bindParam(':price', $dish->price);
        $stmt->bindParam(':type', $dish->type);
        $stmt->bindParam(':details', $dish->details);
        $stmt->bindParam(':id', $dish->id_dish);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function updateUser($user)
    {
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

    public function updateOrder($order)
    {
        $stmt = $this->dbh->prepare("UPDATE public.order SET status = :status WHERE id_order = :id");
        $stmt->bindParam(':status', $order->status);
        $stmt->bindParam(':id', $order->id_order);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }


    // ==== ADDS ====

    public function addDish($dish)
    {
        $stmt = $this->dbh->prepare("INSERT INTO public.dish (name, price, type, details) VALUES (:name, :price, :type, :details)");
        $stmt->bindParam(':name', $dish->name);
        $stmt->bindParam(':price', $dish->price);
        $stmt->bindParam(':type', $dish->type);
        $stmt->bindParam(':details', $dish->details);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function registerUser($user)
    {
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

    public function deleteDish($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM public.dish WHERE id_dish = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function deleteUser($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM public.user WHERE id_user = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function deleteOrder($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM public.order WHERE id_order = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }







    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$model != null) {
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
