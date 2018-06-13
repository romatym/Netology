<?php

namespace core;

interface ItemMovement {
    
    function buy($num);
    function sell($num);
}

interface ItemInterface {
    
    public function get_quantity();
    public function get_price();
}

abstract class Item implements ItemMovement, ItemInterface {
    
    public $brand;
    
    protected $quantity;
    protected $price;
    
    public function __construct($brand, $price) {
        $this->brand = $brand;
        $this->price = $price;
        $this->quantity = 0;
    }
    public function buy($num) {
        $this->quantity = $this->quantity + $num;
    }
    public function sell($num) {
        $this->quantity = $this->quantity - $num;
    }
    
    public function get_quantity() {
        return $this->quantity;
    }
    public function get_price() {
        return $this->price*2;
    }
} 