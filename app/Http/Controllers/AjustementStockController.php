<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AjustementStock;

class AjustementStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = AjustementStock::with('produit')->get(); // Assuming a relationship with the Produit model
        return response()->json($entries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite_avant' => 'required|integer',
            'quantite_apres' => 'required|integer',
            'raison' => 'required|string|max:255',
            'date_ajustement' => 'required|date',
            'valide' => 'boolean',
        ]);

        $entry = AjustementStock::create($validatedData);

        return response()->json([
            'message' => 'Stock adjustment created successfully.',
            'data' => $entry,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entry = AjustementStock::with('produit')->findOrFail($id);
        return response()->json($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $entry = AjustementStock::findOrFail($id);

        $validatedData = $request->validate([
            'produit_id' => 'sometimes|exists:produits,id',
            'quantite_avant' => 'sometimes|integer',
            'quantite_apres' => 'sometimes|integer',
            'raison' => 'sometimes|string|max:255',
            'date_ajustement' => 'sometimes|date',
            'valide' => 'boolean',
        ]);

        $entry->update($validatedData);

        return response()->json([
            'message' => 'Stock adjustment updated successfully.',
            'data' => $entry,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entry = AjustementStock::findOrFail($id);
        $entry->delete();

        return response()->json([
            'message' => 'Stock adjustment deleted successfully.',
        ]);
    }
}
