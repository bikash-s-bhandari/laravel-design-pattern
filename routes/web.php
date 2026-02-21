<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Decorators\CoffeeController;
use App\Http\Controllers\Adapters\BookController;
use App\Http\Controllers\Templates\SandwichController;

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
