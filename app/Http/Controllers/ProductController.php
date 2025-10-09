<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query()->where('stock_count','>',0);
        if($request->search) $query->where('name','like',"%{$request->search}%")
                                  ->orWhere('description','like',"%{$request->search}%");
        if($request->sort=='price_asc') $query->orderBy('price','asc');
        elseif($request->sort=='price_desc') $query->orderBy('price','desc');
        elseif($request->sort=='newest') $query->latest();

        $products = $query->get();
        return view('user.products.index', compact('products'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('user.products.show', compact('product'));
    }
}


