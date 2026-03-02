<?php

namespace App\Services\EasyMaintain;

use App\Contracts\EasyToMaintain\Shape;

class Circle implements Shape
{
    public function __construct(protected float $radius) {}

    public function area(): float
    {
        return 3.14 * $this->radius * $this->radius;
    }
}
