<?php
// app/Decorators/CoffeeDecorator.php

namespace App\Decorators;

abstract class CoffeeDecorator implements CoffeeInterface
{
    protected CoffeeInterface $coffee;

    public function __construct(CoffeeInterface $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost(): float
    {
        return $this->coffee->getCost();
    }

    public function getDescription(): string
    {
        return $this->coffee->getDescription();
    }
}
