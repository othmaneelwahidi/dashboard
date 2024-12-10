@extends('layouts.navigation')
@section('content')
    <style>
        .form {
            margin-left: 20%;
            margin-top: 5%;
        }

        /* Form Container */
        .form {
            margin-left: 20%;
            margin-top: 5%;
            padding: 20px;
            border-radius: 10px;
            max-width: 60%;
        }

        /* Heading */
        .form h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        /* Error Messages */
        .form ul {
            list-style-type: none;
            padding: 0;
        }

        .form ul li {
            color: red;
            font-size: 14px;
            margin-bottom: 5px;
        }

        /* Form Elements */
        .form label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #555;
        }

        .form input[type="text"],
        .form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Buttons */
        .form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form button:hover {
            background-color: #0056b3;
        }

        .form a {
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .form a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="form">
        <h1>Edit Category</h1>
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
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
    </div>
@endsection
