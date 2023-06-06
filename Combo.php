<?php
class Combo 
{
    private $drink;
    private $pizza;
    private $fries;
    private $iceCream;

    public function __construct($drink, $pizza, $fries, $iceCream)
    {
        $this->drink = $drink;
        $this->pizza = $pizza;
        $this->fries = $fries;
        $this->iceCream = $iceCream;
    }

    private function total()
    {
        return $this->drink->countPrice() + $this->pizza->countPrice() + $this->fries->countPrice() + $this->iceCream->countPrice();
    }

    public function save()
    {
        $combo = [];
        $combo["drink"] = $this->drink->toArray();
        $combo["pizza"] = $this->pizza->toArray();
        $combo["fries"] = $this->fries->toArray();
        $combo["iceCream"] = $this->iceCream->toArray();
        $combo["total"] = $this->total();

        $combos = json_decode(file_get_contents("database/combos/combos.json"));
        $combos[] = $combo;

        file_put_contents("database/combos/combos.json", json_encode($combos));
    }



}


?>