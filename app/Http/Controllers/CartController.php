<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    public function index()
    {
        abort_unless(
            Auth::user()->tokenCan('cart:manager'),
            403,
            "You don't have permissions to perform this action."
        );

        Cart::restore(Auth::user()->email);
        Cart::store(Auth::user()->email);

        return Cart::content();
    }

    public function store(CartRequest $request, Product $product)
    {
        abort_unless(
            Auth::user()->tokenCan('cart:manager'),
            403,
            "You don't have permissions to perform this action."
        );

        $data = $request->validated();

        Cart::restore(Auth::user()->email);

        Cart::add(
            [
                'id' => 'prod-'.$product->id,
                'name' => $product->name,
                'qty' => $data['qty'],
                'price' => $product->price,
                'weight' => 0,
                'options' => [
                    'product_id' => $product->id,
                ]
            ]
        );

        Cart::store(Auth::user()->email);

        return Cart::content();
    }

    public function update(CartRequest $request, $rowId)
    {
        abort_unless(
            Auth::user()->tokenCan('cart:manager'),
            403,
            "You don't have permissions to perform this action."
        );

        $data = $request->validated();

        Cart::restore(Auth::user()->email);
        Cart::update($rowId,[
            'qty' => $data['qty'],
        ]);

        Cart::store(Auth::user()->email);

        return Cart::content();
    }

    public function destroy($rowId)
    {
        abort_unless(
            Auth::user()->tokenCan('cart:manager'),
            403,
            "You don't have permissions to perform this action."
        );

        Cart::restore(Auth::user()->email);
        Cart::remove($rowId);

        Cart::store(Auth::user()->email);

        return Cart::content();
    }
}
