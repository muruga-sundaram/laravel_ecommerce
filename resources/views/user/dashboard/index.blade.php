
@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<h1>Your Orders</h1>
@if($orders->count())<table class="table"><thead><tr><th>ID</th><th>Total</th><th>Status</th><th>Action</th></tr></thead><tbody>@foreach($orders as $o)<tr><td>{{ $o->id }}</td><td>₹{{ $o->total }}</td><td>{{ $o->status }}</td><td><a class="btn btn-sm btn-info" href="{{ route('user.orders.show', $o->id) }}">View</a></td></tr>@endforeach</tbody></table>@else <p>No orders yet.</p> @endif @endsection