<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce Site</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a> |
        <a href="{{ route('cart.index') }}">Cart</a> |
        <a href="{{ route('wishlist.index') }}">Wishlist</a> |
        @auth
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login.form') }}">Login</a> |
            <a href="{{ route('register.form') }}">Register</a>
        @endauth
    </nav>
    <hr>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
