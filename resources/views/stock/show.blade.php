@extends('layouts.navigation')

@section('content')
<style>
    .container{
        margin-left:20%;
        margin-top:5%;
    }
</style>
<div class="container">
    <h1>Stock Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $stock->id }}</p>
            <p><strong>Product:</strong> {{ $stock->product->name }}</p>
            <p><strong>User:</strong> {{ $stock->user->name }}</p>
            <p><strong>Movement Type:</strong> {{ ucfirst($stock->movement_type) }}</p>
            <p><strong>Quantity:</strong> {{ $stock->quantity }}</p>
            <p><strong>Reason:</strong> {{ $stock->reason }}</p>
            <p><strong>Created At:</strong> {{ $stock->created_at }}</p>
        </div>
    </div>
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
