<?php

namespace App\Http\Controllers\EasyMaintainCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;
use App\Services\EasyMaintain\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}
    /*
    Tightly Coupled
    Hard to test
    Hard to change
    Hard to reuse
    Hard to understand
    Hard to maintain
    Hard to scale
    Hard to deploy
    Hard to debug
    */
    public function store(Request $request)
    {
        // Controller directly DB use गगगगगग — BAD!l
        $order = DB::table('orders')->insert([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'total' => $request->price * $request->qty,
        ]);
        Mail::to($request->email)->send(new OrderConfirmed());
    }

    //✅ Decoupled — Service Layer
    public function placeOrder(Request $request): JsonResponse
    {
        $order = $this->orderService->placeOrder($request->validated());

        return response()->json($order, 201);
    }

    // Easy to navigate: clearly named method
    public function totalPrice(): JsonResponse
    {
        $total = $this->orderService->calculateTotalActiveOrders();

        return response()->json([
            'status' => 'success',
            'total_active_orders_price' => $total
        ]);
    }
}
