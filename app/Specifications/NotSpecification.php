<?php

namespace App\Specifications;

class NotSpecification implements Specification
{
    public function __construct(private Specification $specification) {}

    public function isSatisfiedBy(mixed $item): bool
    {
        return !$this->specification->isSatisfiedBy($item);
    }
}
