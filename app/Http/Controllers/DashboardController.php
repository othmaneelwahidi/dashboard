<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalProduct = Product::count();
        $totalCategory = Category::count();
        $totalStock = Category::count();
        $entryStock = Stock::where('movement_type', 'entry')->count();
        $exitStock = Stock::where('movement_type', 'exit')->count();
        $adjustmentStock = Stock::where('movement_type', 'ajustment')->count();

        $productsPerMonth = Product::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $categoriesPerMonth = Category::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $stockMovementCounts = Stock::selectRaw('movement_type, count(*) as count')
            ->groupBy('movement_type')
            ->pluck('count', 'movement_type');

        $actions = Action::with('user')->orderBy('created_at', 'desc')->take(3)->get();

        return view('dashboard', compact(
            'totalUser',
            'totalProduct',
            'totalCategory',
            'entryStock',
            'exitStock',
            'adjustmentStock',
            'productsPerMonth',
            'categoriesPerMonth',
            'stockMovementCounts',
            'totalStock',
            'actions'
        ));
    }

    public function generateReport(Request $request)
    {
        // Fetch all stock movements with related product details
        $stockLevels = Stock::with('product')->get(); // Get all stock movements with product details

        // Get products that are out of stock (quantity = 0 in stock)
        $outOfStockProducts = Product::join('stock', 'product.id', '=', 'stock.product_id')
            ->where('stock.quantity', 0)
            ->get();

        // Get low stock products (quantity < qte_min)
        $lowStockProducts = Product::join('stock', 'product.id', '=', 'stock.product_id')
            ->whereColumn('stock.quantity', '<', 'product.qte_min')
            ->get();

        // Get products where quantity is between qte_min and qte_max (inclusive)
        $normalStockProducts = Product::join('stock', 'product.id', '=', 'stock.product_id')
            ->whereColumn('stock.quantity', '>=', 'product.qte_min')
            ->whereColumn('stock.quantity', '<=', 'product.qte_max')
            ->get();

        // Get stock movement counts for different types
        $entryStockCount = Stock::where('movement_type', 'entry')->count();
        $exitStockCount = Stock::where('movement_type', 'exit')->count();
        $adjustmentStockCount = Stock::where('movement_type', 'ajustment')->count();

        // Prepare data for the report
        $data = [
            'stockLevels' => $stockLevels,
            'outOfStockProducts' => $outOfStockProducts,
            'lowStockProducts' => $lowStockProducts,
            'normalStockProducts' => $normalStockProducts,
            'entryStockCount' => $entryStockCount,
            'exitStockCount' => $exitStockCount,
            'adjustmentStockCount' => $adjustmentStockCount,
            'date' => now()->toDateString(), // Current date
        ];

        // Load a Blade view to generate the PDF
        $pdf = Pdf::loadView('reports.stock_report', $data);

        // Return the generated PDF to the browser
        return $pdf->download('global_report.pdf');
    }

    public function showActions()
    {
        // Fetch all actions with user relationships
        $actions = Action::with('user')->orderBy('created_at', 'desc')->get();

        // Pass actions to the view
        return view('actions', compact('actions'));
    }
}
