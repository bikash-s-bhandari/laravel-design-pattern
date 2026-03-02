<?php

namespace App\Services\EasyMaintain;

use App\Contracts\EasyToMaintain\Shape;

class Square implements Shape
{
    public function __construct(protected float $side) {}

    public function area(): float
    {
        return $this->side * $this->side;
    }
}
