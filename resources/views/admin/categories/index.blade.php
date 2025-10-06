@extends('admin.layout')

@section('content')
<h2>Categories</h2>
<a href="{{ route('admin.categories.create') }}">Add Category</a>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Name</th><th>Actions</th></tr>
@foreach($categories as $category)
<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->name }}</td>
    <td>
        <a href="{{ route('admin.categories.edit',$category->id) }}">Edit</a>
        <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
@endsection
