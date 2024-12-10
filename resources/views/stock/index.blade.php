@extends('layouts.navigation')
@section('content')
<style>
    /* Make the table smaller */
.table {
    font-size: 0.875rem; /* Smaller font size */
    width: 80%; /* Ensure table takes full width */
    table-layout: fixed; /* Fix the column width */
}

.table th, .table td {
    padding: 0.5rem; /* Reduce padding for smaller cells */
    text-align: center; /* Center text in cells */
}

/* Customize table headers */
.table th {
    font-weight: bold; /* Make headers bold */
}



.btn-sm {
        padding: 0.25rem 0.5rem; /* Adjust button padding */
        font-size: 0.75rem; /* Reduce button font size */
        width: 90px; /* Set a fixed width for buttons */
        margin-top:5px;   }

.container{
    margin-left:24%;
    margin-top:5%;
}
</style>
<div class="container">
    <h1>Stocks</h1>
    <form action="{{ route('stock.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Import Stock Data</label>
            <input type="file" name="file" id="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Import</button>
    </form> 
    <a href="{{ route('stock.export') }}" class="btn btn-primary">Export Stock Data</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>User</th>
                <th>Movement Type</th>
                <th>Quantity</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->user->name }}</td>
                    <td>{{ ucfirst($stock->movement_type) }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->reason }}</td>
                    <td>
                        <a href="{{ route('stocks.show', $stock) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('stocks.edit', $stock) }}" class="btn btn-warning btn-sm">Edit</a>
                        @if(auth()->user()->role->name=='Administateur')
                        <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection