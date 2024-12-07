@extends('layouts.navigation')
@extends('layouts.navbar')
@section('content')
<style>
    .Liste{
        margin-left:20%;
    }
</style>
<div class="Liste">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Product Details</h1>

        {{-- Display Product Details --}}
        <div class="bg-white shadow-md rounded p-4 mb-6">
            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-700">Price: ${{ number_format($product->price, 2) }}</p>
            <p class="text-gray-700">Description: {{ $product->description }}</p>
        </div>

        {{-- Display Product Attributes --}}
        <h2 class="text-lg font-semibold mb-2">Attributes</h2>
        @if($attributes->isEmpty())
            <p class="text-gray-500">No attributes available for this product.</p>
        @else
            <table class="table-auto border-collapse border border-gray-300 w-full text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Poids</th>
                        <th class="border border-gray-300 px-4 py-2">Dimension</th>
                        <th class="border border-gray-300 px-4 py-2">Couleur</th>
                        <th class="border border-gray-300 px-4 py-2">Marque</th>
                        <th class="border border-gray-300 px-4 py-2">Autre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->poids }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->dimension }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->couleur }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->marque }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->autre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Back Button --}}
        <a href="{{ route('produits.index') }}" class="text-blue-600 mt-4 inline-block">← Back to Products</a>
        <a href="{{ route('produits.edit', $product->id) }}" class="text-green-600 mt-4 inline-block">Modifier Product</a>
    </div></div>
@endsection