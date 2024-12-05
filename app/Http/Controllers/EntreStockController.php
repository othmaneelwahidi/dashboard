<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntreStock;

class EntreStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = EntreStock::with('produit')->get(); // Assuming a relationship with a Produit model
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
            'fournisseur' => 'required|string|max:255',
            'date_entre' => 'required|date',
            'valide' => 'boolean',
        ]);

        $entry = EntreStock::create($validatedData);

        return response()->json([
            'message' => 'Stock entry created successfully.',
            'data' => $entry,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $entry = EntreStock::with('produit')->findOrFail($id);
        return response()->json($entry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $entry = EntreStock::findOrFail($id);

        $validatedData = $request->validate([
            'produit_id' => 'sometimes|exists:produits,id',
            'quantite' => 'sometimes|integer|min:1',
            'fournisseur' => 'sometimes|string|max:255',
            'date_entre' => 'sometimes|date',
            'valide' => 'boolean',
        ]);

        $entry->update($validatedData);

        return response()->json([
            'message' => 'Stock entry updated successfully.',
            'data' => $entry,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entry = EntreStock::findOrFail($id);
        $entry->delete();

        return response()->json([
            'message' => 'Stock entry deleted successfully.',
        ]);
    }
}
