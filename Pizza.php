<?php
class Pizza extends AbstractProduct
{
    private $name;
    private $dough;
    private $cheeseCrust;

    public function __construct($size, $name, $dough, $cheeseCrust)
    {
        parent::__construct($size);
        $this->name = $name;
        $this->dough = $dough;
        $this->cheeseCrust = $cheeseCrust;
    }

    public function countPrice() 
    {
        $pizzas = json_decode(file_get_contents("database/pizza/size.json"));
        $pizzaPrice = 0;
        foreach ($pizzas as $pizza) {
            if ($pizza->name === $this->name && $pizza->dough === $this->dough && $pizza->size === $this->size) {
                $pizzaPrice = $pizza->price;
                break;
            }
        }

        return $this->cheeseCrust ? $pizzaPrice + 100 : $pizzaPrice;
        
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "dough" => $this->dough,
            "cheeseCrust" => $this->cheeseCrust,
            "size" => $this->size,
        ];
    }

}


?>