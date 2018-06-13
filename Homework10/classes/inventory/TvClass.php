<?php

namespace inventory;

interface TVInterface {
    
    public function switch_state($new_state);
    
}
class TV extends Item implements TVInterface {
    
    public $color;
    public $state;
    
    public function __construct($brand, $price, $color) {
        parent::__construct($brand, $price);
        $this->color = $color;
        $this->state = false;
    }
    public function switch_state($new_state) {
        $this->state = $new_state;
    }
}
