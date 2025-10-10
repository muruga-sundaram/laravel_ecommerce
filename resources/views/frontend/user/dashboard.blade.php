@extends('layouts.app')
@section('content')
<h1>Dashboard</h1>
<h2>Orders</h2>
@foreach($orders as $o)
  <div>Order #{{ $o->id }} - ₹{{ $o->total }} - Status: {{ $o->status }}</div>
@endforeach
<h2>Addresses</h2>
@foreach($addresses as $a) <div>{{ $a->label }} - {{ $a->address_line }}</div> @endforeach
@endsection
