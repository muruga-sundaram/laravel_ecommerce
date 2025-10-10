<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; use Illuminate\Http\Request; use App\Models\Order; use App\Models\Address; use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){ $orders = Order::where('user_id',Auth::id())->latest()->get(); $addresses = Address::where('user_id',Auth::id())->get(); return view('frontend.user.dashboard', compact('orders','addresses')); }
}
