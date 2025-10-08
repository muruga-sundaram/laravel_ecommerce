@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container">
    <h2 class="mb-4">Our Products</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/200" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->description, 50) }}</p>
                    <p class="fw-bold">₹{{ number_format($product->price,2) }}</p>
                    @if($product->stock > 0)
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success btn-sm">Add to Cart</a>
                        <a href="{{ route('wishlist.add', $product->id) }}" class="btn btn-outline-primary btn-sm">Wishlist</a>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm mt-1">View</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">No products available</p>
        @endforelse
    </div>
</div>
@endsection
