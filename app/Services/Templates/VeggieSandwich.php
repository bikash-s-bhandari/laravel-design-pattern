<?php

namespace App\Services\Templates;

use App\Templates\Sandwich;

class VeggieSandwich extends Sandwich
{
    protected function addMainIngredient()
    {
        echo "Adding lettuce, tomato, and cucumber\n";
    }

    protected function addCondiments()
    {
        echo "Adding olive oil and vinegar\n";
    }
}
