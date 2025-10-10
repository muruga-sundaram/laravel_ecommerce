<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller {
    public function index(){ $items = Cart::with('product')->where('user_id',Auth::id())->get(); return view('user.cart.index', ['cartItems'=>$items]); }
    public function add(Request $request){ $request->validate(['product_id'=>'required|exists:products,id','quantity'=>'nullable|integer|min:1']); $product = Product::findOrFail($request->product_id); if($product->stock_count <= 0) return back()->withErrors('Product out of stock'); \App\Models\Cart::updateOrCreate(['user_id'=>Auth::id(),'product_id'=>$product->id], ['quantity'=>$request->quantity ?? 1]); return back()->with('success','Added to cart'); }
    public function update(Request $request,$id){ $cart = Cart::findOrFail($id); $cart->update(['quantity'=>$request->quantity]); return back()->with('success','Cart updated'); }
    public function remove($id){ Cart::findOrFail($id)->delete(); return back()->with('success','Removed'); }
}
