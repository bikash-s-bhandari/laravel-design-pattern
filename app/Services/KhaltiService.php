<?php

namespace App\Services;

use App\Contracts\KhaltiInterface;

// Khalti को आफ्नै Interface implement गर्छ
// हाम्रो PaymentInterface implement गर्दैन ❌
class KhaltiService implements KhaltiInterface
{
    public function initiatePayment(float $amount): string
    {
        return 'khalti_txn_' . rand(1000, 9999);
    }

    public function reverseTransaction(string $transactionId): bool
    {
        return true;
    }
}

//यो class हाम्रो PaymentInterface implement गर्दैन — त्यसैले Controller मा directly use गर्न मिल्दैन!
