<?php

namespace App\Http\Controllers\Adapters;

use App\Http\Controllers\Controller;
use App\Contracts\PaymentInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentInterface $payment) {}

    public function checkout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $transactionId = $this->payment->pay($request->amount);

        return response()->json([
            'status'         => 'success',
            'message'        => 'Payment With '.class_basename($this->payment).' is successful!',
            'transaction_id' => $transactionId,
            'amount'         => $request->amount,
            'gateway'        => class_basename($this->payment),
        ]);
    }

    public function refund(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string',
        ]);

        $success = $this->payment->refund($request->transaction_id);

        return response()->json([
            'status'  => $success ? 'success' : 'failed',
            'message' => $success ? 'Refund With '.class_basename($this->payment).' is successful!' : 'Refund With '.class_basename($this->payment).' is failed!',
        ]);
    }
}
