@extends('layout')

@section('content')
<h1>Checkout</h1>
<form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <h3>Select Address</h3>
    @foreach($addresses as $addr)
        <input type="radio" name="address_id" value="{{ $addr->id }}" required>
        {{ $addr->name }} - {{ $addr->address }}, {{ $addr->city }} <br>
    @endforeach
    <h3>Cart Summary</h3>
    <ul>
    @php $total=0; @endphp
    @foreach($cartItems as $item)
        <li>{{ $item->product->name }} x {{ $item->quantity }} = ₹{{ $subtotal = $item->quantity*$item->product->price }}</li>
        @php $total+=$subtotal; @endphp
    @endforeach
    </ul>
    <h3>Total: ₹{{ $total }}</h3>
    <button type="submit">Place Order</button>
</form>
@endsection
