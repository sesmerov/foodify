<?php

include_once 'app/models/Order.php';
include_once 'app/models/DatabaseConnection.php';

class OrderController
{
    public function DeleteOrder($id)
    {
        $db = DatabaseConnection::getModel();
        if (!$db->getOrder($id)) {
            throw new Exception("La orden no existe");
        }

        return $db->deleteOrder($id);
    }

    public function AddOrder($order_date, $total_price, $delivery_address, $status, $id_user)
    {
        $order = new Order();
        $order->__set('order_date', $order_date);
        $order->__set('total_price', $total_price);
        $order->__set('delivery_address', $delivery_address);
        $order->__set('status', $status);
        $order->__set('id_user', $id_user);
        $db = DatabaseConnection::getModel();
        $orderid = $db->addOrder($order);


        foreach ($_SESSION['cart'] as $id_dish => $quantity) {
            $dish = $db->getDish($id_dish);
            if ($dish) {
                $db->addOrderDetail($orderid, $id_dish, $dish->price, $quantity);
            }
        }
    }

    public function GetorderByID($id)
    {
        $db = DatabaseConnection::getModel();
        $order = $db->getOrder($id);
        return $order;
    }

    public function Getorderdishes($id)
    {
        $db = DatabaseConnection::getModel();
        $orderdishes = $db->getOrderDishes($id);
        return $orderdishes;
    }

    public function GetQuantity($id, $id_order)
    {
        $db = DatabaseConnection::getModel();
        $quantity = $db->GetDishQuantity($id, $id_order);
        return $quantity;
    }

    public function updateOrder($id_order, $direccion, $estado)
    {
        $db = DatabaseConnection::getModel();
        $order = $db->getOrder($id_order);
        $order->delivery_address = $direccion;
        $order->status = $estado;
        $db->updateOrder($order);
    }
}
