@extends('admin.layout')
@section('title', 'Products')

@section('content')
<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $key => $product)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>₹{{ number_format($product->price, 2) }}</td>
            <td>
                @if($product->stock > 0)
                    <span class="badge bg-success">{{ $product->stock }}</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </td>
            <td>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product" width="60" height="60" class="rounded">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted">No products available</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
