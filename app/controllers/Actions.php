<?php
include_once 'app\models\Dish.php';
include_once 'app\models\User.php';
include_once 'app\models\Order.php';
function DeleteCrud($id,$type){
    $db  = DatabaseConnection::getModel();
    switch ($type){
        case 'dish':
            $db->DeleteDish($id);
            break;
        case 'user':
            $db->DeleteUser($id);
            break;
        case 'order':
            $db->DeleteOrder($id);
            break;
    }

}