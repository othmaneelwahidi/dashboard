<?php

namespace App\Http\Controllers;

use App\Exports\StockExport;
use App\Imports\StockImport;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with(['product', 'user'])->get(); // Load related data
        return view('stock.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'movement_type' => 'required|in:entry,exit,ajustment', // Validate enum values
            'quantity' => 'required|integer|min:0', // Ensure positive quantities
            'reason' => 'nullable|string|max:255', // Optional, with max length
        ]);

        // Add the authenticated user's ID
        $validated['user_id'] = Auth::id();

        // Get the product based on product_id
        $product = Product::findOrFail($validated['product_id']);

        // Handle stock movement based on the movement type
        if ($validated['movement_type'] == 'entry') {
            $product->stock += $validated['quantity'];  // Add to stock
        } elseif ($validated['movement_type'] == 'exit') {
            $product->stock -= $validated['quantity'];  // Subtract from stock
        } elseif ($validated['movement_type'] == 'ajustment') {
            $product->stock = $validated['quantity'];  // Set stock to the new quantity
        }

        // Save the updated product stock
        $product->save();

        // Create the stock movement record
        Stock::create($validated);

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $stock->load(['product', 'user']);
        return view('stock.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $product = Product::findOrFail($stock->product_id); // Get the associated product
        return view('stock.edit', compact('stock', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'product_id' => 'sometimes|exists:product,id',
            'movement_type' => 'sometimes|in:entry,exit,ajustment',
            'quantity' => 'sometimes|integer|min:0', // Ensure quantity is non-negative
            'reason' => 'nullable|string|max:255',
        ]);

        // Check if the stock record is found
        if (!$stock) {
            return back()->with('error', 'Enregistrement de stock non trouvé.');
        }

        // Get the associated product
        $product = Product::findOrFail($stock->product_id);

        // Handle stock movement based on the movement type
        if (isset($validated['movement_type'])) {
            if ($validated['movement_type'] == 'entry') {
                $product->stock += $validated['quantity'];  // Add to stock
            } elseif ($validated['movement_type'] == 'exit') {
                $product->stock -= $validated['quantity'];  // Subtract from stock
            } elseif ($validated['movement_type'] == 'ajustment') {
                $product->stock = $validated['quantity'];  // Set stock to the new quantity
            }
        }

        // Save the updated product stock
        $product->save();

        // Update the stock record with the validated data
        try {
            $stock->update($validated);
        } catch (\Exception $e) {
            // Log any error during the update process
            Log::error('Error updating stock:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour du stock.');
        }

        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        // Get the associated product
        $product = Product::findOrFail($stock->product_id);

        // Revert stock changes based on the movement type before deleting
        if ($stock->movement_type == 'entry') {
            $product->stock -= $stock->quantity;  // Remove the quantity from stock
        } elseif ($stock->movement_type == 'exit') {
            $product->stock += $stock->quantity;  // Add the quantity back to stock
        } elseif ($stock->movement_type == 'ajustment') {
            // For adjustment, we can either leave the stock as is or reset it
            $product->stock = 0;  // This is an example, depending on business logic
        }

        // Save the updated product stock
        $product->save();

        // Delete the stock record
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock supprimé avec succès.');
    }

    public function export()
    {
        return Excel::download(new StockExport, 'stock_data.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new StockImport, $request->file('file'));

        return redirect()->route('stocks.index')->with('success', 'Données de stock importées avec succès !');
    }
}
