<?php
session_start();
include_once 'app/controllers/DishController.php';
include_once 'app/helpers/utilities.php';
include_once 'app/models/DatabaseConnection.php';
include_once 'app/models/Dish.php';
include_once 'app/models/User.php';
include_once 'app/models/Order.php';
include_once 'app/models/Allergen.php';

ob_start();
$controller = new DishController();
$dishes = $controller->showRandomDishes();
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
        case 'admin':
            ob_clean();
            require_once 'app\views\adminview.php';
            break;
        case 'usu':
            ob_clean();
            $posini = $_SESSION['posini'];
            $users = $db->getUsers(FPAG, $posini);
            include_once 'app\views\adminview.php';
            break;
        case 'order':
            ob_clean();
            $posini = $_SESSION['posini'];
            $orders = $db->getOrders(FPAG, $posini);
            include_once 'app\views\adminview.php';
            break;
        case 'dish':
            ob_clean();
            $posini = $_SESSION['posini'];
            $dishes = $db->getDishes(FPAG, $posini);
            include_once 'app\views\adminview.php';
            break;
        case 'deleteU':
            ob_clean();

            break;
    }

    //ALL DISHES
    if (isset($_GET['all-dishes'])) {

        $types = $controller->getAllDishTypes();
        $allergens = $controller->getAllAllergens();


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
}
