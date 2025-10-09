@extends('admin.layout')

@section('title', 'Orders')

@section('content')
<div class="container">
    <h2>Orders List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>₹{{ number_format($order->total, 2) }}</td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="form-select">
                            <option {{ $order->status == 'On Process' ? 'selected' : '' }}>On Process</option>
                            <option {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </form>
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
