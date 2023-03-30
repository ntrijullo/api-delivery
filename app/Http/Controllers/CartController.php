<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Product $product)
    {
        Cart::restore(Auth::user()->email);

        Cart::add(
            [
                'id' => 'prod-'.$product->id,
                'name' => $product->name,
                'qty' => request('qty'),
                'price' => $product->price,
                'weight' => 0,
            ]
        );

        Cart::store(Auth::user()->email);

        return Cart::content();
    }
}
