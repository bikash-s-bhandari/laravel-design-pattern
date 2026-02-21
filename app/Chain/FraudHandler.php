<?php

namespace App\Chain;

class FraudHandler extends BaseOrderHandler
{
    public function handle(array $order): array
    {
        echo "🕵️ Fraud check गर्दै..." . PHP_EOL;

        // Suspect order - more than 50000
        if ($order['total_price'] > 50000) {
            return [
                'success' => false,
                'message' => "❌ Suspicious Order! Manual review is required.",
            ];
        }

        echo "✅ Fraud check pass!" . PHP_EOL;
        return $this->passToNext($order);
    }
}
