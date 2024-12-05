<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;  
use Illuminate\Http\Request;

class ProduitController extends Controller
{

    public function showProduits()
    {
       
        $produits = Produit::all();
        
     
        return view('Panel.Listeproduit', compact('produits'));
    }
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
    
        return redirect()->route('produits.Listeproduit')->with('success', '
        Produit deleted successfully');
    }
    
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'sub_category' => 'required|string|max:255|unique:produits,sous_catégorie',
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
        Produit::create([
            'catégorie' => $validated['category'],
            'sous_catégorie' => $validated['sub_category'],
            'nom' => $validated['name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'],
            'code_barre' => $validated['barcode'],
            'prix' => $validated['prix'],
            'quantité_minimale' => $validated['min_quantity'],
            'quantité_maximale' => $validated['max_quantity'],
            'fournisseur' => $validated['supplier'],
        ]);

        // Redirect with success message
        return redirect()->route('dashboard')->with('success', 'Produit créé avec succès');
    }
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
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
        $produit = Produit::findOrFail($id);
    
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

    public function showLineChart()
    {
        // Query to calculate total products per month
        $totalsByMonth = DB::table('products') // Replace 'products' with your table name
            ->select(DB::raw('MONTHNAME(created_at) as month'), DB::raw('SUM(quantity) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
    
        // Extract months (labels) and totals (data)
        $labels = $totalsByMonth->pluck('month')->toArray();
        $data = $totalsByMonth->pluck('total')->toArray();
    
        // Pass variables to the view
        return view('Linechart', compact('labels', 'data')); // Ensure 'Linechart' matches your Blade file name
    }
}
