<?php
/**
 * Description of newPHPClass
 * @author Roma: Машина, Телевизор, Шариковая ручка, Утка, Товар. 
 */
class Car {
    
    public $color;
    public static $numberOfSeats = 4;
    public $brand;
    public $gasoline;
    
    public function __construct($color, $brand) {
        $this->color = $color;
        $this->gasoline = 0;
        $this->brand = $brand;
    }
    public function fill_up($litres) {
        $this->gasoline = $this->gasoline + $litres;
    }
    
}

class TV {
    
    public $color;
    public $brand;
    public $state;
    
    public function __construct($color, $brand) {
        $this->color = $color;
        $this->state = false;
        $this->brand = $brand;
    }
    public function switch_state($new_state) {
        $this->state = $new_state;
    }
    
}

class Pen {
    
    public $color = 'blue';
    public $brand;
    public $fullnessPercent;
    
    public function __construct($color, $brand) {
        $this->color = $color;
        $this->fullnessPercent = 100;
        $this->brand = $brand;
    }
    public function write($text) {
        $this->fullnessPercent = $this->fullnessPercent - 1;
        echo $text;
    }
    public function fullness() {
        echo($this->fullnessPercent);
    }
    
}

class Duck {
    
    public $color;
    public $swim_speed;
    
    public function __construct($color) {
        $this->color = $color;
        $this->swim_speed = 0;
    }
    public function swim($speed) {
        $this->swim_speed = $speed;
    }
    
}

class Item {
    
    public $quantity = 0;
    public $price = 0;
    
    public function __construct($price) {
        $this->price = $price;
    }
    public function buy($num) {
        $this->quantity = $this->quantity + $num;
    }
    public function sell($num) {
        $this->quantity = $this->quantity - $num;
    }
    
}

echo '<pre>';

$new_car1 = new car('red', 'BMW');
$new_car1->fill_up(60);

$new_car2 = new car('grey', 'Volvo');
$new_car2->fill_up(40);

$new_TV1 = new TV('Sony', 'white');
$new_TV1->switch_state(TRUE);

$new_TV2 = new TV('HTC', 'grey');
$new_TV2->switch_state(TRUE);

$Pen1 = new Pen('Bic', 'black');
$Pen1->write('text text text');
echo($Pen1->fullness());

$Pen2 = new Pen('Bic', 'black');
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->write('text text text');
echo($Pen2->fullness());

$duck = new Duck('grey');
$duck->swim_speed = 20;

$duck2 = new Duck('black');
$duck2->swim_speed = 30;

$Item1 = new Item(100);
$Item1->buy(1);

$Item2 = new Item(200);
$Item2->sell(1);