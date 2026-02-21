<?php

namespace App\Http\Controllers\Templates;

use App\Http\Controllers\Controller;
use App\Services\Templates\NonVegSandwich;
use App\Services\Templates\VeggieSandwich;

class SandwichController extends Controller
{
    public function showNonVegSandwich()
    {
        $sandwich = new NonVegSandwich();
        $sandwich->make();

        return response()->json([
            'status'  => 'success',
            'message' => 'Non Veg Sandwich is served',
            'sandwich' => $sandwich,
        ]);
    }

    public function showVeggieSandwich()
    {
        $sandwich = new VeggieSandwich();
        $sandwich->make();

        return response()->json([
            'status'  => 'success',
            'message' => 'Veggie Sandwich is served',
            'sandwich' => $sandwich,
        ]);
    }
}
