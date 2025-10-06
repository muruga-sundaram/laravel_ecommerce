@extends('admin.layout')

@section('content')
<h2>Products</h2>
<a href="{{ route('admin.products.create') }}">Add Product</a>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
@foreach($products as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>{{ $product->category->name }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->stock_count }}</td>
    <td>
        <a href="{{ route('admin.products.edit',$product->id) }}">Edit</a>
        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
