<?php

namespace App\Specifications;

class InStockSpecification implements Specification
{
    public function isSatisfiedBy(mixed $product): bool
    {
        return $product['stock'] > 0;
    }
}
