<?php

namespace App\Chain;

class PaymentHandler extends BaseOrderHandler
{
    public function handle(array $order): array
    {
        echo "💳 Payment check..." . PHP_EOL;

        if ($order['payment_amount'] < $order['total_price'] || $order['payment_amount'] > $order['total_price']) {
            // ❌ Payment is less - chain is stopped!
            return [
                'success' => false,
                'message' => "❌ Payment is less! Total: {$order['total_price']}, Paid: {$order['payment_amount']}",
            ];
        }

        echo "✅ Payment check pass!" . PHP_EOL;
        return $this->passToNext($order);
    }
}
