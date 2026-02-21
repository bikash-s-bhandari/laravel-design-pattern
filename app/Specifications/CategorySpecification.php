<?php

namespace App\Specifications;

class CategorySpecification implements Specification
{
    public function __construct(private string $category) {}

    public function isSatisfiedBy(mixed $product): bool
    {
        return strtolower($product['category']) === strtolower($this->category);
    }
}
