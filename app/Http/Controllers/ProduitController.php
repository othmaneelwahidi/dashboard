<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    public function index()
    {
       
        $produits = Product::all();
        
     
        return view('product.index', compact('produits'));
    }

    public function create(){
        return view('product.create');
    }

    public function destroy($id)
    {
        $produit = Product::findOrFail($id);
        $produit->delete();
    
        return redirect()->route('produits.Listeproduit')->with('success', '
        Produit deleted successfully');
    }
    
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sku' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'min_quantity' => 'required|numeric',
            'max_quantity' => 'required|numeric',
            'supplier' => 'required|string|max:255',
        ]);

        // Save data
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'],
            'code_barre' => $validated['barcode'],
            'prix' => $validated['prix'],
            'qte_min' => $validated['min_quantity'],
            'qte_max' => $validated['max_quantity'],
            'fournisseur' => $validated['supplier'],
        ]);

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Produit créé avec succès');
    }
    public function edit($id)
    {
        $produit = Product::findOrFail($id);
        return view('Panel.editProduit', compact('produit'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255|unique:produits,sous_catégorie,' . $id,
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sku' => 'required|string|max:255',
            'barcode' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'min_quantity' => 'required|numeric',
            'max_quantity' => 'required|numeric',
            'supplier' => 'required|string|max:255',
        ]);
    
        // Find the product by its ID or fail if not found
        $produit = Product::findOrFail($id);
    
        // Update the product with the validated data
        $produit->catégorie = $validated['category'];
        $produit->sous_catégorie = $validated['sub_category'];
        $produit->nom = $validated['name'];
        $produit->description = $validated['description'];
        $produit->sku = $validated['sku'];
        $produit->code_barre = $validated['barcode'];
        $produit->prix = $validated['prix'];
        $produit->quantité_minimale = $validated['min_quantity'];
        $produit->quantité_maximale = $validated['max_quantity'];
        $produit->fournisseur = $validated['supplier'];
    
        // Save the updated product to the database
        $produit->save();
    
        // Redirect back to the product list with a success message
        return redirect()->route('produits.Listeproduit')->with('success', 'Product updated successfully.');
    }

}
