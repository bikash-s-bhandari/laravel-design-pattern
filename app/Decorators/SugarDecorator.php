<?php

namespace App\Decorators;

class SugarDecorator extends CoffeeDecorator
{
    protected $cost = 10.0;
    protected $description = "Sugar";

    public function getCost(): float
    {
        return parent::getCost() + $this->cost;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . " + " . $this->description;
    }
}
