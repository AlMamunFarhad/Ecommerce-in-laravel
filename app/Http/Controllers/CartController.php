<?php

namespace App\Http\Controllers;
// use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart',['cartItems'=> $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart')->add($product->id,$product->name,$request->quantity,$price)->associate('App\Models\Product');
        return redirect()->back()->with('Success ! Product has been added successfully.');
    }

    public function updateCartProduct(Request $request)
    {
       Cart::instance('cart')->update($request->rowId,$request->quantity);
       return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $row_id = $request->rowId;
        Cart::instance('cart')->remove($row_id);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
