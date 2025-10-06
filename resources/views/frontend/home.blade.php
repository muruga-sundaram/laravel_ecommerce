@extends('layout')

@section('content')
<h1>Products</h1>
<form method="GET" action="{{ route('home') }}">
    <input type="text" name="search" placeholder="Search Products" value="{{ request('search') }}">
    <select name="sort">
        <option value="">Sort</option>
        <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price Low→High</option>
        <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price High→Low</option>
        <option value="newest" {{ request('sort')=='newest'?'selected':'' }}>Newest</option>
    </select>
    <button type="submit">Apply</button>
</form>

<div class="products">
    @foreach($products as $product)
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Price: ₹{{ $product->price }}</p>
            <p>Stock: {{ $product->stock_count > 0 ? $product->stock_count : 'Out of Stock' }}</p>
            <a href="{{ route('product.show',$product->id) }}">View</a>
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
        </div>
    @endforeach
</div>
@endsection
