@extends('admin.layout')
@section('title', 'Categories')

@section('content')
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $key => $category)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" class="text-center">No categories found</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
