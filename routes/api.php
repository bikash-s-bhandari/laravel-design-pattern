<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adapters\PaymentController;
use App\Http\Controllers\Strategy\LogController;
use App\Http\Controllers\Chain\OrderController;
use App\Http\Controllers\Specifications\ProductController;
use App\Http\Controllers\Monstrous\AdvancedExampleController;
use App\Http\Controllers\Monstrous\DomainEvents\GoodExampleController;

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



// Monstrous
Route::controller(AdvancedExampleController::class)->group(function () {
    Route::post('/monstrous/register', 'register');
});


// Domain Events
Route::controller(GoodExampleController::class)->group(function () {
    Route::post('/domain-events/register', 'store');
});
