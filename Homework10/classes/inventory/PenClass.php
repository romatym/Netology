<?php

namespace inventory;

interface PenInterface {
    
    public function write($text);
    public function fullness();
    public function buy_block($num);
    public function sell_block($num);
    
}
class Pen extends Item implements PenInterface {
    
    public $color;
    public $fullnessPercent = 100;
    
    public function __construct($brand, $price, $color) {
        parent::__construct($brand, $price);
        $this->color = $color;
        $this->fullnessPercent = 100;
    }
    public function write($text) {
        $this->fullnessPercent = $this->fullnessPercent - 1;
        echo $text;
    }
    public function fullness() {
        echo($this->fullnessPercent);
    }
    public function buy_block($num) {
        parent::buy($num*10);
    }
    public function sell_block($num) {
        parent::sell($num*10);
    }
}