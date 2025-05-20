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
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish ORDER BY id_dish LIMIT :limit OFFSET :offset");
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
        $stmt = $this->dbh->prepare("SELECT * FROM public.user ORDER BY id_user LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOrders($limit, $offset)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.order ORDER BY id_order LIMIT :limit OFFSET :offset");
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

    public function getDishesByName($name)
    {
        $name = (string) $name;

        $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE name ILIKE :name");
        $stmt->bindValue(':name', '%' . $name . '%');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();

        return $stmt->fetchAll();
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

    public function GetDishQuantity($id, $id_order)
    {
        $stmt = $this->dbh->prepare("SELECT quantity FROM public.order_detail WHERE id_dish = :id AND id_order = :id_order");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAllergen($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.allergen WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Allergen');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getDishById($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.dish WHERE id_dish = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dish');
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllergensByDishID($id)
    {
        $stmt = $this->dbh->prepare("
        SELECT da.id_allergen 
        FROM dish_allergen da 
        WHERE da.id_dish = :id
    ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM public.user WHERE email = ?");
        $stmt->execute([$email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch(); // Devuelve un objeto User o false si no existe
    }

    public function getDishesByIds(array $ids)
    {
        if (empty($ids)) return [];

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->dbh->prepare("SELECT * FROM dish WHERE id_dish IN ($placeholders)");
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Dish');
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

    public function getAllergensCode(int $dishId): array
    {
        $sql = "SELECT a.id_allergen 
            FROM dish_allergen da 
            JOIN allergen a ON da.id_allergen = a.id_allergen 
            WHERE da.id_dish = :dishId";
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

        $stmt->bindValue(':name', $dish->__get('name'));
        $stmt->bindValue(':price', $dish->__get('price'));
        $stmt->bindValue(':type', $dish->__get('type'));
        $stmt->bindValue(':details', $dish->__get('details'));
        $stmt->bindValue(':id', $dish->__get('id_dish'));

        $stmt->execute();
        return $stmt->rowCount() === 1;
    }
    public function updateUser($user)
    {
        $stmt = $this->dbh->prepare("UPDATE public.user SET first_name = :first_name, password = :password, last_name = :last_name, email = :email, address = :address, role = :role WHERE id_user = :id");
        $stmt->bindParam(':first_name', $user->__get('first_name'));
        $stmt->bindParam(':password', $user->__get('password'));
        $stmt->bindParam(':last_name', $user->__get('last_name'));
        $stmt->bindParam(':email', $user->__get('email'));
        $stmt->bindParam(':address', $user->__get('address'));
        $stmt->bindParam(':role', $user->__get('role'));
        $stmt->bindParam(':id', $user->__get('id_user'));
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function updateOrder($order)
    {
        $stmt = $this->dbh->prepare("UPDATE public.order SET delivery_address = :address, status = :status  WHERE id_order = :id");
        $stmt->bindParam(':address', $order->delivery_address);
        $stmt->bindParam(':status', $order->status);
        $stmt->bindParam(':id', $order->id_order);
        return $stmt->execute();
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
        try {
            $stmt = $this->dbh->prepare(" INSERT INTO public.user (first_name, password, last_name, email, address, role)  VALUES (:first_name, :password, :last_name, :email, :address, :role)");
            $stmt->bindValue(':first_name', $user->__get('first_name'), PDO::PARAM_STR);
            $stmt->bindValue(':password', $user->__get('password'), PDO::PARAM_STR);
            $stmt->bindValue(':last_name', $user->__get('last_name'), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->__get('email'), PDO::PARAM_STR);
            $stmt->bindValue(':address', $user->__get('address'), PDO::PARAM_STR);
            $stmt->bindValue(':role', $user->__get('role'), PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (\PDOException $e) {

            if ($e->getCode() == '23505') {
                error_log("Registro fallido: Correo ya existe - " . $user->__get('email'));
                return 'email_duplicado';
            }

            error_log("Error en registerUser: " . $e->getMessage());
            return false;
        } catch (\Throwable $th) {

            error_log("Error crítico en registerUser: " . $th->getMessage());
            return false;
        }
    }

    public function addAllergentoaDish($id_allergen, $id_dish)
    {
        $stmt = $this->dbh->prepare("
        INSERT INTO public.dish_allergen (id_allergen, id_dish) 
        VALUES (:id_allergen, :id_dish)
        ON CONFLICT (id_allergen, id_dish) DO NOTHING
    ");
        $stmt->bindParam(':id_allergen', $id_allergen, PDO::PARAM_INT);
        $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }
    public function addOrder($order)
    {
        $stmt = $this->dbh->prepare("INSERT INTO public.order (order_date, total_price, delivery_address, status, id_user) VALUES (:order_date, :total_price, :delivery_address, :status, :id_user)");
        $stmt->bindParam(':order_date', $order->__get('order_date'));
        $stmt->bindParam(':total_price', $order->__get('total_price'));
        $stmt->bindParam(':delivery_address', $order->__get('delivery_address'));
        $stmt->bindParam(':status', $order->__get('status'));
        $stmt->bindParam(':id_user', $order->__get('id_user'));
        if ($stmt->execute()) {
            return $this->dbh->lastInsertId();
        }
        return false;
    }

    public function addOrderDetail($id_order, $id_dish, $unit_price, $quantity)
    {
        $stmt = $this->dbh->prepare("INSERT INTO public.order_detail (id_order, id_dish, unit_price, quantity) VALUES (:id_order, :id_dish, :unit_price, :quantity)");
        $stmt->bindParam(':id_order', $id_order, PDO::PARAM_INT);
        $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
        $stmt->bindParam(':unit_price', $unit_price, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
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
    try {
        $this->dbh->beginTransaction();
        

        $stmt_detail = $this->dbh->prepare("DELETE FROM public.order_detail WHERE id_order = :id");
        $stmt_detail->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_detail->execute();
        

        $stmt_order = $this->dbh->prepare("DELETE FROM public.order WHERE id_order = :id");
        $stmt_order->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_order->execute();
        
        $this->dbh->commit();
        return true;
        
    } catch (PDOException $e) {
        $this->dbh->rollBack();
        error_log("Error deleting order: " . $e->getMessage());
        return false;
    }
}
    public function deleteAllergenfromaDish($id_dish, $id_allergen)
    {
        $stmt = $this->dbh->prepare("DELETE FROM public.dish_allergen WHERE id_dish = :id_dish AND id_allergen = :id_allergen");
        $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
        $stmt->bindParam(':id_allergen', $id_allergen, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() === 1;
    }

    public function deleteAllAllergensFromDish($id_dish)
    {
        $stmt = $this->dbh->prepare("
        DELETE FROM public.dish_allergen 
        WHERE id_dish = :id_dish
    ");
        $stmt->bindParam(':id_dish', $id_dish, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
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
