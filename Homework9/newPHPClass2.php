<?php

interface item_movement {
    
    function buy($num);
    function sell($num);
}

interface item_interface {
    
    public function get_quantity();
    
}

abstract class Item implements item_movement, item_interface {
    
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
        echo('quantity: '.$this->quantity);
    }
} 

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
interface TV_interface {
    
    public function switch_state($new_state);
    
}
class TV extends Item implements TV_interface {
    
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

interface Pen_interface {
    
    public function write($text);
    public function fullness();
    public function buy_block($num);
    public function sell_block($num);
    
}
class Pen extends Item implements Pen_interface {
    
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

echo '<pre>';

$new_car1 = new car('BMW', 100, 'red');
$new_car1->fill_up(60);
$new_car1->sell(1);
print_r($new_car1);

$new_car2 = new car('Volvo', 200, 'grey');
$new_car2->fill_up(40);
$new_car2->sell(1);
print_r($new_car2);

$new_TV1 = new TV('Sony', 300, 'white');
$new_TV1->switch_state(TRUE);
$new_TV1->sell(1);
print_r($new_TV1);

$new_TV2 = new TV('HTC', 400, 'grey');
$new_TV2->switch_state(TRUE);
print_r($new_TV2);

$Pen1 = new Pen('Bic', 500, 'black');
$Pen1->write('text text text');
echo($Pen1->fullness());
$Pen1->buy_block(2);
$Pen1->get_quantity();
echo('<br>');
print_r($Pen1);
echo('<br>');

$Pen2 = new Pen('Bic', 600, 'pink');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->buy(1);
echo($Pen2->fullness());
echo('<br>');
print_r($Pen2);
echo('<br>');

$duck = new Duck('', 700, 'black');
$duck->swim_speed = 20;
$duck->Section = 'birds';
print_r($duck);

$duck2 = new Duck('Bic', 500, 'brown');
$duck2->swim_speed = 30;
$duck->Section = 'birds';
print_r($duck2);