<?php
// app/Decorators/SimpleCoffee.php

namespace App\Decorators;

class SimpleCoffee implements CoffeeInterface
{
    public function getCost(): float
    {
        return 50.0;
    }

    public function getDescription(): string
    {
        return "Simple Coffee";
    }
}
