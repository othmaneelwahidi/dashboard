@extends('layouts.navigation')

@section('content')
<style>
    .container {
        margin-top: 5%;
        margin-left: 20%;
    }
</style>
<div class="container">
    <h1>Edit Stock</h1>
    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_name" class="form-label">Product</label>
            <input type="text" id="product_name" class="form-control" value="{{ $product->name }}" disabled>
            <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- Ensure the product ID is submitted -->
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $stock->quantity }}" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control" required>{{ $stock->reason }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
