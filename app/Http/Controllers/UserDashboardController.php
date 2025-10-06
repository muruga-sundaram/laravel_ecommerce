<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Address;

class UserDashboardController extends Controller
{
    public function orders()
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->get();
        return view('frontend.orders', compact('orders'));
    }

    public function wishlist()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlistItems'));
    }

    public function addresses()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('frontend.addresses', compact('addresses'));
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'city'=>'required',
        ]);

        Address::create([
            'user_id'=>Auth::id(),
            'name'=>$request->name,
            'address'=>$request->address,
            'city'=>$request->city
        ]);

        return back()->with('success','Address added');
    }

    public function editAddress(Request $request, Address $address)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'city'=>'required',
        ]);

        $address->update($request->only('name','address','city'));
        return back()->with('success','Address updated');
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return back()->with('success','Address deleted');
    }
}
