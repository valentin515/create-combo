<?php
abstract class AbstractProduct 
{
    protected $size;

    public function __construct($size)
    {
        $this->size = $size;
    }

    abstract public function countPrice();
    abstract public function toArray();
}

?>