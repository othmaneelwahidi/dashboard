<!DOCTYPE html>
<html>
<head>
    <title>Rapport des Mouvements de Stock</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Rapport des Mouvements de Stock</h1>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Type de Mouvement</th>
                <th>Quantité</th>
                <th>Raison</th>
                <th>Utilisateur</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->product->name }}</td>
                <td>{{ ucfirst($stock->movement_type) }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->reason }}</td>
                <td>{{ $stock->user->name }}</td>
                <td>{{ $stock->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
