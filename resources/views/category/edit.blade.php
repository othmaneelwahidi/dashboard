@extends('layouts.navigation')
@section('content')
<h1>Edit Category</h1>
    
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nom">Category Name:</label>
        <input type="text" id="nom" name="nom" value="{{ $category->nom }}" required>

        <label for="parent_id">Parent Category:</label>
        <select id="parent_id" name="parent_id">
            <option value="">None</option>
            @foreach ($categories as $parent)
                <option value="{{ $parent->id }}" {{ $parent->id === $category->parent_id ? 'selected' : '' }}>
                    {{ $parent->nom }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('categories.index') }}">Back to Categories</a>
@endsection