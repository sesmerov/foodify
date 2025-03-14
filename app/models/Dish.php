<?php
class Dish {

    private $id_dish;
    private $name;
    private $price;
    private $type;

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