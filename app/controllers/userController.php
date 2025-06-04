<?php

include_once 'app/models/Order.php';
include_once 'app/models/DatabaseConnection.php';
include_once 'app/helpers/utilities.php';

class UserController{


public function adduser($first_name, $last_name, $email, $address, $password, $role) {
    $user = new User();
    $user->__set('first_name', $first_name);
    $user->__set('last_name', $last_name);
    $user->__set('email', $email);
    $user->__set('address', $address);
    $user->__set('password', password_hash($password, PASSWORD_DEFAULT));
    $user->__set('role', $role);

    $db = DatabaseConnection::getModel();
    return $db->registerUser($user); 
}
    public function DeleteUser($id){
        $db = DatabaseConnection::getModel();
        $db->deleteUser($id);
    }

    public function getUserByEmail($email){
        $db = DatabaseConnection::getModel();
        return $db->getUserByEmail($email);
    }

    public function getUserById($id){
        $db = DatabaseConnection::getModel();
        return $db->getUser($id);
    }

    public function UpdateUser($id, $first_name,$last_name,$email,$address,$password, $role){
    $db = DatabaseConnection::getModel();
    $user = new User();
    $user->__set('id_user',$id);  
    $user->__set('first_name', $first_name);
    $user->__set('last_name',$last_name);
    $user->__set('email', $email);
    $user->__set('address',$address);
    $user->__set('password',password_hash($password, PASSWORD_DEFAULT));
    $user->__set('role', $role);

    return $db->UpdateUser($user);
    }

        public function UpdateUserWithoutPassword($id, $first_name,$last_name,$email,$address, $role){
    $db = DatabaseConnection::getModel();
    $user = new User();
    $user->__set('id_user',$id);  
    $user->__set('first_name', $first_name);
    $user->__set('last_name',$last_name);
    $user->__set('email', $email);
    $user->__set('address',$address);
    $user->__set('role', $role);

    return $db->updateUserWithoutPassword($user);
    }

}