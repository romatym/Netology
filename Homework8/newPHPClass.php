<?php
/**
 * Description of newPHPClass
 * @author Roma: Машина, Телевизор, Шариковая ручка, Утка, Товар. 
 */
class Car {
    
    public $color = 'white';
    public static $numberOfSeats = 4;
    public $brand;
    public $gasoline = 0;
    
    public function fill_up($litres) {
        $this->gasoline = $this->gasoline + $litres;
    }
    
}

class TV {
    
    public $color = 'black';
    public $brand;
    public $state = false;
    
    public function switch_state($new_state) {
        $this->state = $new_state;
    }
    
}

class Pen {
    
    public $color = 'blue';
    public $brand;
    public $fullnessPercent = 100;
    
    public function write($text) {
        $this->fullnessPercent = $this->fullnessPercent - 1;
        echo $text;
    }
    
    public function fullness() {
        echo($this->fullnessPercent);
    }
    
}

class Duck {
    
    public $color = 'grey';
    public $swim_speed = 0;
    
    public function swim($speed) {
        $this->swim_speed = $speed;
    }
    
}

class Item {
    
    public $quantity = 0;
    public $price = 0;
    
    public function buy($num) {
        $this->quantity = $this->quantity + $num;
    }
    public function sell($num) {
        $this->quantity = $this->quantity - $num;
    }
}

echo '<pre>';

$new_car1 = new car();
$new_car1->brand = 'BMW';
$new_car1->color = 'red';
$new_car1->fill_up(60);

$new_car2 = new car();
$new_car2->brand = 'Volvo';
$new_car2->color = 'grey';
$new_car2->fill_up(40);

$new_TV1 = new TV();
$new_TV1->brand = 'Sony';
$new_TV1->color = 'white';
$new_TV1->switch_state(TRUE);

$new_TV2 = new TV();
$new_TV2->brand = 'HTC';
$new_TV2->color = 'grey';
$new_TV2->switch_state(TRUE);

$Pen1 = new Pen();
$Pen1->brand = 'Bic';
$Pen1->color = 'black';
$Pen1->write('text text text');
echo($Pen1->fullness());

$Pen2 = new Pen();
$Pen2->brand = 'Bic';
$Pen2->color = 'black';
$Pen2->write('text text text');
$Pen2->write('text text text');
$Pen2->write('text text text');
echo($Pen2->fullness());

$duck = new Duck();
$duck->swim_speed = 20;

$duck2 = new Duck();
$duck2->color = 'black';
$duck2->swim_speed = 30;

$Item1 = new Item();
$Item1->buy(1);

$Item2 = new Item();
$Item2->sell(1);