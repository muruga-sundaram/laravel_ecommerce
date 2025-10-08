<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'price'=>'required|numeric',
            'stock_count'=>'required|integer',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('products','public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'price'=>'required|numeric',
            'stock_count'=>'required|integer',
        ]);

        $data = $request->all();
        if($request->hasFile('image')){
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success','Product updated');
    }

    public function destroy(Product $product)
    {
        if($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted');
    }
}
