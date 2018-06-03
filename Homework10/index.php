<?php

function AutoloadItem($className) {
    $filePath = './classes/item/' . $className . 'class.php';
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
    $filePath = './classes/cart/' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function AutoloadOrder($className) {
    $filePath = './classes/order/' . $className . 'class.php';
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

$new_TV1 = new TV('Sony', 300, 'white');
$new_TV1->switch_state(TRUE);
$new_TV1->sell(1);
print_r($new_TV1);

$new_TV2 = new TV('HTC', 400, 'grey');
$new_TV2->switch_state(TRUE);
print_r($new_TV2);

$Pen1 = new Pen('Bic', 500, 'black');
$Pen1->write('text text text');
echo($Pen1->fullness());
$Pen1->buy_block(2);
$Pen1->get_quantity();
echo('<br>');
print_r($Pen1);
echo('<br>');

$Pen2 = new Pen('Bic', 600, 'pink');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->buy(1);
echo($Pen2->fullness());
echo('<br>');
print_r($Pen2);
echo('<br>');

$duck = new Duck('', 700, 'black');
$duck->swim_speed = 20;
$duck->Section = 'birds';
print_r($duck);

$duck2 = new Duck('', 800, 'brown');
$duck2->swim_speed = 30;
$duck->Section = 'birds';
print_r($duck2);