@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p><strong>Price:</strong> ₹{{ number_format($product->price, 2) }}</p>

    @if($outOfStock)
        <span class="badge bg-danger">Out of Stock</span>
    @else
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button class="btn btn-primary">Add to Cart</button>
        </form>
    @endif
</div>
@endsection
