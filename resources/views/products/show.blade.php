
@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="row">
  <div class="col-md-5">
    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/600x400' }}" class="img-fluid">
  </div>
  <div class="col-md-7">
    <h2>{{ $product->name }}</h2>
    <p class="text-muted">Category: {{ $product->category->name ?? 'N/A' }}</p>
    <h4>₹{{ number_format($product->price,2) }}</h4>
    <p>{{ $product->description }}</p>
    @if($outOfStock)
      <div class="alert alert-danger">Out of Stock</div>
    @else
      <form action="{{ route('cart.add') }}" method="POST">@csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="mb-2"><label>Quantity</label><input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_count }}" class="form-control" style="width:120px;"></div>
        <button class="btn btn-success">Add to Cart</button>
      </form>
    @endif
  </div>
</div>
@endsection
