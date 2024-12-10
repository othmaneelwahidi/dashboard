@extends('layouts.navigation')
@section('content')
    <style>
        .container {
            margin-top: 5%;
            margin-left: 40%;
        }

        /* General Container Styling */
        .container {
            margin: 5% auto;
            max-width: 60%;
            padding: 20px;

            border-radius: 10px;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Heading Styles */
        .container h1,
        .container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #444;
            text-align: center;
        }

        /* Paragraph Styling */
        .container p {
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* List Styling */
        .container ul {
            list-style: none;
            padding: 0;
        }

        .container ul li {
            padding: 10px;
            background-color: #fff;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Form Styling */
        .container form {
            margin-bottom: 20px;
        }

        .container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Button Styling */
        .container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            width: 100%;
        }

        .container button:hover {
            background-color: #0056b3;
        }

        .container button:active {
            background-color: #003f7f;
        }

        /* Back Link Styling */
        .container a {
            display: inline-block;
            margin-top: 20px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            text-align: center;
        }

        .container a:hover {
            text-decoration: underline;
        }
    </style>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <div class="container">
        <h1>Category: {{ $category->nom }}</h1>
        <p>Parent Category: {{ $category->parent ? $category->parent->nom : 'None' }}</p>

        <h2>Products in this Category</h2>
        <ul>
            @foreach ($category->products as $product)
                <li>{{ $product->name }} (SKU: {{ $product->sku }})</li>
            @endforeach
        </ul>

        <h2>Add Products to Category</h2>
        <form action="{{ route('categories.attach-products', $category->id) }}" method="POST">
            @csrf
            <select name="product_ids[]" multiple>
                @foreach (\App\Models\Product::all() as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <button type="submit">Add Products</button>
        </form>

        <h2>Remove Products from Category</h2>
        <form action="{{ route('categories.detach-products', $category->id) }}" method="POST">
            @csrf
            <select name="product_ids[]" multiple>
                @foreach ($category->products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <button type="submit">Remove Products</button>
        </form>

        <a href="{{ route('categories.index') }}">Back to Categories</a>
    </div>
@endsection
