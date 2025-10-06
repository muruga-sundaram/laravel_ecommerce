<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        Wishlist::updateOrCreate(
            ['user_id'=>Auth::id(),'product_id'=>$request->product_id]
        );
        return back()->with('success','Added to wishlist');
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return back()->with('success','Removed from wishlist');
    }
}
