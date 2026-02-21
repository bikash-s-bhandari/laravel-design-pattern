<?php

namespace App\Services\Templates;

use App\Templates\Sandwich;

class NonVegSandwich extends Sandwich
{
    protected function addMainIngredient()
    {
        echo "Adding chicken\n";
    }

    protected function addCondiments()
    {
        echo "Adding ketchup and mayonnaise\n";
    }
}
