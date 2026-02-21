<?php

namespace App\Adapters;

use App\Contracts\PaymentInterface;
use App\Services\KhaltiService;

class KhaltiAdapter implements PaymentInterface
{
    public function __construct(private KhaltiService $khalti) {}

    public function pay(float $amount): string
    {
        return $this->khalti->initiatePayment($amount);
    }

    public function refund(string $transactionId): bool
    {
        return $this->khalti->reverseTransaction($transactionId);
    }
}
