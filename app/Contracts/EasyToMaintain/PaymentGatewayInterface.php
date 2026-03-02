<?php

namespace App\Contracts\EasyToMaintain;

interface PaymentGatewayInterface
{
    public function initiate(float $amount, string $orderId): array;

    public function verify(string $transactionId): array;

    public function getName(): string;
}
