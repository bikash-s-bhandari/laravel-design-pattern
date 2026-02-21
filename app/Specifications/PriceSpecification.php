<?php

namespace App\Specifications;

class PriceSpecification implements Specification
{
    public function __construct(private float $minPrice, private float $maxPrice) {}

    public function isSatisfiedBy(mixed $product): bool
    {
        return $product['price'] >= $this->minPrice && $product['price'] <= $this->maxPrice;
    }
}
