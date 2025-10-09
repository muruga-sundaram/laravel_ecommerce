@extends('admin.layout')

@section('title', 'Order Details')

@section('content')
<div class="container">
    <h3>Order #{{ $order->id }}</h3>

    <p><strong>User:</strong> {{ $order->user->name ?? 'Guest' }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>

    <hr>
    <h4>Products</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $item->price }}</td>
                <td>₹{{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <h4>Delivery Address</h4>
    <p>{{ $order->address->full_address ?? 'No address' }}</p>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
