<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstablishmentsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\DeliveryAvailabilityController;
use App\Http\Controllers\DeliveryCoordinatesController;
use App\Http\Controllers\TakeOrdersController;
use App\Http\Controllers\MyOrdersController;

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group( function (){

    //establishment
    Route::get('establishments', [EstablishmentsController::class, 'index']);
    Route::get('establishments/{establishment}', [EstablishmentsController::class, 'show']);

    //products
    Route::get('products/{product}', [ProductsController::class, 'show'])
        ->name('products:show');

    //cart
    Route::get('cart', [CartController::class, 'index']);
    Route::put('cart/{rowId}', [CartController::class, 'update']);
    Route::delete('cart/{rowId}', [CartController::class, 'destroy']);
    Route::post('cart/add-product/{product}', [CartController::class, 'store']);

    Route::get('/user', function (Request $request) { return $request->user();});

    //orders
    Route::get('orders', [OrdersController::class, 'index']);
    Route::post('orders', [OrdersController::class, 'store']);

    //availability
    Route::put('availability', [DeliveryAvailabilityController::class, 'update']);

    //coordinates
    Route::put('coordinates', [DeliveryCoordinatesController::class, 'update'])->name('coordinates:update');

    //delivery take
    Route::put('orders/{order}/take', [TakeOrdersController::class, 'update']);

    //my-orders
    Route::get('my-orders', [MyOrdersController::class, 'index']);
    Route::put('my-orders/{order}', [MyOrdersController::class, 'update']);

});


