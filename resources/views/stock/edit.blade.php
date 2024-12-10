@extends('layouts.navigation')

@section('content')
<style>
    .container{
        margin-top:5%;
        margin-left:20%;
    }
</style>
<div class="container">
    <h1>Edit Stock</h1>
    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                </select>

            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $stock->quantity }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <textarea name="reason" id="reason" class="form-control">{{ $stock->reason }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
