<?php
// app/Decorators/CoffeeInterface.php

namespace App\Decorators;

interface CoffeeInterface
{
    public function getCost(): float;
    public function getDescription(): string;
}
