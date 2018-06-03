<?php

namespace inventory;

interface Duck_interface {
    
    public function swim($speed);
    
}
class Zoo extends Item {
    
    public $Section;
    
}
class Duck extends Zoo implements Duck_interface {
    
    public $color;
    public $swim_speed;
    
    public function __construct($brand, $price, $color) {
        parent::__construct($brand, $price);
        $this->color = $color;
        $this->swim_speed = 0;
    }
    public function swim($speed) {
        $this->swim_speed = $speed;
    }
    
}