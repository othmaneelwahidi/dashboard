@extends('layouts.navigation')

@section('content')
<style>
    .container{
        margin-left:20%;
        margin-top:5%;
    }
</style>
<div class="container">
    <h1>Add Stock</h1>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="" disabled selected>Select a Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="movement_type" class="form-label">Movement Type</label>
            <select name="movement_type" id="movement_type" class="form-control" required>
                <option value="" disabled selected>Select Movement Type</option>
                <option value="entry">Entry</option>
                <option value="exit">Exit</option>
                <option value="ajustment">Adjustment</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
