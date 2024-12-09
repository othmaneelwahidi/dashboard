@extends('layouts.navigation')
@section('content')
<style>
      .container {
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove any margin */
            margin-left:20%;
           
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
            background-color: darkgreen;
            transform: scale(1.05);
        }

        .submit-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Styling for the form inputs and labels */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 12px;
        }
    h2, h3 {
        color: #333;
        font-size: 2rem; /* Increased font size for headings */
    }


    .alert {
        margin-bottom: 1.5rem; /* Increased margin */
        padding: 1rem 1.25rem; /* Increased padding */
        border-radius: 0.5rem;
        color: white;
        background-color: #28a745;
        font-size: 1.1rem; /* Increased font size */
    }

    .mb-4 {
        margin-bottom: 1.5rem; /* Increased margin */
    }

    .text-gray-700 {
        color: #4a4a4a;
        font-size: 1.1rem; /* Increased font size */
    }

    .font-bold {
        font-weight: bold;
    }

    input, textarea {
        width: 100%;
        padding: 12px; /* Increased padding */
        border: 1px solid #d1d1d1;
        border-radius: 8px;
        font-size: 1.1rem; /* Increased font size */
        transition: border-color 0.2s ease;
    }

    input:focus, textarea:focus {
        border-color: #4CAF50;
        outline: none;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.75rem; /* Increased margin-bottom */
        display: block;
        font-size: 1.1rem; /* Increased font size for labels */
    }

    .border {
        border: 1px solid #e0e0e0;
    }

    .rounded {
        border-radius: 8px;
    }

    .p-4 {
        padding: 1.5rem; /* Increased padding */
    }

    .text-xl {
        font-size: 1.5rem; /* Increased font size */
    }

    .font-semibold {
        font-weight: 600;
    }

    .mt-4 {
        margin-top: 1.5rem; /* Increased margin-top */
    }

    .mb-2 {
        margin-bottom: 1rem; /* Increased margin-bottom */
    }

    textarea {
        resize: vertical;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .container {
            padding: 2rem; /* Adjusted padding for mobile */
            max-width: 100%;
        }

        .submit-btn {
            width: 100%;
            padding: 16px; /* Adjusted padding */
            font-size: 1.2rem; /* Adjusted font size */
        }
    }
    .submit-btn {
        padding: 12px 24px;
        background-color: green;
        color: white;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .submit-btn:hover {
        background-color: darkgreen;
        transform: scale(1.05);
    }

    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }

    .alert {
        margin-bottom: 1rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        color: white;
        background-color: green;
    }

</style>
<div class="container "><br><br><br>
    <h2 class="text-2xl font-bold mb-4">Edit Product</h2>

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('produits.update', $product->id) }}">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold">Name</label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded" required
                value="{{ old('name', $product->name) }}" />
        </div>

        <!-- Product Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold">Description</label>
            <textarea name="description" id="description" class="w-full px-3 py-2 border rounded" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- SKU -->
        <div class="mb-4">
            <label for="sku" class="block text-gray-700 font-bold">SKU</label>
            <input type="text" name="sku" id="sku" class="w-full px-3 py-2 border rounded" required
                value="{{ old('sku', $product->sku) }}" />
        </div>

        <!-- Barcode -->
        <div class="mb-4">
            <label for="code_barre" class="block text-gray-700 font-bold">Barcode</label>
            <input type="text" name="code_barre" id="code_barre" class="w-full px-3 py-2 border rounded" required
                value="{{ old('code_barre', $product->code_barre) }}" />
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="prix" class="block text-gray-700 font-bold">Price</label>
            <input type="number" step="0.01" name="prix" id="prix" class="w-full px-3 py-2 border rounded" required
                value="{{ old('prix', $product->prix) }}" />
        </div>

        <!-- Minimum Quantity -->
        <div class="mb-4">
            <label for="qte_min" class="block text-gray-700 font-bold">Minimum Quantity</label>
            <input type="number" name="qte_min" id="qte_min" class="w-full px-3 py-2 border rounded" required
                value="{{ old('qte_min', $product->qte_min) }}" />
        </div>

        <!-- Maximum Quantity -->
        <div class="mb-4">
            <label for="qte_max" class="block text-gray-700 font-bold">Maximum Quantity</label>
            <input type="number" name="qte_max" id="qte_max" class="w-full px-3 py-2 border rounded" required
                value="{{ old('qte_max', $product->qte_max) }}" />
        </div>

        <!-- Supplier -->
        <div class="mb-4">
            <label for="fournisseur" class="block text-gray-700 font-bold">Supplier</label>
            <input type="text" name="fournisseur" id="fournisseur" class="w-full px-3 py-2 border rounded" required
                value="{{ old('fournisseur', $product->fournisseur) }}" />
        </div>

        <!-- Attributes Section -->
        <h2 class="text-xl font-semibold mb-4">Attributes</h2>
        @foreach ($attribute as $attr)
            <div class="border p-4 mb-4 rounded">
                <input type="hidden" name="attribute[{{ $attr->id }}][id]" value="{{ $attr->id }}">

                <!-- Weight -->
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold">Weight</label>
                    <input type="number" step="0.01" name="attribute[{{ $attr->id }}][poids]"
                        value="{{ old('attribute.' . $attr->id . '.poids', $attr->poids) }}" 
                        class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- Dimension -->
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold">Dimension</label>
                    <input type="number" step="0.01" name="attribute[{{ $attr->id }}][dimension]"
                        value="{{ old('attribute.' . $attr->id . '.dimension', $attr->dimension) }}" 
                        class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- Color -->
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold">Color</label>
                    <input type="text" name="attribute[{{ $attr->id }}][couleur]"
                        value="{{ old('attribute.' . $attr->id . '.couleur', $attr->couleur) }}" 
                        class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- Brand -->
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold">Brand</label>
                    <input type="text" name="attribute[{{ $attr->id }}][marque]"
                        value="{{ old('attribute.' . $attr->id . '.marque', $attr->marque) }}" 
                        class="w-full px-3 py-2 border rounded" required>
                </div>

                <!-- Other -->
                <div class="mb-2">
                    <label class="block text-gray-700 font-bold">Other</label>
                    <textarea name="attribute[{{ $attr->id }}][autre]" 
                        class="w-full px-3 py-2 border rounded">{{ old('attribute.' . $attr->id . '.autre', $attr->autre) }}</textarea>
                </div>
            </div>
        @endforeach

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="submit-btn">
                Update Product
            </button>
        </div>
    </form>
    <br><br>
</div>
@endsection
