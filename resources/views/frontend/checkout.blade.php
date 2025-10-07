@extends('layout')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h2 class="mb-4">Checkout</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Select Address</label>
            <select name="address_id" class="form-select" required>
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->address_line }}, {{ $address->city }}</option>
                @endforeach
            </select>
        </div>

        <h4 class="mb-3">Order Summary</h4>
        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item->product->name }} x {{ $item->quantity }}
                <span>₹{{ number_format($item->product->price * $item->quantity,2) }}</span>
            </li>
            @php $total += $item->product->price * $item->quantity; @endphp
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                Total <span>₹{{ number_format($total,2) }}</span>
            </li>
        </ul>

        <button class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
