
@extends('layouts.app')
@section('title','Checkout')
@section('content')
<h1>Checkout</h1>
@if($addresses->count())
<form action="{{ route('checkout.placeOrder') }}" method="POST">@csrf @foreach($addresses as $a)<div class="form-check"><input class="form-check-input" type="radio" name="address_id" value="{{ $a->id }}"> <label class="form-check-label">{{ $a->address_line }}, {{ $a->city }}</label></div>@endforeach<button class="btn btn-success mt-3">Place Order</button></form>
@else <p>No saved addresses. <a href="{{ route('addresses.create') }}">Add one</a></p> @endif
@endsection
