@extends('layout')

@section('content')
<h1>Wishlist</h1>
@if($wishlistItems->count() > 0)
    <ul>
    @foreach($wishlistItems as $item)
        <li>
            {{ $item->product->name }} - ₹{{ $item->product->price }}
            @if($item->product->stock_count > 0)
                <form action="{{ route('cart.store') }}" method="POST" style="display:inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                    <button type="submit">Add to Cart</button>
                </form>
            @endif
            <form action="{{ route('wishlist.destroy',$item->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Remove</button>
            </form>
        </li>
    @endforeach
    </ul>
@else
    <p>Wishlist empty.</p>
@endif
@endsection
