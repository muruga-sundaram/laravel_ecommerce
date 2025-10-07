@extends('layout')

@section('title', 'Register')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header bg-dark text-white text-center">
          <h4>Create Account</h4>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Register</button>
          </form>

          <p class="text-center mt-3">
            Already have an account? <a href="{{ route('login') }}">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
