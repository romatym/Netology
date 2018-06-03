<?php

interface Car_interface {
    
    public function fill_up($litres);
    
}

class Car extends Item implements Car_interface {
    
    public $color;
    public static $numberOfSeats = 4;
    public $gasoline;
    
    public function __construct($brand, $price, $color) {
        parent::__construct($brand, $price);
        $this->color = $color;
        $this->gasoline = 0;
    }
    public function fill_up($litres) {
        $this->gasoline = $this->gasoline + $litres;
    }
    
}