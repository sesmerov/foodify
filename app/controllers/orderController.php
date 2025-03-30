<?php

include_once 'app\models\Order.php';
include_once 'app\models\DatabaseConnection.php';

class OrderController{

    public function DeleteOrder($id){
        $db = DatabaseConnection::getModel();
        $db->DeleteOrder($id);
    }
}