<?php

namespace App\Http\Controllers\Decorators;

use App\Http\Controllers\Controller;
use App\Decorators\SimpleCoffee;
use App\Decorators\MilkDecorator;
use App\Decorators\SugarDecorator;

class CoffeeController extends Controller
{
    public function showSimpleCoffee()
    {
        // 1. Plain Coffee
        $coffee = new SimpleCoffee();
        return $coffee->getDescription() . ' - ₹' . $coffee->getCost();
    }

    public function showMilkCoffee()
    {
        // 2. Milk Coffee
        $plainCoffee = new SimpleCoffee();
        $milkCoffee = new MilkDecorator($plainCoffee);
        return $milkCoffee->getDescription() . ' - ₹' . $milkCoffee->getCost();
    }

    public function showSugarCoffee()
    {
        // 3. Sugar Coffee
        $plainCoffee = new SimpleCoffee();
        $sugarCoffee = new SugarDecorator($plainCoffee);
        return $sugarCoffee->getDescription() . ' - ₹' . $sugarCoffee->getCost();
    }

    public function showMilkAndSugarCoffee()
    {
        // 4. Milk and Sugar Coffee
        $plainCoffee = new SimpleCoffee();
        $milkCoffee = new MilkDecorator($plainCoffee);
        $sugarCoffee = new SugarDecorator($milkCoffee);
        return $sugarCoffee->getDescription() . ' - ₹' . $sugarCoffee->getCost();
    }
}
