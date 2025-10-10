@extends('layouts.app')
@section('content')
<h1>{{ $product->name }}</h1>
@if($product->image)<img src="/{{ $product->image }}" alt="" style="max-width:300px">@endif
<p>Price: ₹{{ $product->price }}</p>
<p>{{ $product->description }}</p>
@if($product->stock < 1) <p><strong>Out of Stock</strong></p> @else
  <form method="POST" action="{{ route('cart.add') }}">@csrf <input type="hidden" name="product_id" value="{{ $product->id }}"><button>Add to Cart</button></form>
@endif
@endsection
