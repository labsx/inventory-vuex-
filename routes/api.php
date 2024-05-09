<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SupplierController;

Route::resource('/items', ItemController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('item', TestController::class)->only('index', 'store');
Route::resource('/suppliers', SupplierController::class)->only(['index']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
    // Route::post('/logout', [UserController::class, 'logout']);
    // Route::get('/hotdog', [ItemController::class, 'index']);
});
