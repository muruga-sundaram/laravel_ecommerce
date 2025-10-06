@extends('layout')

@section('content')
<h1>Cart</h1>
@if($cartItems->count() > 0)
    <table border="1" cellpadding="5">
        <tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>Actions</th></tr>
        @php $total = 0; @endphp
        @foreach($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>
                <form action="{{ route('cart.update',$item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>₹{{ $item->product->price }}</td>
            <td>₹{{ $subtotal = $item->product->price * $item->quantity }}</td>
            <td>
                <form action="{{ route('cart.destroy',$item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove</button>
                </form>
            </td>
        </tr>
        @php $total += $subtotal; @endphp
        @endforeach
    </table>
    <h3>Total: ₹{{ $total }}</h3>
    <a href="{{ route('checkout.index') }}">Checkout</a>
@else
    <p>Your cart is empty.</p>
@endif
@endsection
