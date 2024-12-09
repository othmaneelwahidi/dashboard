<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::with('children', 'parent')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $categories = Category::all(); 
        return view('category.create', compact('categories')); 
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:category,id',
        ]);

        // Create the new category
        $category = Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        
        $category = Category::with('children', 'parent', 'products')->findOrFail($id);
        return view('category.show', compact('category')); 
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all(); 
        return view('category.edit', compact('category', 'categories')); 
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:category,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

    /**
     * Add products to the specified category.
     */
    public function attachProducts(Request $request, $id)
    {
        $validated = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:product,id',
        ]);

        $category = Category::findOrFail($id);
        $category->products()->syncWithoutDetaching($validated['product_ids']);

        return redirect()->route('categories.show', $id)->with('success', 'Products added to category successfully!');
    }

    /**
     * Remove products from the specified category.
     */
    public function detachProducts(Request $request, $id)
    {
        $validated = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:product,id',
        ]);

        $category = Category::findOrFail($id);
        $category->products()->detach($validated['product_ids']);

        return redirect()->route('categories.show', $id)->with('success', 'Products removed from category successfully!');
    }
}
