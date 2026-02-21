<?php

namespace App\Chain;

class PlaceOrderHandler extends BaseOrderHandler
{
    public function handle(array $order): array
    {
        echo "🎉 Order placed successfully!" . PHP_EOL;

        // Order save actual logic here
        // Order::create($order);

        $orderId = rand(1000, 9999);

        return [
            'success'  => true,
            'message'  => "✅ Order placed successfully!",
            'order_id' => $orderId,
            'details'  => $order,
        ];
    }
}
