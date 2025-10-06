@extends('layout')

@section('content')
<h1>{{ $product->name }}</h1>
<p>{{ $product->description }}</p>
<p>Price: ₹{{ $product->price }}</p>
<p>Stock: {{ $product->stock_count > 0 ? $product->stock_count : 'Out of Stock' }}</p>
@auth
    @if($product->stock_count > 0)
        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit">Add to Cart</button>
        </form>
        <form action="{{ route('wishlist.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit">Add to Wishlist</button>
        </form>
    @endif
@endauth
@endsection
