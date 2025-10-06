@extends('admin.layout')

@section('content')
<h2>Edit Category</h2>
<form action="{{ route('admin.categories.update',$category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $category->name }}" required>
    <button type="submit">Update</button>
</form>
@endsection
