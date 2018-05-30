<?php

interface item_movement {
    
    function buy($num);
    function sell($num);
}

abstract class Item implements item_movement {
    
    public $brand;
    
    protected $quantity = 0;
    protected $price = 0;
    
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

class Car extends Item {
    
    public $color = 'white';
    public static $numberOfSeats = 4;
//    public $brand;
    public $gasoline = 0;
    
    public function fill_up($litres) {
        $this->gasoline = $this->gasoline + $litres;
    }
    
}

class TV extends Item {
    
    public $color = 'black';
//    public $brand;
    public $state = false;
    
    public function switch_state($new_state) {
        $this->state = $new_state;
    }
    
}

class Pen extends Item {
    
    public $color = 'blue';
//    public $brand;
    public $fullnessPercent = 100;
    
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

class Zoo extends Item {
    
    public $Section;
    
}

class Duck extends Zoo {
    
    public $color = 'grey';
    public $swim_speed = 0;
    
    public function swim($speed) {
        $this->swim_speed = $speed;
    }
    
}

echo '<pre>';

$new_car1 = new car();
$new_car1->brand = 'BMW';
$new_car1->color = 'red';
$new_car1->fill_up(60);
$new_car1->sell(1);

$new_car2 = new car();
$new_car2->brand = 'Volvo';
$new_car2->color = 'grey';
$new_car2->fill_up(40);
$new_car2->sell(1);

$new_TV1 = new TV();
$new_TV1->brand = 'Sony';
$new_TV1->color = 'white';
$new_TV1->switch_state(TRUE);
$new_TV1->sell(1);

$new_TV2 = new TV();
$new_TV2->brand = 'HTC';
$new_TV2->color = 'grey';
$new_TV2->switch_state(TRUE);

$Pen1 = new Pen();
$Pen1->brand = 'Bic';
$Pen1->color = 'black';
$Pen1->write('text text text');
echo($Pen1->fullness());
$Pen1->buy_block(2);
$Pen1->get_quantity();

$Pen2 = new Pen();
$Pen2->brand = 'Bic';
$Pen2->color = 'black';
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->buy(1);
echo($Pen2->fullness());

$duck = new Duck();
$duck->swim_speed = 20;
$duck->Section = 'birds';

$duck2 = new Duck();
$duck2->color = 'black';
$duck2->swim_speed = 30;
$duck->Section = 'birds';
