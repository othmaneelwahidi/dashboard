@extends('layouts.navigation')

@section('content')
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            max-width:90%;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h1 {
            margin-bottom: 5%;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions button {
            margin-right: 5px;
        }

        .Categories {
            margin-top: 6%;
            margin-left: 18%;
        }

        /* Move the search bar to the left */
        .dataTables_filter {
            margin-left: -20px; /* Adjust this value as needed */
        }

        /* General Button Styles */
        button {
            background-color: #007bff; /* Default blue */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.95);
        }

        /* Edit Button Styles */
        button.edit {
            background-color: #ffc107; /* Yellow */
            color: #212529; /* Dark text for contrast */
        }

        button.edit:hover {
            background-color: #e0a800; /* Darker yellow */
        }

        button.edit:active {
            background-color: #c69500; /* Even darker yellow */
        }

        /* Delete Button Styles */
        button.delete {
            background-color: #dc3545; /* Red */
            color: #fff;
        }

        button.delete:hover {
            background-color: #a71d2a; /* Darker red */
        }

        button.delete:active {
            background-color: #6d101c; /* Even darker red */
        }

        /* Submit Button Styles */
        button.submit {
            background-color: #28a745; /* Green */
            color: #fff;
        }

        button.submit:hover {
            background-color: #218838; /* Darker green */
        }

        button.submit:active {
            background-color: #1e7e34; /* Even darker green */
        }
    </style>

    <div class="Categories">
        <h1>Categories</h1>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <table id="categoriesTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->nom }}</td>
                        <td>{{ $category->parent ? $category->parent->nom : '---' }}</td>
                        <td class="actions">
                            <a href="{{ route('categories.show', $category->id) }}">
                                <button>View</button>
                            </a>
                            @if(auth()->user()->role->name == 'Administrateur')
                                <a href="{{ route('categories.edit', $category->id) }}">
                                    <button class="edit">Edit</button>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [10, 25, 50, 100]
            });
        });
    </script>
@endsection
