@extends('admin.layout')
@section('title', 'Edit Product')

@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
    @csrf @method('PUT')

    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (₹)</label>
        <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock Count</label>
        <input type="number" name="stock_count" value="{{ $product->stock_count }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Current Image</label><br>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" width="100" class="rounded mb-2">
        @else
            <p class="text-muted">No image uploaded</p>
        @endif
        <input type="file" name="image" class="form-control mt-2">
    </div>

    <button class="btn btn-primary">Update Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
