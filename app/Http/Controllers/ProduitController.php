<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
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

    public function create()
    {
        return view('product.create');
    }

    public function destroy($id)
    {
        $produit = Product::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit deleted successfully');
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
        return redirect()->route('produits.index')->with('success', 'Produit créé avec succès');
    }
    public function edit($id)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($id);

        // Fetch the attributes associated with this product
        $attributes = Attribute::where('product_id', $id)->get();

        // Pass product and attributes to the edit view
        return view('product.edit', compact('product', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'attributes' => 'array',
            'attributes.*.poids' => 'required|integer',
            'attributes.*.dimension' => 'required|integer',
            'attributes.*.couleur' => 'required|string|max:255',
            'attributes.*.marque' => 'required|string|max:255',
            'attributes.*.autre' => 'nullable|string|max:255',
        ]);

        // Update the product
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
        ]);

        // Update attributes
        if (!empty($validated['attributes'])) {
            foreach ($validated['attributes'] as $attributeId => $attributeData) {
                $attribute = Attribute::find($attributeId);
                if ($attribute && $attribute->product_id == $id) {
                    $attribute->update($attributeData);
                }
            }
        }

        return redirect()
            ->route('produits.index')
            ->with('success', 'Product and attributes updated successfully!');
    }

    public function indexAttribute($id)
    {
        $product = Product::findOrFail($id);
        return view('product.attribute', compact('product'));
    }

    public function storeAttribute(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'poids' => 'required|integer',
            'dimension' => 'required|integer',
            'couleur' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'autre' => 'nullable|string|max:255', // Allow 'autre' to be null
        ]);

        // Check if the product already has an attribute
        $existingAttribute = Attribute::where('product_id', $id)->first();

        if ($existingAttribute) {
            // Redirect back with an error message
            return redirect()
                ->route('produits.index')
                ->with('error', 'This product already has an attribute.');
        }

        // Save the attribute to the database
        Attribute::create([
            'product_id' => $id, // Use $id directly since it's the route parameter
            'poids' => $validated['poids'],
            'dimension' => $validated['dimension'],
            'couleur' => $validated['couleur'],
            'marque' => $validated['marque'],
            'autre' => $validated['autre'],
        ]);

        // Redirect back with success message
        return redirect()
            ->route('produits.index')
            ->with('success', 'Attribute added successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $attributes = Attribute::where('product_id', $id)->get();
        return view('product.show', compact('product', 'attributes'));
    }
}
