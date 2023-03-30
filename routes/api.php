<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstablishmentsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;

Route::middleware('auth:sanctum')->group( function (){

    Route::get('establishments', [EstablishmentsController::class, 'index']);
    Route::get('establishments/{establishment}', [EstablishmentsController::class, 'show']);

    Route::get('products/{product}', [ProductsController::class, 'show'])
        ->name('products:show');

    Route::post('cart/add-product/{product}', [CartController::class, 'store']);
    Route::get('/user', function (Request $request) { return $request->user();});
    Route::post('orders', function (){
        abort_unless(
            Auth::user()->tokenCan('orders:create'),
            403,
            "You don't have permissions to perform this action."
        );

        return [
            'message' => 'Order created'
        ];
    });
});



Route::post('login', [LoginController::class, 'login']);


