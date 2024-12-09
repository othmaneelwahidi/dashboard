<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'sku' => 'required|string|max:255|unique:product,sku',
            'barcode' => 'required|string|max:255|unique:product,code_barre',  // Ensure barcode is unique
            'prix' => 'required|numeric',
            'min_quantity' => 'required|numeric',
            'max_quantity' => 'required|numeric',
            'supplier' => 'required|string|max:255',
        ]);

        // Check if product already exists by SKU or Barcode
        $existingProduct = Product::where('sku', $validated['sku'])
            ->orWhere('code_barre', $validated['barcode'])
            ->first();

        if ($existingProduct) {
            return redirect()->back()->withErrors('Le produit avec le même SKU ou code barre existe déjà.');
        }

        // Save data if product doesn't exist
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
        $product = Product::findOrFail($id);

        $attribute = Attribute::where('product_id', $id)->get();

        return view('product.edit', compact('product', 'attribute'));
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'code_barre' => 'required|integer',
            'prix' => 'required|numeric|min:0',
            'qte_min' => 'required|integer|min:0',
            'qte_max' => 'required|integer|min:0',
            'fournisseur' => 'required|string|max:255',

            // Attributes validation
            'attribute' => 'array',
            'attribute.*.id' => 'nullable|exists:attribute,id', // Ensure attribute ID exists
            'attribute.*.poids' => 'required|numeric|min:0',
            'attribute.*.dimension' => 'required|numeric|min:0',
            'attribute.*.couleur' => 'required|string|max:255',
            'attribute.*.marque' => 'required|string|max:255',
            'attribute.*.autre' => 'nullable|string|max:255',
        ]);

        // Update the product
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'sku' => $validated['sku'],
            'code_barre' => $validated['code_barre'],
            'prix' => $validated['prix'],
            'qte_min' => $validated['qte_min'],
            'qte_max' => $validated['qte_max'],
            'fournisseur' => $validated['fournisseur'],
        ]);

        // Handle attributes
        if (!empty($validated['attribute'])) {
            foreach ($validated['attribute'] as $attributeData) {
                if (!empty($attributeData['id'])) {
                    $attribute = Attribute::find($attributeData['id']);
                    if ($attribute && $attribute->product_id == $product->id) {
                        $attribute->update([
                            'poids' => $attributeData['poids'],
                            'dimension' => $attributeData['dimension'],
                            'couleur' => $attributeData['couleur'],
                            'marque' => $attributeData['marque'],
                            'autre' => $attributeData['autre'],
                        ]);
                    }
                }
            }
        }

        // Return response
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

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods|max:2048',
        ]);

        // Import the file
        Excel::import(new ProductImport, $request->file('file'));

        return redirect()->route('produits.index')->with('success', 'Products imported successfully.');
    }
}
