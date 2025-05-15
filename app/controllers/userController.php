<?php

include_once 'app/models/Order.php';
include_once 'app/models/DatabaseConnection.php';


class UserController{

    public function DeleteUser($id){
        $db = DatabaseConnection::getModel();
        $db->DeleteUser($id);
    }

    public function getUserByEmail($email){
        $db = DatabaseConnection::getModel();
        return $db->getUserByEmail($email);
    }

}