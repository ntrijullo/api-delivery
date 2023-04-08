<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    public function index()
    {
        abort_unless(
            Auth::user()->isDelivery(),
            403,
            "You don't have permissions to delivery."
        );

        abort_unless(
            Auth::user()->tokenCan('orders:show'),
            403,
            "You don't have permissions to update delivery."
        );

        $order = Order::where(['delivery_user_id' => Auth::id()])->paginate(10);
        return OrderResource::collection($order);
    }

    public function update(Order $order)
    {
        abort_unless(
            Auth::user()->tokenCan('orders:update'),
            403,
            "You don't have permissions to update delivery."
        );

        abort_unless($order->deliveryUser->is(Auth::user()), 404);
        request()->validate([
            'status' => 'required|in:in establishment,delivered'
        ]);

        $order->status = request('status');
        $order->save();

        return new OrderResource($order);
    }


}
