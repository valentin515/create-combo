<?php
class Drink extends AbstractProduct
{
    private $name;

    public function __construct($size, $name)
    {
        parent::__construct($size);
        $this->size = $size;
        $this->name = $name;
    }

    public function countPrice() 
    {
        $drinks = json_decode(file_get_contents("database/drink/size.json"));
        foreach ($drinks as $drink) {
            if ($drink->name === $this->name && $drink->size === $this->size) {
                return $drink->price;
            }
        }

    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "size" => $this->size,
        ];

    }

}


?>