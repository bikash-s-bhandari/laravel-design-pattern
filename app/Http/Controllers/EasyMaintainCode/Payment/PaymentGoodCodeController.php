<?php

namespace App\Http\Controllers\EasyMaintainCode\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\EasyToMaintain\PaymentGatewayInterface;


class PaymentGoodCodeController extends Controller
{
    public function __construct(private PaymentGatewayInterface $paymentGateway) {}

    //✅ Decoupled — Service Layer and in future if new gateway add then only add new gateway class and service layer not in controller which is open closed principle
    public function initiate(Request $request)
    {
        $amount   = $request->amount;
        $orderId  = $request->order_id;
        $customer = $request->only(['name', 'email', 'phone']);

        $result = $this->paymentGateway->initiate($amount, $orderId, $customer);

        return response()->json($result);
    }

    public function verify(Request $request)
    {
        $result = $this->paymentGateway->verify($request->transaction_id ?? $request->pidx);

        return response()->json($result);
    }
}
