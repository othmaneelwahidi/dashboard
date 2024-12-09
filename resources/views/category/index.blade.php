@extends('layouts.navigation')
@section('content')
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
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
h1{
    margin-bottom:5%;
}
        th {
            background-color: #f2f2f2;
        }

        .actions button {
            margin-right: 5px;
        }
        .Categories{
            margin-top:6%;
            margin-left:20%;
        }
    </style>
    <div class="Categories">
    <h1>Categories</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->nom }}</td>
                    <td>{{ $category->parent ? $category->parent->nom : 'None' }}</td>
                    <td class="actions">
                        <a href="{{ route('categories.show', $category->id) }}">
                            <button>View</button>
                        </a>
                        <a href="{{ route('categories.edit', $category->id) }}">
                            <button>Edit</button>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table></div>
@endsection
