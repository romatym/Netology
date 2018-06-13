<?php

namespace core;

interface OrderInterface {
    
    public function printOrder($cart);
    
}

class Order extends Cart implements OrderInterface {
    
    public function __construct() {
            parent::__construct();
    }
    
    public function printOrder($cart) {
        echo '<pre>';
        echo 'Order total: ';
        echo($cart->get_cart_total($cart));
        echo '<br>';
        //print_r($cart);
    }
} 
