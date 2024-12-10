<x-app-layout>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;



        }

        .containerr {
            margin-top: -50%;
            overflow-y: hidden;
            overflow-x: hidden;
            margin-left: -4%;
        }

        .table-container {
            overflow-x: auto;
            white-space: nowrap;

        }

        /* Adjusting table and cell size */
        table {
            width: 50%;
            /* Smaller table width */
            margin: 0 auto;
            /* Center the table */
            border-collapse: collapse;
            /* Remove gaps between cells */
            font-size: 12px;
            /* Reduce font size */
        }

        th,
        td {
            padding: 4px 8px;
            /* Smaller padding for compact cells */
            text-align: left;
            border: 1px solid #ccc;
            /* Add border for clarity */
        }

        th {
            background-color: #f2f2f2;
            /* Light header background */
            font-weight: bold;
        }

        tr {
            height: auto;
            /* Adjust height based on content */
        }

        #form {

            margin-left: 30%;
        }
    </style>
    <div class="containerr">
        <div class="container ">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <h2 class="text-xl font-bold mb-4">Liste des Produits</h2>
            <a href="{{ route('products.export') }}" class="btn btn-success">Export Products</a>
            <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Import Products (Excel/CSV)</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>            
            <div class="table-container" id="form">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-200 text-gray-600">
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
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
                        @foreach ($produits as $index => $produit)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->description }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->sku }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->code_barre }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->prix }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->qte_min }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->qte_max }}</td>
                                <td class="py-2 px-4 border-b">{{ $produit->fournisseur }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('produits.show', $produit->id) }}">
                                        <button class="text-blue-600">Détails</button>
                                    </a>
                                    <br>
                                    @if(auth()->user()->role->name=='Administrateur')
                                        <form action="{{ route('produit.destroy', $produit->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Supprimer</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('index.attribute', $produit->id) }}">
                                        <button class="text-green-600">Attributs</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
