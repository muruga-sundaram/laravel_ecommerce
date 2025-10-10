@extends('layouts.app')
@section('content')
<h1>Your Cart</h1>
@if($items->isEmpty()) <p>Cart empty</p> @else
<table><tr><th>Product</th><th>Qty</th><th>Price</th><th>Action</th></tr>
@php $total=0; @endphp
@foreach($items as $it)
  <tr>
    <td>{{ $it->product->name }}</td>
    <td>
      <form method="POST" action="{{ route('cart.update', $it) }}">@csrf <input name="quantity" value="{{ $it->quantity }}"><button>Update</button></form>
    </td>
    <td>₹{{ $it->product->price * $it->quantity }}</td>
    <td><form method="POST" action="{{ route('cart.remove', $it) }}">@csrf <button>Remove</button></form></td>
  </tr>
  @php $total += $it->product->price * $it->quantity; @endphp
@endforeach
</table>
<p>Total: ₹{{ $total }}</p>
<a href="{{ route('checkout.index') }}">Checkout</a>
@endif
@endsection
