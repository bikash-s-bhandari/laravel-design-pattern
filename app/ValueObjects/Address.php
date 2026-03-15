<?php

namespace App\ValueObjects;

final readonly class Address
{
    public function __construct(
        public string $street,
        public string $city,
        public string $state,
        public string $zip,
        public string $country = 'NP',
    ) {
        if (strlen($zip) < 4) {
            throw new \InvalidArgumentException('Invalid ZIP code');
        }
    }

    // Behaviour yatai — VO ko advantage
    public function format(): string
    {
        return "{$this->street}, {$this->city}, {$this->state} {$this->zip}";
    }

    public function isNepal(): bool
    {
        return $this->country === 'NP';
    }

    public function equals(self $other): bool
    {
        return $this->zip === $other->zip
            && $this->street === $other->street;
    }
}
