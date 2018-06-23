<?php 
class Car
{
    public $car_brand;
    private $car_type;
    private $car_plat_number;
    
    public function __construct($car_brand = "proton",$car_type = "saga",$car_plat_number = '2020'){
         $this -> car_brand = $car_brand;
         $this -> car_type = $car_type;
         $this -> car_plat_number = $car_plat_number;
    }
    
    public function getAll(){
        return $this -> car_brand . " " . $this -> car_type . " " . $this -> car_plat_number;
    }
    
    public static $car_initial = "PFW";
    public static function show(){
        echo "Hello world";
    }
}

$car_1 = new Car();
echo $car_1 -> getAll();
echo Car::$car_initial;
car::show();
?>