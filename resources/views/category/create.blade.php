@extends('layouts.navigation')
@section('content')
    <h1>Create New Category</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="nom">Category Name:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="parent_id">Parent Category:</label>
        <select id="parent_id" name="parent_id">
            <option disabled selected value="">choisir votre categorie</option>
            <option value="">None</option>
            @foreach ($categories as $parent)
                <option value="{{ $parent->id }}">{{ $parent->nom }}</option>
            @endforeach
        </select>

        <button type="submit">Create</button>
    </form>

    <a href="{{ route('categories.index') }}">Back to Categories</a>
@endsection
