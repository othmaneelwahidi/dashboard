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
