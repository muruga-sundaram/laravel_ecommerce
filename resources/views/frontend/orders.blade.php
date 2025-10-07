@extends('layout')

@section('title', 'My Orders')

@section('content')
<div class="container">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->count() > 0)
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Products</th>
                <th>Total</th>
                <th>Address</th>
                <th>Status</th>
                <th>Placed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key => $order)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    @foreach($order->orderItems as $item)
                        {{ $item->product->name }} x {{ $item->quantity }}<br>
                    @endforeach
                </td>
                <td>₹{{ number_format($order->total_amount,2) }}</td>
                <td>{{ $order->address->address_line ?? '' }}, {{ $order->address->city ?? '' }}</td>
                <td>
                    @if($order->status == 'On Process')
                        <span class="badge bg-primary">{{ $order->status }}</span>
                    @elseif($order->status == 'Shipped')
                        <span class="badge bg-warning">{{ $order->status }}</span>
                    @elseif($order->status == 'Delivered')
                        <span class="badge bg-success">{{ $order->status }}</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center text-muted">You have not placed any orders yet.</p>
    @endif
</div>
@endsection
