@extends('layouts.app')
@section('content')
<h1>Checkout</h1>
<form method="POST" action="{{ route('checkout.place') }}">@csrf
  <label>Select Address</label>
  <select name="address_id">@foreach(Auth::user()->addresses as $a)<option value="{{ $a->id }}">{{ $a->label }} - {{ $a->address_line }}</option>@endforeach</select>
  <button>Place Order (Mock Payment)</button>
</form>
@endsection
