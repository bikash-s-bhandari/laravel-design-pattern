<?php

namespace App\Services;

use App\Contracts\PaymentInterface;

class EsewaService implements PaymentInterface
{
    public function pay(float $amount): string
    {
        return 'esewa_txn_' . rand(1000, 9999);
    }

    public function refund(string $transactionId): bool
    {
        return true;
    }
}
