
@extends('layouts.app')
@section('title','Wishlist')
@section('content')
<h1>Your Wishlist</h1>
@if($wishlistItems->count())
<ul>@foreach($wishlistItems as $it)<li>{{ $it->product->name }} - ₹{{ $it->product->price }} @if($it->product->stock_count>0)<form action="{{ route('cart.add') }}" method="POST" style="display:inline">@csrf<input type="hidden" name="product_id" value="{{ $it->product->id }}"><button class="btn btn-sm btn-success">Add to Cart</button></form>@else <span class="text-danger">Out of Stock</span>@endif <form action="{{ route('wishlist.remove', $it->id) }}" method="POST" style="display:inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Remove</button></form></li>@endforeach</ul>@else <p>Your wishlist is empty.</p> @endif @endsection