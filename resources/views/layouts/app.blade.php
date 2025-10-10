<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Shop')</title>
  <link rel="stylesheet" href="/assets/app.css">
</head>
<body>
  <nav>
    <a href="{{ route('home') }}">Home</a>
    @auth
      | <a href="{{ route('cart.index') }}">Cart</a>
      | <a href="{{ route('wishlist.index') }}">Wishlist</a>
      | <a href="{{ route('user.dashboard') }}">Dashboard</a>
      <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf <button>Logout</button></form>
    @else
      | <a href="{{ route('login') }}">Login</a> | <a href="{{ route('register') }}">Register</a>
    @endauth
  </nav>
  <div class="container">@if(session('success'))<div class="alert">{{ session('success') }}</div>@endif @if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif @yield('content')</div>
</body>
</html>
