@extends('layout')

@section('content')
<h1>Your Orders</h1>
@foreach($orders as $order)
    <div>
        <h3>Order #{{ $order->id }} - {{ $order->status }}</h3>
        <ul>
        @foreach($order->items as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }} = ₹{{ $item->price }}</li>
        @endforeach
        </ul>
        <p>Total: ₹{{ $order->total }}</p>
    </div>
@endforeach
@endsection
