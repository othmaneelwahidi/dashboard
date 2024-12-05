<x-app-layout>
    <style>
        /* Centering the container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove any margin */
            margin-top: -55%;
        }

        .table-container {
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>

<div class="container mx-auto p-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-bold mb-4">Liste des Produits</h2>

        <div class="table-container">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200 text-gray-600">
                    <tr>
                        <th class="py-2 px-4 border-b">Catégorie</th>
                        <th class="py-2 px-4 border-b">Sous-Catégorie</th>
                        <th class="py-2 px-4 border-b">Nom</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">SKU</th>
                        <th class="py-2 px-4 border-b">Code-Barre</th>
                        <th class="py-2 px-4 border-b">Prix</th>
                        <th class="py-2 px-4 border-b">Quantité Minimale</th>
                        <th class="py-2 px-4 border-b">Quantité Maximale</th>
                        <th class="py-2 px-4 border-b">Fournisseur</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $produit->catégorie }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->sous_catégorie }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->nom }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->sku }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->code_barre }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->prix }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->quantité_minimale }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->quantité_maximale }}</td>
                            <td class="py-2 px-4 border-b">{{ $produit->fournisseur }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('produits.edit', $produit->id) }}">
                                    <button class="text-blue-600">Edit</button>
                                </a>
                                <br>
                                <form action="{{route('produit.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
