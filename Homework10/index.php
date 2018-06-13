<?php

function AutoloadItem($className) {
//    $file = str_replace('\\', '/', $className);
//    $f = $path = $_SERVER['DOCUMENT_ROOT'];
    $filePath = 'classes\\'.$className .'\\'. 'itemClass.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function AutoloadInventory($className) {
    $filePath = $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
    
}
function AutoloadCart($className) {
    $filePath = 'classes\\'.$className .'\\'. 'cartClass.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function AutoloadOrder($className) {
    $filePath = 'classes\\'.$className .'\\' . 'orderClass.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }  
}
function Autoload($className) {
    $filePath = '.\classes\\' . $className . 'class.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }    
}

spl_autoload_register('AutoloadItem');
spl_autoload_register('AutoloadInventory');
spl_autoload_register('AutoloadCart');
spl_autoload_register('AutoloadOrder');
spl_autoload_register('Autoload');
//spl_autoload_register('AutoloadItem, AutoloadInventory, AutoloadCart, AutoloadOrder, Autoload');

class MyCart extends core\Cart {
    //инициализация абстрактного класса core\Cart
}

class MyItem extends core\Item {
    //инициализация абстрактного класса core\Item
}

echo '<pre>';

$new_cart = new myCart();
$new_item = new MyItem('Sony', 100);
$SellPrice = $new_item->get_price();
$new_cart->add($new_item, $SellPrice, 1);
$new_cart->add($new_item, $SellPrice, 1);
$new_cart->remove($new_item);

print_r($new_cart);

$newPrint = new core\Order();
$newPrint->printOrder($new_cart);

