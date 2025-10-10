@extends('layouts.app')
@section('content')
<h1>Wishlist</h1>
@foreach($items as $it)
  <div>{{ $it->product->name }} - @if($it->product->stock<1) Out of stock @endif</div>
@endforeach
@endsection
