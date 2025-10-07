@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Cart</h2>

    @if($cartItems->count() > 0)
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>₹{{ number_format($item->product->price,2) }}</td>
                <td>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex gap-1">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm w-50">
                        <button class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
                <td>₹{{ number_format($item->product->price * $item->quantity,2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @php $total += $item->product->price * $item->quantity; @endphp
            @endforeach
            <tr>
                <td colspan="3" class="text-end fw-bold">Total:</td>
                <td colspan="2" class="fw-bold">₹{{ number_format($total,2) }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('checkout.index') }}" class="btn btn-success float-end">Proceed to Checkout</a>
    @else
    <p class="text-center text-muted">Your cart is empty.</p>
    @endif
</div>
@endsection
