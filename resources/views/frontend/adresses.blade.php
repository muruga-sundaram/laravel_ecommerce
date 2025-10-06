@extends('layout')

@section('content')
<h1>Saved Addresses</h1>

<h3>Add New Address</h3>
<form action="{{ route('user.address.add') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="text" name="address" placeholder="Address" required><br>
    <input type="text" name="city" placeholder="City" required><br>
    <button type="submit">Add</button>
</form>

<h3>Existing Addresses</h3>
@foreach($addresses as $addr)
    <form action="{{ route('user.address.edit',$addr->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $addr->name }}" required>
        <input type="text" name="address" value="{{ $addr->address }}" required>
        <input type="text" name="city" value="{{ $addr->city }}" required>
        <button type="submit">Update</button>
    </form>
    <form action="{{ route('user.address.delete',$addr->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    <hr>
@endforeach
@endsection
