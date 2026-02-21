<?php

namespace App\Specifications;

interface Specification
{
    public function isSatisfiedBy(mixed $item): bool;
}
