<?php
include_once 'app/controllers/dishController.php';
include_once 'app/controllers/userController.php';
include_once 'app/helpers/utilities.php';
include_once 'app/models/DatabaseConnection.php';
include_once 'app/models/Dish.php';
include_once 'app/models/User.php';
include_once 'app/models/Order.php';
include_once 'app/models/Allergen.php';
include_once 'app/controllers/OrderController.php';

session_start();
if (!isset($id_dish)) {
    $id_dish = null;
}
if (!isset($_SESSION['userLogged'])) {
    $_SESSION['userLogged'] = null;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

ob_start();
$controller = new DishController();
$dishes = $controller->showRandomDishes();
$users = new userController();
$orders = new orderController();


require_once 'app/views/main.php'; // Renderiza la vista principal

define('FPAG', 5);
$db = DatabaseConnection::getModel();

if (isset($_GET["order"])) {
    switch ($_GET["order"]) {
        case 'usu':
            $usufiles = $db->getNumUsers();
            break;
        case 'order':
            $usufiles = $db->getNumOrders();
            break;
        case 'dish':
            $usufiles = $db->getNumDishes();
            break;
    }
}

if (isset($usufiles)) {
    if ($usufiles % FPAG == 0) {
        $posfin = $usufiles - FPAG;
    } else {
        $posfin = $usufiles - ($usufiles % FPAG);
    }
}

if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];

