<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; use App\Models\Product; use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $r){ $q = Product::where('stock','>','0'); if($r->search){ $q = $q->where(function($s) use ($r){ $s->where('name','like','%'.$r->search.'%')->orWhere('description','like','%'.$r->search.'%'); }); } if($r->sort=='price_low') $q = $q->orderBy('price','asc'); elseif($r->sort=='price_high') $q = $q->orderBy('price','desc'); else $q = $q->latest(); $products = $q->paginate(12); return view('frontend.products.index', compact('products')); }
    public function show(Product $product){ return view('frontend.products.show', compact('product')); }
}
