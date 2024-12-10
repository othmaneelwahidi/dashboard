@extends('layouts.navigation')

@section('content')
    <style>
        .container {
            margin-left: 20%;
            margin-top: 5%;
        }
    </style>
    <div class="container">

        <h2>Generate Stock Report</h2>
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        <form action="{{ route('reports.export') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fournisseur">Supplier</label>
                <input type="text" name="fournisseur" id="fournisseur" class="form-control" placeholder="Enter Supplier">
            </div>

            <div class="form-group">
                <label for="date_action">Date</label>
                <input type="date" name="date_action" id="date_action" class="form-control">
            </div>

            <div class="form-group">
                <label for="movement_type">Movement Type</label>
                <select name="movement_type" id="movement_type" class="form-control">
                    <option value="">Select Movement Type</option>
                    <option value="entry">Entry</option>
                    <option value="exit">Exit</option>
                    <option value="ajustment">Adjustment</option>
                </select>
            </div>

            <div class="form-group">
                <label for="format">Export Format</label>
                <select name="format" id="format" class="form-control">
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                    <option value="csv">CSV</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>
@endsection
