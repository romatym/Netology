<?php

function AutoloadItem($className) {
    $filePath = './classes/core/item/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function AutoloadInventory($className) {
    $filePath = './classes/Inventory/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
    
}
function AutoloadCart($className) {
    $filePath = './classes/core/cart/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function AutoloadOrder($className) {
    $filePath = './classes/core/order/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function Autoload($className) {
    $filePath = './classes/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }    
}

spl_autoload_register('AutoloadItem');
spl_autoload_register('AutoloadInventory');
spl_autoload_register('AutoloadCart');
spl_autoload_register('AutoloadOrder');
spl_autoload_register('Autoload');

echo '<pre>';

$new_car1 = new car('BMW', 100, 'red');
$new_car1->fill_up(60);
$new_car1->sell(1);
print_r($new_car1);

$new_car2 = new car('Volvo', 200, 'grey');
$new_car2->fill_up(40);
$new_car2->sell(1);
print_r($new_car2);