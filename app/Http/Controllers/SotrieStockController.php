<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SortieStock;

class SortieStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = SortieStock::with('produit')->get(); // Assuming a relationship with the Produit model
        return response()->json($entries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'destination' => 'required|string|max:255',
            'type_usage' => 'required|string|max:255',
            'raison' => 'required|string|max:255',
            'date_sortie' => 'required|date',
            'valide' => 'boolean',
        ]);

        $entry = SortieStock::create($validatedData);

        return response()->json([
            'message' => 'Stock sortie created successfully.',
            'data' => $entry,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entry = SortieStock::with('produit')->findOrFail($id);
        return response()->json($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $entry = SortieStock::findOrFail($id);

        $validatedData = $request->validate([
            'produit_id' => 'sometimes|exists:produits,id',
            'quantite' => 'sometimes|integer|min:1',
            'destination' => 'sometimes|string|max:255',
            'type_usage' => 'sometimes|string|max:255',
            'raison' => 'sometimes|string|max:255',
            'date_sortie' => 'sometimes|date',
            'valide' => 'boolean',
        ]);

        $entry->update($validatedData);

        return response()->json([
            'message' => 'Stock sortie updated successfully.',
            'data' => $entry,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entry = SortieStock::findOrFail($id);
        $entry->delete();

        return response()->json([
            'message' => 'Stock sortie deleted successfully.',
        ]);
    }
}
