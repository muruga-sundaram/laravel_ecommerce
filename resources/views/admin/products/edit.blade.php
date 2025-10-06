@extends('admin.layout')

@section('content')
<h2>Edit Product</h2>
<form action="{{ route('admin.products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $product->name }}" required><br>
    <select name="category_id" required>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select><br>
    <input type="number" name="price" value="{{ $product->price }}" step="0.01" required><br>
    <textarea name="description">{{ $product->description }}</textarea><br>
    <input type="number" name="stock_count" value="{{ $product->stock_count }}" required><br>
    <input type="file" name="image"><br>
    <button type="submit">Update</button>
</form>
@endsection
