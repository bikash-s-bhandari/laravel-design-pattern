<?php

namespace App\Services\EasyMaintain;

class AreaCalculator
{
    /*
    नयाँ shape (जस्तै rectangle) add गर्नुपर्दा calculate() method modify गर्नु पर्छ

    Risky: पुरानो logic break हुन सक्छ

    Difficult to maintain
    */
    public function calculate($shapes)
    {
        $total = 0;

        foreach ($shapes as $shape) {
            if ($shape['type'] === 'circle') {
                $total += 3.14 * $shape['radius'] * $shape['radius'];
            } elseif ($shape['type'] === 'square') {
                $total += $shape['side'] * $shape['side'];
            }
        }

        return $total;
    }


    /*
    ✅ Decoupled — each shape handles its own area follow open closed principle*/
    public function calculateArea(array $shapes): float
    {
        $total = 0;

        foreach ($shapes as $shape) {
            $total += $shape->area(); // each shape handles its own area
        }

        return $total;
    }
}
