<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; use App\Models\Order; use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){ $orders = Order::with('items.product','user')->latest()->get(); return view('admin.orders.index', compact('orders')); }
    public function updateStatus(Request $r, Order $order){ $r->validate(['status'=>'required']); $order->update(['status'=>$r->status]); return back()->with('success','Status updated'); }
}
