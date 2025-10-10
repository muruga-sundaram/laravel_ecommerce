
@extends('layouts.app')
@section('title','Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1>Products</h1>
  <form class="d-flex" method="GET">
    <input class="form-control me-2" name="search" placeholder="Search" value="{{ request('search') }}">
    <select class="form-select me-2" name="sort">
      <option value="">Sort</option>
      <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low→High</option>
      <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High→Low</option>
      <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest</option>
    </select>
    <button class="btn btn-primary">Go</button>
  </form>
</div>
<div class="row">
  @foreach($products as $p)
  <div class="col-md-3 mb-4">
    <div class="card h-100">
      <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://via.placeholder.com/400x200' }}" class="card-img-top" alt="{{ $p->name }}">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $p->name }}</h5>
        <p class="mb-1">₹{{ number_format($p->price,2) }}</p>
        <p class="text-muted small">{{ Str::limit($p->description, 80) }}</p>
        <div class="mt-auto">
          <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-outline-primary">View</a>
          @if($p->stock_count > 0)
            <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">@csrf<input type="hidden" name="product_id" value="{{ $p->id }}"><button class="btn btn-sm btn-success">Add to Cart</button></form>
          @else
            <span class="badge bg-danger">Out of Stock</span>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
<div class="d-flex justify-content-center">{{ $products->links() }}</div>
@endsection
