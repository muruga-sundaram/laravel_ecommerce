@extends('layout')

@section('title', 'Wishlist')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Wishlist</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($wishlistItems as $item)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if($item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                @endif
                <div class="card-body">
                    <h5>{{ $item->product->name }}</h5>
                    <p>₹{{ number_format($item->product->price,2) }}</p>
                    <a href="{{ route('cart.add', $item->product->id) }}" class="btn btn-success btn-sm">Add to Cart</a>
                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Wishlist is empty.</p>
        @endforelse
    </div>
</div>
@endsection
