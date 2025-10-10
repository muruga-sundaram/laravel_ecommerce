@extends('layouts.app')
@section('content')
<h1>Products</h1>
<form method="GET" action="{{ route('home') }}">
  <input name="search" placeholder="Search" value="{{ request('search') }}">
  <select name="sort"><option value="">Newest</option><option value="price_low">Price low→high</option><option value="price_high">Price high→low</option></select>
  <button>Filter</button>
</form>
<div class="grid">
@foreach($products as $p)
  <div class="card">
    <a href="{{ route('product.show', $p) }}"><h3>{{ $p->name }}</h3></a>
    <p>₹{{ $p->price }}</p>
    @if($p->stock < 1) <p><strong>Out of Stock</strong></p> @else
      <form method="POST" action="{{ route('cart.add') }}">@csrf <input type="hidden" name="product_id" value="{{ $p->id }}"><button>Add to Cart</button></form>
      <form method="POST" action="{{ route('wishlist.toggle') }}">@csrf <input type="hidden" name="product_id" value="{{ $p->id }}"><button>Wishlist</button></form>
    @endif
  </div>
@endforeach
</div>
{{ $products->links() }}
@endsection