if (isset($_GET['order'])) {
    if (isset($_SESSION['last_order']) && $_SESSION['last_order'] !== $_GET['order']) {
        $_SESSION['posini'] = 0;
        $posAux = 0;
    }
    $_SESSION['last_order'] = $_GET['order'];
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    //controles para el crudnav
    if (isset($_GET['nav'])) {
        switch ($_GET['nav']) {
            case "Begin":
                $posAux = 0;
                break;
            case "Next":
                $posAux += FPAG;
                if ($posAux > $posfin) $posAux = $posfin;
                break;
            case "Before":
                $posAux -= FPAG;
                if ($posAux < 0) $posAux = 0;
                break;
            case "Last":
                $posAux = $posfin;
        }
        $_SESSION['posini'] = $posAux;
    }

    //controles para las ordenes
    if (isset($_GET["order"])) {
        $order = $_GET["order"];
    } else {
        $order = null;
    }

    switch ($order) {
        case 'profile':
            ob_clean();
            $user =  $_SESSION['userLogged'];
            include_once 'app/views/UserCustom.php';
            break;
        case 'login':
            ob_clean();
            include_once 'app/views/login.php';
            break;
        case 'logout':
            ob_clean();
            session_destroy();
            header("Location: index.php");
            exit;
        case 'register':
            ob_clean();
            include_once 'app/views/newUser.php';
            break;
        case 'cart':
            ob_clean();

            $ids = array_keys($_SESSION['cart']);
            $cartDishes = $controller->getDishesByIds($ids);

            include_once 'app/views/cartview.php';
            break;
        case 'addToCart':
            ob_clean();
            $id_dish = $_GET['id_dish'];

            if (isset($_SESSION['cart'][$id_dish])) {
                $_SESSION['cart'][$id_dish]++;
            } else {
                $_SESSION['cart'][$id_dish] = 1;
            }
            header("Location: " . $_SERVER['HTTP_REFERER']); // Redirige a la misma página desde la que se añade a carrito
            exit;
        case 'addToCartAllDishes':
            ob_clean();
            $id_dish = $_GET['id_dish'];
            if (isset($_SESSION['cart'][$id_dish])) {
                $_SESSION['cart'][$id_dish]++;
            } else {
                $_SESSION['cart'][$id_dish] = 1;
            }
            header("Location: " . $_SERVER['HTTP_REFERER']); // Redirige a la misma pagina desde la que se añade a carrito
            exit;
        case 'removeFromCart':
            ob_clean();
            $id = $_GET['id_dish'] ?? null;

            if ($id !== null && isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]--;

                if ($_SESSION['cart'][$id] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
            }
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;




        case 'adddish':
            ob_clean();
            include_once 'app/views/reigsterdish.php';
            break;

        case 'admin':
            ob_clean();
            if ($_SESSION['userLogged'] == null || $_SESSION['userLogged']->role !== 'ADMIN') {
                include_once 'app/views/login.php';
            } else {
                require_once 'app/views/adminview.php';
            }
            break;

            case 'kitchen':
                    ob_clean();
            if ($_SESSION['userLogged'] == null || $_SESSION['userLogged']->role !== 'COCINERO') {
                include_once 'app/views/login.php';
            } else {
                require_once 'app/views/adminview.php';
            }
            break;

        case 'usu':
            ob_clean();
            $posini = $_SESSION['posini'];
            $users = $db->getUsers(FPAG, $posini);
            include_once 'app/views/adminview.php';
            break;
        case 'order':
            ob_clean();
            $posini = $_SESSION['posini'];
            $orders = $db->getOrders(FPAG, $posini);
            include_once 'app/views/adminview.php';
            break;
        case 'dish':
            ob_clean();
            $posini = $_SESSION['posini'];
            $dishes = $db->getDishes(FPAG, $posini);
            include_once 'app/views/adminview.php';
            break;

        case 'modU':
            ob_clean();
            $user = $users->getUserById($_GET['id']);
            include_once 'app/views/UserCustom.php';
            break;

        case 'deleteU':
            ob_clean();
            $users->DeleteUser($_GET['id']);
            break;

        case 'detailsD':
            ob_clean();
            $dish = $controller->getDishById($_GET['id']);
            $allergens = $controller->getAllergensByDishID($_GET['id']);
            include_once 'app/views/dishview.php';
            break;

        case 'modD':
            ob_clean();
            $dish  = $controller->getDishById($_GET['id']);
            $allergens = $controller->getAllergensByDishID($_GET['id']);
            include_once 'app/views/moddish.php';
            break;

        case 'deleteD':
            ob_clean();
            $dish = $controller->DeleteDish($_GET['id']); //no se por que pone eso pero funciona la funcion idk 
            break;


        case 'detailsO':
            ob_clean();
            $order = $orders->getOrderById($_GET['id']);
            $plates = $orders->getOrderDishes($_GET['id']);
            include_once 'app/views/detailsview.php';
            break;


        case 'mod':
            ob_clean();
            $order = $orders->getOrderById($_GET['id']);
            $plates = $orders->getOrderDishes($_GET['id']);
            include_once 'app/views/modDetails.php';
            break;

        case 'deleteO':
            ob_clean();
            $orders->DeleteOrder($_GET['id']);
            break;
    }

    //ALL DISHES
    if (isset($_GET['all-dishes'])) {

        $types = $controller->getAllDishTypes();
        $allergens = $controller->getAllAllergens();

        if (isset($_GET["searcher"])) {
            $dishes  =  $controller->getDishesByName($_GET["searcher"]);
            ob_clean();
            include_once 'app/views/dishesView.php';
            exit;
        }

        //PARA CUANDO EL USUARIO FILTRA POR TIPO Y/O ALERGENO
        if (isset($_GET['allergen']) && isset($_GET['type'])) {

            $selectedTypes     = $_GET['type']     ?? [];
            $selectedAllergens = $_GET['allergen'] ?? [];

            $dishes = $controller->getDishesByFilters($selectedTypes, $selectedAllergens);
            ob_clean();
            include_once 'app/views/dishesView.php';
            exit;
        }


        //PARA CUANDO SE ACCEDE DESDE MAIN
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
            switch ($type) {
                case 'VEGETARIANO':
                    $dishes = $controller->getDishesByType($type);
                    break;
                case 'CARNE':
                    $dishes = $controller->getDishesByType($type);
                    break;
                case 'PESCADO':
                    $dishes = $controller->getDishesByType($type);
                    break;
                case 'OTROS':
                    $dishes = $controller->getDishesByType($type);
                    break;
                default:
                    $dishes = $controller->getAllDishes();
            }
        } else {
            $dishes = $controller->getAllDishes();
        }
        ob_clean();
        include_once 'app/views/dishesView.php';
    }


    //INIDIVIDUAL DISH
    if (isset($_GET['dish'])) {
        if (isset($_GET['id'])) {
            $dish = $controller->getDishById($_GET['id']);
            $allergens = $controller->getAllergensByDishID($_GET['id']);
            ob_clean();
            include_once 'app/views/dishview.php';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $userController = new UserController();
        $user = $userController->getUserByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['userLogged'] = $user;

            // Redirige al inicio tras login exitoso
            header("Location: index.php");
            exit;
        } else {
            // Si el login falla, se muestra el formulario de nuevo con un error
            $loginError = "Email o contraseña incorrectos";
            ob_clean();
            include_once 'app/views/login.php';
        }
    } else {
        // Si el login falla, se muestra el formulario de nuevo con un error
        $loginError = "Email o contraseña incorrectos";
        ob_clean();
        include_once 'app/views/login.php';
    }


    if (isset($_POST['ord'])) {
        $ord = $_POST['ord'];
    } else {
        $ord = null;
    }

    switch ($ord) {
        case 'modpostD':
            ob_clean();
            $controller->updateDish($_POST['id_dish'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['details'], $_POST['allergens'] ?? [], $_FILES['image'] ?? null);
            header("Location: index.php?order=dish");

            break;

        case 'submitcart':
            ob_clean();
            $user = $_SESSION['userLogged'];
            if ($user) {
                $ids = array_keys($_SESSION['cart']);
                $cartDishes = $controller->getDishesByIds($ids);
                $date = $_POST['date'];
                $total = $_POST['total'];
                $orders->AddOrder($date, $total, $user->address, "PENDIENTE", $user->id_user);
                $_SESSION['cart'] = [];
            }
            header("Location: index.php");
            break;


        case 'modpostU':
            ob_clean();
            $user = $_SESSION['userLogged'];
            $users->UpdateUser($_POST['id'], $_POST['nuevo-nombre'], $_POST['nuevo-apellido'], $_POST['nuevo-email'], $_POST['nueva-direccion'], $_POST['nueva-contrasena'], $_POST['role']);
            if ($user->role == "ADMIN") {
                header("Location: index.php?order=usu");
            } else {
                header("Location: index.php");
            }


            break;

        case 'register':
            ob_clean();
            $registerError = null;


            if ($_POST['contrasena'] !== $_POST['contrasena2']) {
                $registerError = "Las contraseñas no coinciden";
                include_once 'app/views/newUser.php';
                break;
            }


            $nombre = htmlspecialchars($_POST['nombre']);
            $apellido = htmlspecialchars($_POST['apellido']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $direccion = htmlspecialchars($_POST['direccion']);
            $contrasena = $_POST['contrasena'];
            $role = $_POST['role'] ?? 'CLIENTE';


            $result = $users->adduser($nombre, $apellido, $email, $direccion, $contrasena, $role);


            if ($result === true) {

                $user = $users->getUserByEmail($email);
                if ($user) {
                    $_SESSION['userLogged'] = $user;
                    header("Location: index.php");
                    exit;
                }
                $registerError = "Error al iniciar sesión automática";
            } elseif ($result === 'email_duplicado') {
                $registerError = "Este correo electrónico ya está registrado";
            } else {
                $registerError = "Error en el registro. Intente nuevamente.";
            }


            include_once 'app/views/newUser.php';
            break;

        case 'updateOrder':
            $id_order = $_POST['id_order'];
            $direccion = $_POST['direccion'];
            $estado = $_POST['estado'];
            $orders->updateOrder($id_order, $direccion, $estado);
            header("Location: index.php?order=order");

            break;


        case 'addpostD':

            if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged']->role !== 'ADMIN') {
                header("Location: index.php?order=login");
                exit;
            } else {
                $controller->addDish($_POST["name"],$_POST["price"],$_POST["type"],$_POST["details"],$_POST["allergens"] ?? [],$_FILES['image'] ?? null);
                header("Location: index.php?order=admin");
            }


            break;
    }
}
