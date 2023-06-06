<?php
class Fries extends AbstractProduct
{
    private $souce;

    public function __construct($size, $souce)
    {
        parent::__construct($size);
        $this->souce = $souce;
    }

    public function countPrice() 
    {
        $sizes = json_decode(file_get_contents("database/fries/size.json"));
        $friesPrice = 0;
        foreach ($sizes as $friesSize) {
            if ($friesSize->size === $this->size) {
                $friesPrice = $friesSize->price;
                break;
            }
        }

        $soucePrice = 0;
        if (!empty($this->souce)) {
           $souces = json_decode(file_get_contents("database/fries/souce.json"));
           foreach ($souces as $souce) {
                if ($souce->name === $this->souce) {
                    $soucePrice = $souce->price;
                    break;
                }
           }
        }

        return $friesPrice + $soucePrice;
        
    }

    public function toArray()
    {
        return [
            "size" => $this->size,
            "souce" => $this->souce
        ];
    }

}


?>