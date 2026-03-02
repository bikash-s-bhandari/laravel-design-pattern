<?php

namespace App\Services\EasyMaintain;

use App\Contracts\EasyToMaintain\PaymentGatewayInterface;

class KhaltiGateway implements PaymentGatewayInterface
{
    public function initiate(float $amount, string $orderId): array
    {
        // Http::post(...) to Khalti API...

        return [
            'gateway' => $this->getName(),
            'payment_url' => 'https://khalti.com/...',
            'pidx' => 'generated_pidx',
        ];
    }

    public function verify(string $pidx): array
    {
        // Khalti lookup API call...
        return ['status' => 'Completed', 'message' => 'Payment verified'];
    }

    public function getName(): string
    {
        return 'Khalti';
    }
}
