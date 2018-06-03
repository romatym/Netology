<?php

namespace core;

interface order_interface {
    
    public function printOrder($cart);
    
}

class order extends cart implements order_interface {
    
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
