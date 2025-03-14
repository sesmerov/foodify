<?php
class Order {

    private $id_order;
    private $order_date;
    private $total_price;
    private $delivery_address;
    private $status;
    private $id_user;

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