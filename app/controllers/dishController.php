<?php

include_once 'app/models/Dish.php';
include_once 'app/models/DatabaseConnection.php';

class DishController {

    public function showRandomDishes() {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getRandomDishes(6); // Obtener 6 platos aleatorios
        return $dishes;
    }

    public function showAllDishes() {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getAllDishes();
        return $dishes;
    }

    public function DeleteDish($id){
        $db = DatabaseConnection::getModel();
        $db->DeleteDish($id);
    }

    public function getAllDishes(){
        $db = DatabaseConnection::getModel();
        $dishes = $db->getAllDishes();
        return $dishes;
    }

    public function getDishesByType($type) {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByType($type);
        return $dishes;
    }

    public function getAllDishTypes() {
        $db = DatabaseConnection::getModel();
        $types = $db->getAllDishTypes();
        return $types;
    }

    public function getAllAllergens() {
        $db = DatabaseConnection::getModel();
        $allergens = $db->getAllAllergens();
        return $allergens;
    }

    public function getAllergensByDishID($id) {
        $db = DatabaseConnection::getModel();
        $allergens = $db->getAllergensByDish($id);
        return $allergens;
    }

    public function getDishesByFilters(array $types, array $allergens): array
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByFilters($types, $allergens);
        return $dishes;

    }

    public function getDishById($id) {
        $db = DatabaseConnection::getModel();
        $dish = $db->getDishById($id);
        return $dish;
    }
}