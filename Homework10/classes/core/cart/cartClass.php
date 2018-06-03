<?php

namespace core;

interface cart_operations {
    
    function add($item, $price, $quantity);
    function remove($item);
}

interface cart_interface {
    
    public function get_cart_total($cart);
    
}

abstract class cart implements cart_operations, cart_interface {
    
    protected $cart_total;
    protected $items;

    public function __construct() {
        $this->items = [];
        $this->cart_total = 0;
    }
    public function add($item, $price, $quantity) {
        $this->items[] = [$item, $price, $quantity];
    }
    public function remove($item) {
        foreach ($this->items as $row -> $value) {
            if ($value[0] === $item) {
                unset($this->items[$row]);
                break;
            }
        }
    }
    
    public function get_cart_total($cart) {
        $cart_total = 0;
        foreach ($cart->items as $value) {
            $cart_total = $cart_total + $value[1]*$value[2];
        }
        return $cart_total;
    }
    
} 
