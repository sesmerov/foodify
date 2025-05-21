<?php

include_once 'app/models/Dish.php';
include_once 'app/models/DatabaseConnection.php';

class DishController
{

    public function showRandomDishes()
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getRandomDishes(6); // Obtener 6 platos aleatorios
        return $dishes;
    }

    public function showAllDishes()
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getAllDishes();
        return $dishes;
    }

    public function DeleteDish($id)
    {
        $db = DatabaseConnection::getModel();
        $db->DeleteDish($id);
    }

    public function getAllDishes()
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getAllDishes();
        return $dishes;
    }

    public function getDishesByType($type)
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByType($type);
        return $dishes;
    }

    public function getAllDishTypes()
    {
        $db = DatabaseConnection::getModel();
        $types = $db->getAllDishTypes();
        return $types;
    }

    public function getAllAllergens()
    {
        $db = DatabaseConnection::getModel();
        $allergens = $db->getAllAllergens();
        return $allergens;
    }

    public function getAllergensByDishID($id)
    {
        $db = DatabaseConnection::getModel();
        $allergens = $db->getAllergensByDish($id);
        return $allergens;
    }


    public function getAllergensCodeByDishID($id) {
    $db = DatabaseConnection::getModel();
    return $db->getAllergensCode($id); 
}


    public function getDishesByFilters(array $types, array $allergens): array
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByFilters($types, $allergens);
        return $dishes;
    }

    public function getDishById($id)
    {
        $db = DatabaseConnection::getModel();
        $dish = $db->getDishById($id);
        return $dish;
    }

    public function getDishesByIds(array $ids): array
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByIds($ids);
        return $dishes;
    }

    public function getDishesByName($name)
    {
        $db = DatabaseConnection::getModel();
        $dishes = $db->getDishesByName($name);
        return $dishes;
    }

public function updateDish($id, $name, $price, $type, $details, $allergens, $imageFile = null) {
    $db = DatabaseConnection::getModel();
    $dish = new Dish();


    $dish->__set('id_dish', $id);
    $dish->__set('name', $name);
    $dish->__set('price', $price);
    $dish->__set('type', $type);
    $dish->__set('details', $details);
    $db->updateDish($dish);
     if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'app/uploads/dishes/';
        $targetFile = $uploadDir . $id . '.webp';
        

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $detectedType = mime_content_type($imageFile['tmp_name']);
        
        if (in_array($detectedType, $allowedTypes)) {
            if ($detectedType === 'image/webp') {
                move_uploaded_file($imageFile['tmp_name'], $targetFile);
            } else {
                $image = imagecreatefromstring(file_get_contents($imageFile['tmp_name']));
                imagewebp($image, $targetFile, 80);
                imagedestroy($image);
            }
        }
    }

    $db->deleteAllAllergensFromDish($id); 


    foreach ($allergens as $allergenId) {
        $db->addAllergentoaDish($allergenId, $id);
    }
}

public function addDish($name, $price, $type, $details, $allergens, $imageFile = null) {
    $db = DatabaseConnection::getModel();
    $dish = new Dish();

    $dish->__set('name', $name);
    $dish->__set('price', $price);
    $dish->__set('type', $type);
    $dish->__set('details', $details);
    $id = $db->addDish($dish);

    if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'app/uploads/dishes/';
        $targetFile = $uploadDir.$id.'.webp';

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $detectedType = mime_content_type($imageFile['tmp_name']);

        if (in_array($detectedType, $allowedTypes)) {
            if ($detectedType === 'image/webp') {
                move_uploaded_file($imageFile['tmp_name'], $targetFile);
            } else {
                $image = imagecreatefromstring(file_get_contents($imageFile['tmp_name']));
                imagewebp($image, $targetFile, 80);
                imagedestroy($image);
            }
        }
    }

    foreach ($allergens as $allergenId) {
        $db->addAllergentoaDish($allergenId, $id);
    }
}

}
