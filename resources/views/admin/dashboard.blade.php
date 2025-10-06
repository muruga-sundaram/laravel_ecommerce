@extends('admin.layout')

@section('content')
<h1>Admin Dashboard</h1>
<ul>
    <li>Total Categories: {{ $totalCategories }}</li>
    <li>Total Products: {{ $totalProducts }}</li>
    <li>Total Orders: {{ $totalOrders }}</li>
</ul>
@endsection
