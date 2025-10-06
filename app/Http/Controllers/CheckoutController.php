<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartItems','addresses'));
    }

    public function store(Request $request)
    {
        $request->validate(['address_id'=>'required']);
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($i)=>$i->quantity*$i->product->price);

        $order = Order::create([
            'user_id'=>Auth::id(),
            'total'=>$total,
            'status'=>'On Process'
        ]);

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$item->product_id,
                'quantity'=>$item->quantity,
                'price'=>$item->product->price
            ]);

            // reduce stock
            $item->product->decrement('stock_count', $item->quantity);
        }

        // clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success','Order placed successfully');
    }
}
