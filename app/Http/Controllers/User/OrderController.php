<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller {
    public function index(){ $orders = Order::with('products')->where('user_id',Auth::id())->get(); return view('user.dashboard.index', compact('orders')); }
    public function show($id){ $order = Order::with('products','address')->where('user_id',Auth::id())->findOrFail($id); return view('user.orders.show', compact('order')); }
}
