<?php
// app/Decorators/MilkDecorator.php

namespace App\Decorators;

class MilkDecorator extends CoffeeDecorator
{
    protected $cost = 20.0;
    protected $description = "Milk";

    public function getCost(): float
    {
        return parent::getCost() + $this->cost;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . " + " . $this->description;
    }
}
