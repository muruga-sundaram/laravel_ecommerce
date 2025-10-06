@extends('admin.layout')

@section('content')
<h2>Add Product</h2>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Product Name" required><br>
    <select name="category_id" required>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select><br>
    <input type="number" name="price" placeholder="Price" step="0.01" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="number" name="stock_count" placeholder="Stock" required><br>
    <input type="file" name="image"><br>
    <button type="submit">Save</button>
</form>
@endsection
