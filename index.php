<?php
include_once 'app\models\DatabaseConnection.php';
include_once 'app\models\Dish.php';
include_once 'app\models\User.php';
include_once 'app\models\Order.php';
include_once 'app\models\Allergen.php';
include_once 'app\controllers\Actions.php';
session_start();
define('FPAG', 5);

$db = DatabaseConnection::getModel();
$usufiles = $db->getNumUsers();

if ($usufiles % FPAG == 0){
    $posfin = $usufiles -FPAG;
}
 else{
    $posend = $usufiles - ($usufiles % FPAG);

 }

 if(!isset($_SESSION['posini'])){
    $_SESSION['posini']=0;

 }
 $posAux = $_SESSION['posini'];

 ob_start();
 if ($_SERVER['REQUEST_METHOD']=="GET") {

  require_once 'app\views\Adminview.php';
        
 if (isset($_GET["order"])) {
    $order = $_GET["order"];
 }
 else{
    $order = null;
 }

        if ( isset($_GET['nav'])) {
            switch ( $_GET['nav']) {
                case "Begin"  : $posAux = 0; break;
                case "Next": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
                case "Before" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
                case "Last"   : $posAux = $posfin;
            }
            $_SESSION['posini'] = $posAux;
        }
    switch ($order) {
        case 'usu':
            ob_clean();
            $posini = $_SESSION['posini'];
            $users = $db->getUsers(FPAG,$posini);
            require_once 'app\views\CrudUsu.php';
            break;
        
        case 'order':
            ob_clean();
            $posini = $_SESSION['posini'];
            $orders = $db->getOrders(FPAG,$posini);
            require_once 'app\views\CrudOrder.php';
            break;
        
        case 'dish':
            ob_clean();
             $posini = $_SESSION['posini'];
             $dishes = $db->getDishes(FPAG,$posini);
            require_once 'app\views\CrudDish.php';
            break;

        case 'delete':
            ob_clean();
            DeleteCrud($_GET["id"],$_GET["type"]);
            break;
           
            
    }
    
     
    }




