<?php

include_once 'app/models/Dish.php';
include_once 'app/models/DatabaseConnection.php';

class DishController {

    public function showRandomDishes() {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getRandomDishes(6); // Obtener 6 platos aleatorios
        require_once 'app/views/main.php'; // Renderiza la vista y pasa $dishes
    }

    public function DeleteDish($id){
        $db = DatabaseConnection::getModel();
        $db->DeleteDish($id);
    }

}