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
        $products = Product::all();
        return view('stock.edit', compact('stock', 'products'));
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
            return back()->with('error', 'Stock record not found.');
        }

        // Update the stock record with the validated data
        try {
            $stock->update($validated);
        } catch (\Exception $e) {
            // Log any error during the update process
            Log::error('Error updating stock:', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while updating the stock.');
        }

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
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

        return redirect()->route('stocks.index')->with('success', 'Stock data imported successfully!');
    }
}
