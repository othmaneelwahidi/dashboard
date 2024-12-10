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
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="movement_type" class="form-label">Movement Type</label>
            <select name="movement_type" id="movement_type" class="form-control" required>
                <option value="entry" {{ $stock->movement_type == 'entry' ? 'selected' : '' }}>Entry</option>
                <option value="exit" {{ $stock->movement_type == 'exit' ? 'selected' : '' }}>Exit</option>
                <option value="adjustment" {{ $stock->movement_type == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $stock->quantity }}" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control">{{ $stock->reason }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
