<?php

namespace App\Http\Controllers\EasyMaintainCode\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EasyMaintain\EsewaService;
use App\Services\EasyMaintain\KhaltiService;

class PaymentBadCodeController extends Controller
{
    //naya payment gateway add garda controller touch or modify garnu paryo which is bad code
    public function initiate(Request $request)
    {
        $gateway = $request->input('gateway'); // 'esewa', 'khalti', etc.
        $amount  = $request->input('amount');
        $orderId = $request->input('order_id');

        if ($gateway === 'esewa') {
            $esewa = new EsewaService();
            return $esewa->initiate($amount, $orderId);
        } else if ($gateway === 'khalti') {
            $khalti = new KhaltiService();
            return $khalti->initiate($amount, $orderId);
        } else if ($gateway === 'fonepay') {
            // Fonepay logic...
            return response()->json(['message' => 'Fonepay initiated']);
        } else {
            return response()->json(['error' => 'Invalid gateway'], 400);
        }
    }
}
