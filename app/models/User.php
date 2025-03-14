<?php
class User {

    private $id_user;
    private $first_name;
    private $password;
    private $last_name;
    private $email;
    private $address;
    private $role;

    function __set($name, $value) {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }
}
?>