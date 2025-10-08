<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $query = Product::query();
           // Fetch all products
        $products = Product::all();

        if($request->search){
            $query->where('name','like','%'.$request->search.'%')
                  ->orWhere('description','like','%'.$request->search.'%');
        }

        if($request->sort){
            switch($request->sort){
                case 'price_asc': $query->orderBy('price','asc'); break;
                case 'price_desc': $query->orderBy('price','desc'); break;
                case 'newest': $query->orderBy('created_at','desc'); break;
            }
        }

        // $products = $query->get();
        return view('frontend.home', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product', compact('product'));
    }
}
