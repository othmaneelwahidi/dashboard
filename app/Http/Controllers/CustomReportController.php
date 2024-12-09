<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Category;
use App\Exports\StockExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CustomReportController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('reports.index', compact('categories'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:pdf,excel,csv',
            'category_id' => 'nullable|exists:category,id',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
            'movement_type' => 'nullable|in:entry,exit,ajustment',
        ]);

        // Build query
        $query = Stock::query();

        // Filter by product category
        if ($request->filled('category_id')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // Filter by movement type
        if ($request->filled('movement_type')) {
            $query->where('movement_type', $request->movement_type);
        }

        // Filter by date range
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $stocks = $query->with('product', 'user')->get();

        // Handle export
        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('reports.stock-pdf', compact('stocks'));
            return $pdf->download('stock-report.pdf');
        } elseif (in_array($request->format, ['excel', 'csv'])) {
            $fileName = 'stock-report.' . $request->format;
            return Excel::download(new StockExport($stocks), $fileName);
        }
    }
}
