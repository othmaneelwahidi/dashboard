<x-app-layout>
    <style>
        .container {
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            margin-top: -45%;
        }

        .submit-btn {
            margin-left: 45%;
            padding: 12px 24px;
            background-color: green;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .submit-btn:hover {
            background-color: green;
            transform: scale(1.05);
        }

        .submit-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('produits.update', $produit->id) }}">
            @csrf
            @method('PUT')
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('nom', $produit->nom) }}"
                />
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea
                    name="description"
                    id="description"
                    class="w-full px-3 py-2 border rounded"
                    required
                >{{ old('description', $produit->description) }}</textarea>
            </div>

            <!-- SKU -->
            <div class="mb-4">
                <label for="sku" class="block text-gray-700">SKU</label>
                <input
                    type="text"
                    name="sku"
                    id="sku"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('sku', $produit->sku) }}"
                />
            </div>

            <!-- Barcode -->
            <div class="mb-4">
                <label for="barcode" class="block text-gray-700">Barcode</label>
                <input
                    type="text"
                    name="barcode"
                    id="barcode"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('code_barre', $produit->code_barre) }}"
                />
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="prix" class="block text-gray-700">Price</label>
                <input
                    type="number"
                    step="0.01"
                    name="prix"
                    id="prix"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('prix', $produit->prix) }}"
                />
            </div>

            <!-- Min Quantity -->
            <div class="mb-4">
                <label for="min_quantity" class="block text-gray-700">Minimum Quantity</label>
                <input
                    type="number"
                    name="min_quantity"
                    id="min_quantity"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('quantité_minimale', $produit->quantité_minimale) }}"
                />
            </div>

            <!-- Max Quantity -->
            <div class="mb-4">
                <label for="max_quantity" class="block text-gray-700">Maximum Quantity</label>
                <input
                    type="number"
                    name="max_quantity"
                    id="max_quantity"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('quantité_maximale', $produit->quantité_maximale) }}"
                />
            </div>

            <!-- Supplier -->
            <div class="mb-4">
                <label for="supplier" class="block text-gray-700">Supplier</label>
                <input
                    type="text"
                    name="supplier"
                    id="supplier"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('fournisseur', $produit->fournisseur) }}"
                />
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="submit-btn">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
