<?php

namespace App\Services\EasyMaintain;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;
use App\Models\Order;
use App\Events\OrderPlaced;

class OrderService
{
    public function placeOrder(array $data): Order
    {
        $order = Order::create($data);
        event(new OrderPlaced($order));

        return $order;
    }

    /**
     * Calculate total price of active orders
     */
    public function calculateTotalActiveOrders(): float
    {
        return Order::active()->sum('price');
    }
}
