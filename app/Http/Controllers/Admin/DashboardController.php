<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalCategories = \App\Models\Category::count();

        // quick test
        logger("Dashboard counts:", [
            'products' => $totalProducts,
            'orders' => $totalOrders,
            'categories' => $totalCategories
        ]);

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalCategories'));
    }

}
