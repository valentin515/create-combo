<?php
class IceCream extends AbstractProduct
{
    private $flavor;
    private $topping;
    
    public function __construct($size, $flavor, $topping)
    {
        parent::__construct($size);
        $this->flavor = $flavor;
        $this->topping = $topping;
    }

    public function countPrice() 
    {
        $iceCreams = json_decode(file_get_contents("database/ice cream/size.json"));
        $iceCreamPrice = 0;
        foreach ($iceCreams as $iceCream) {
            if ($iceCream->flavor === $this->flavor && $iceCream->size === $this->size) {
                $iceCreamPrice = $iceCream->price;
                break;
            }
        }

        $toppingPrice = 0;
        if (!empty($this->topping)) {
            $toppings = json_decode(file_get_contents("database/ice cream/topping.json"));
            foreach ($toppings as $topping) {
                if ($topping->flavor === $this->topping) {
                    $toppingPrice = $topping->price;
                    break;
                }
            }
        }

        return $iceCreamPrice + $toppingPrice;
    }

    public function toArray()
    {
        return [
            "flavor" => $this->flavor,
            "topping" => $this->topping,
            "size" => $this->size,
        ];
    }

}


?>