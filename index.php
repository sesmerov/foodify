<?php

include_once 'app/controllers/DishController.php';
include_once 'app/helpers/utilities.php';

$controller = new DishController();
$controller->showRandomDishes();