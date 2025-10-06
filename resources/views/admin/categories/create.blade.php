@extends('admin.layout')

@section('content')
<h2>Add Category</h2>
<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Save</button>
</form>
@endsection
