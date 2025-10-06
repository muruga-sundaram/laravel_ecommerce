<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $cart = Cart::updateOrCreate(
            ['user_id'=>Auth::id(),'product_id'=>$request->product_id],
            ['quantity'=>1]
        );
        return back()->with('success','Added to cart');
    }

    public function update(Request $request, Cart $cart)
    {
        $cart->update(['quantity'=>$request->quantity]);
        return back()->with('success','Cart updated');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success','Removed from cart');
    }
}
