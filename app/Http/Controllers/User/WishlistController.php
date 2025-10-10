<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller {
    public function index(){ $items = Wishlist::with('product')->where('user_id',Auth::id())->get(); return view('user.wishlist.index', ['wishlistItems'=>$items]); }
    public function add(Request $request){ $request->validate(['product_id'=>'required|exists:products,id']); $product = Product::findOrFail($request->product_id); if($product->stock_count <= 0) return back()->withErrors('Out of stock'); Wishlist::updateOrCreate(['user_id'=>Auth::id(),'product_id'=>$product->id]); return back()->with('success','Added'); }
    public function remove($id){ Wishlist::findOrFail($id)->delete(); return back()->with('success','Removed'); }
}
