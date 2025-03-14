<?php
class Allergen {

    private $id_allergen;
    private $name;

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