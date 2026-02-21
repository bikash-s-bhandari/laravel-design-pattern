<?php

namespace App\Contracts;

interface KhaltiInterface
{
    public function initiatePayment(float $amount): string;
    public function reverseTransaction(string $transactionId): bool;
}
