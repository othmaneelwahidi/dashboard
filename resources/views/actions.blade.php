@extends('layouts.navigation')
@section('content')
<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<style>
    /* Optional: Adjust the borders for a cleaner look */
    .table-bordered {
        border-collapse: collapse;
    }

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

    .container {
        margin-left: 28%;
        margin-top: 5%;
    }
</style>

<div class="container">
    <h1>Action Logs</h1>
    <div class="table">
        <table class="table table-bordered" id="actionTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Administrateur</th>
                    <th>Notification</th>
                    <th>DATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actions as $index => $action)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $action->user->name }}</td>
                        <td class="{{ $action->action }}">
                            {{ ucfirst(str_replace('_', ' ', $action->action)) }}
                        </td>
                        <td>{{ $action->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#actionTable').DataTable({
            paging: true,         // Enable pagination
            searching: true,      // Enable search box
            ordering: true,       // Enable sorting
            info: true,           // Display info like "Showing 1 to 10 of 100"
            lengthMenu: [5, 10, 25, 50], // Items per page options
            language: {
                "sEmptyTable": "Aucune donnée disponible dans le tableau",
                "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                "sInfoEmpty": "Affichage de 0 à 0 sur 0 éléments",
                "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
                "sLengthMenu": "Afficher _MENU_ éléments",
                "sLoadingRecords": "Chargement...",
                "sProcessing": "Traitement...",
                "sSearch": "Rechercher:",
                "sZeroRecords": "Aucun élément correspondant trouvé",
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Précédent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                },
                "oAria": {
                    "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    });
</script>
@endsection
