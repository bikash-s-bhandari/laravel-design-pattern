<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Decorators\CoffeeController;
use App\Http\Controllers\Adapters\BookController;
use App\Http\Controllers\Templates\SandwichController;
use App\Http\Controllers\EasyMaintainCode\OrderController;
use App\Http\Controllers\EloquentPerformance\UserController;
use App\Http\Controllers\Monstrous\AdvancedExampleController;

Route::get('/', function () {
    return view('welcome');
});

// Decorators
Route::controller(CoffeeController::class)->group(function () {
    Route::get('/simple-coffee', 'showSimpleCoffee');
    Route::get('/milk-coffee', 'showMilkCoffee');
    Route::get('/sugar-coffee', 'showSugarCoffee');
    Route::get('/milk-and-sugar-coffee', 'showMilkAndSugarCoffee');
});

// Adapters
Route::controller(BookController::class)->group(function () {
    // Method 1 — Service Provider
    Route::get('/read-with-binding', 'readWithBinding');
    // Method 2 — Manually
    Route::get('/read-book', 'readBook');

    // Method 3 — Kindle
    Route::get('/read/kindle', [BookController::class, 'readKindle']);
});

// Templates
Route::controller(SandwichController::class)->group(function () {
    Route::get('/non-veg-sandwich', 'showNonVegSandwich');
    Route::get('/veg-sandwich', 'showVeggieSandwich');
});


// Easy Navigation Code
//Clear route: /orders/total → clearly indicates purpose
Route::get('/orders/total', [OrderController::class, 'totalPrice']);

// Eloquent Performance
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/last-login', 'getUsersWithLastLogin');
    Route::get('/users/circular-bad', 'badCircularRelationship');
    Route::get('/users/circular-good', 'goodCircularRelationship');
});

Route::get('/users/search', [UserController::class, 'search']);



