<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adapters\PaymentController;
use App\Http\Controllers\Strategy\LogController;
use App\Http\Controllers\Chain\OrderController;
use App\Http\Controllers\Specifications\ProductController;

Route::controller(PaymentController::class)->group(function () {
    Route::post('checkout', 'checkout');
    Route::post('refund', 'refund');
});

// Strategy
Route::controller(LogController::class)->group(function () {
    Route::get('log', 'log');
    Route::post('custom-log', 'storeWithCustomLogger');
});

// Chain
Route::controller(OrderController::class)->group(function () {
    Route::post('place-order', 'place');
});

// Specifications
Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index');
});
