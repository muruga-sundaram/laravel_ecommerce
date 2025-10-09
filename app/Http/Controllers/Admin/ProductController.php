<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'stock_count'=>'required|integer',
            'description'=>'required|string',
            'image'=>'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);

        Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'stock_count'=>$request->stock_count,
            'description'=>$request->description,
            'image'=>$imageName
        ]);

        return redirect()->route('admin.products.index')->with('success','Product Added');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $request->validate([
            'name'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'stock_count'=>'required|integer',
            'description'=>'required|string',
            'image'=>'nullable|image'
        ]);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'stock_count'=>$request->stock_count,
            'description'=>$request->description,
            'image'=>$imageName
        ]);

        return redirect()->route('admin.products.index')->with('success','Product Updated');
    }

    public function destroy($id) {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success','Product Deleted');
    }
}
