@extends('layouts.navigation')
@section('content')
<style>
    form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
}

/* Heading style */
h1 {
    text-align: center;
    color: #333;
}

/* Error message styling */
ul {
    list-style-type: none;
    padding-left: 0;
    color: red;
}

ul li {
    font-size: 0.9rem;
    margin-bottom: 5px;
}

/* Label styling */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #333;
}

/* Input and select box styling */
input[type="text"],
select {
    width: 100%;
    padding: 10px;
    margin: 8px 0 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
}

/* Button styling */
button {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
    text-align: center;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

/* Back link styling */
a {
    display: inline-block;
    margin-top: 15px;
    text-align: center;
    color: #007bff;
    text-decoration: none;
    font-size: 1rem;
}

a:hover {
    text-decoration: underline;
}
</style>
<br><br><br><br>
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
