@extends('layouts.navigation')
@section('content')
<style>
    .container {
        margin-top:5%;
        margin-left:40%;
    }
</style>
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
