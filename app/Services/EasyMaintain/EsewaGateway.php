<?php

namespace App\Services\EasyMaintain;

use App\Contracts\EasyToMaintain\PaymentGatewayInterface;

class EsewaGateway implements PaymentGatewayInterface
{
    public function initiate(float $amount, string $orderId): array
    {
        return [
            'gateway' => $this->getName(),
            'redirect_url' => $response['redirect_url'] ?? null,
            'message' => 'eSewa payment initiated',
        ];
    }

    public function verify(string $transactionId): array
    {
        // verify logic...
        return ['status' => 'success', 'message' => 'Verified'];
    }

    public function getName(): string
    {
        return 'eSewa';
    }
}
