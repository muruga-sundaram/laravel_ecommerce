
@extends('layouts.app')
@section('title','Cart')
@section('content')
<h1>Your Cart</h1>
@if($cartItems->count())
<table class="table"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr></thead><tbody>@php $total=0; @endphp @foreach($cartItems as $it) @php $sub=$it->product->price*$it->quantity; $total+=$sub; @endphp <tr><td>{{ $it->product->name }}</td><td>₹{{ $it->product->price }}</td><td><form action="{{ route('cart.update', $it->id) }}" method="POST">@csrf @method('PUT')<input type="number" name="quantity" value="{{ $it->quantity }}" style="width:80px;"> <button class="btn btn-sm btn-primary">Update</button></form></td><td>₹{{ $sub }}</td><td><form action="{{ route('cart.remove', $it->id) }}" method="POST">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Remove</button></form></td></tr> @endforeach</tbody></table><h4>Total: ₹{{ $total }}</h4><a class="btn btn-success" href="{{ route('checkout.index') }}">Checkout</a>@else <p>Your cart is empty.</p> @endif @endsection