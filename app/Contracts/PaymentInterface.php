<?php

namespace App\Contracts;

interface PaymentInterface
{
    public function pay(float $amount): string;
    public function refund(string $transactionId): bool;
}
