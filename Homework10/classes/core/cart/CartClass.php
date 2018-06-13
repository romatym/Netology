<?php

namespace core;

interface CartOperations {
    
    function add($item, $price, $quantity);
    function remove($item);
}

interface CartInterface {
    
    public function get_cart_total($cart);
    
}

abstract class Cart implements CartOperations, CartInterface {
    
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
        foreach ($this->items as $row) {
            if ($row[0] === $item) {
                $key = key($this->items);
                unset($this->items[$key]);
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
