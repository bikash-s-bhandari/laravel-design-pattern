<?php

namespace App\Chain;

class StockHandler extends BaseOrderHandler
{
    public function handle(array $order): array
    {
        echo "📦 Stock check..." . PHP_EOL;

        if ($order['quantity'] > $order['stock_available']) {
            // ❌ Stock is not available - chain is stopped!
            return [
                'success' => false,
                'message' => "❌ Stock is not available! Available: {$order['stock_available']}",
            ];
        }

        echo "✅ Stock check pass!" . PHP_EOL;
        // ✅ Stock is available - pass to next handler
        return $this->passToNext($order);
    }
}
