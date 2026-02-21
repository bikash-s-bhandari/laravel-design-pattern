<?php

namespace App\Http\Controllers\Chain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Chain\StockHandler;
use App\Chain\PaymentHandler;
use App\Chain\FraudHandler;
use App\Chain\PlaceOrderHandler;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $request->validate([
            'product'          => 'required|string',
            'quantity'         => 'required|integer|min:1',
            'stock_available'  => 'required|integer',
            'total_price'      => 'required|numeric',
            'payment_amount'   => 'required|numeric',
        ]);

        $order = $request->only([
            'product',
            'quantity',
            'stock_available',
            'total_price',
            'payment_amount',
        ]);

        // Create handlers
        $stockHandler    = new StockHandler();
        $paymentHandler  = new PaymentHandler();
        $fraudHandler    = new FraudHandler();
        $placeOrder      = new PlaceOrderHandler();

        // Chain handlers
        // Stock -> Payment -> Fraud -> PlaceOrder
        $stockHandler
            ->setNext($paymentHandler)
            ->setNext($fraudHandler)
            ->setNext($placeOrder);

        // Start chain from first handler
        $result = $stockHandler->handle($order);

        // ✅ Response पठाउने
        $statusCode = $result['success'] ? 200 : 422;

        return response()->json($result, $statusCode);
    }
}
