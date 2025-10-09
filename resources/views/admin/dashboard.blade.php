@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Categories</h5>
                <p class="display-6">{{ $totalCategories ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Products</h5>
                <p class="display-6">{{ $products_count ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <p class="display-6">{{ $orders_count ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
