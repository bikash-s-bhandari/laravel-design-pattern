<?php

namespace App\Specifications;

class FeaturedSpecification implements Specification
{
    public function isSatisfiedBy(mixed $product): bool
    {
        return $product['featured'] === true;
    }
}
