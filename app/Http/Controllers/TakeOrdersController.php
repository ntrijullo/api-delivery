<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakeOrdersController extends Controller
{
    public function update(Order $order)
    {
        abort_unless(
            Auth::user()->isDelivery(),
            403,
            "You don't have permissions to delivery."
        );

        abort_if(
            $order->isPending(),
            403,
            "Order is already taken."
        );

        $order->delivery_user_id = Auth::id();
        $order->status = 'delivery assigned';
        $order->save();

        return new OrderResource($order);
    }
}
