@extends('layout')

@section('title', $product->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm">
            @else
                <img src="https://via.placeholder.com/400" class="img-fluid rounded">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->category->name ?? 'No Category' }}</p>
            <p>{{ $product->description }}</p>
            <h4>₹{{ number_format($product->price,2) }}</h4>
            <p>
                @if($product->stock > 0)
                    <span class="badge bg-success">In Stock</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </p>
            @if($product->stock > 0)
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">Add to Cart</a>
                <a href="{{ route('wishlist.add', $product->id) }}" class="btn btn-outline-primary">Add to Wishlist</a>
            @endif
        </div>
    </div>
</div>
@endsection
