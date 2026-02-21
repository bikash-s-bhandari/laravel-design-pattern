<?php

namespace App\Specifications;

class OrSpecification implements Specification
{
    public function __construct(private Specification $left, private Specification $right) {}

    public function isSatisfiedBy(mixed $item): bool
    {
        return $this->left->isSatisfiedBy($item) || $this->right->isSatisfiedBy($item);
    }
}
