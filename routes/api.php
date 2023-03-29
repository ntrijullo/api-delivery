<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstablishmentsController;

Route::middleware('auth:sanctum')->group( function (){

    Route::get('establishments', [EstablishmentsController::class, 'index']);
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


