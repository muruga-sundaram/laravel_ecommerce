<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function index()
    {
        // Load latest products (only in stock)
        $products = Product::where('stock_count', '>', 0)->latest()->take(8)->get();
        $categories = Category::all();

        return view('frontend.home', compact('products', 'categories'));
    }

    /**
     * Show all products with search and sort.
     */
    public function products(Request $request)
    {
        $query = Product::query();

        // Search by name or description
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort by price or newest
        if ($request->has('sort')) {
            if ($request->sort == 'low_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'high_low') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        // Only products in stock_count
        $products = $query->where('stock_count', '>', 0)->paginate(12);
        $categories = Category::all();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    /**
     * Show single product details.
     */
    public function showProduct($id)
    {
        $product = Product::findOrFail($id);

        // If stock = 0 → show "Out of Stock"
        $outOfStock = $product->stock_count <= 0;

        return view('frontend.products.show', compact('product', 'outOfStock'));
    }
}
