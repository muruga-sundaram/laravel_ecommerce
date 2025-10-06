<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin.categories.index') }}">Categories</a> |
        <a href="{{ route('admin.products.index') }}">Products</a> |
        <a href="{{ route('admin.orders.index') }}">Orders</a> |
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    <div class="container">
        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif
        @yield('content')
    </div>
</body>
</html>
