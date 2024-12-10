<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalProduct = Product::count();
        $totalCategory = Category::count();
        $totalStock = Stock::count();
        $entryStock = Stock::where('movement_type', 'entry')->count();
        $exitStock = Stock::where('movement_type', 'exit')->count();
        $adjustmentStock = Stock::where('movement_type', 'ajustment')->count();

        $productsPerMonth = Product::selectRaw('DAY(created_at) as day, count(*) as count')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count', 'day');

        $categoriesPerMonth = Category::selectRaw('DAY(created_at) as day, count(*) as count')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count', 'day');

        $stockMovementCounts = Stock::selectRaw('movement_type, count(*) as count')
            ->groupBy('movement_type')
            ->pluck('count', 'movement_type');

        $actions = Action::with('user')->orderBy('created_at', 'desc')->take(3)->get();

        $lowStockProducts = Product::with(['stock' => function ($query) {
            $query->selectRaw('product_id, sum(quantity) as total_stock')  // Sum the stock quantities
                  ->groupBy('product_id');  // Group by product_id
        }])
        ->joinSub(
            Stock::selectRaw('product_id, sum(quantity) as total_stock')  // Select and sum stock quantities
                ->groupBy('product_id'), 'stock_sum', function ($join) {
                    $join->on('product.id', '=', 'stock_sum.product_id')  // Join with product by id
                         ->whereRaw('stock_sum.total_stock < product.qte_min');  // Apply condition on total_stock
                })
        ->get();
        
        
        $lowStockCount = $lowStockProducts->count();

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
            'actions',
            'lowStockCount',
            'lowStockProducts',
        ));
    }

    public function generateReport(Request $request)
    {
        $stockLevels = Stock::with('product')->get();

        $outOfStockProducts = Product::with('stock')
            ->whereHas('stock', function ($query) {
                $query->where('quantity', 0);
            })
            ->get();

        $lowStockProducts = Product::with('stock')
            ->whereHas('stock', function ($query) {
                $query->whereColumn('quantity', '<', 'qte_min');
            })
            ->get();

        $normalStockProducts = Product::with('stock')
            ->whereHas('stock', function ($query) {
                $query->whereColumn('quantity', '>=', 'qte_min')
                    ->whereColumn('quantity', '<=', 'qte_max');
            })
            ->get();

        $entryStockCount = Stock::where('movement_type', 'entry')->count();
        $exitStockCount = Stock::where('movement_type', 'exit')->count();
        $adjustmentStockCount = Stock::where('movement_type', 'ajustment')->count();

        $data = [
            'stockLevels' => $stockLevels,
            'outOfStockProducts' => $outOfStockProducts,
            'lowStockProducts' => $lowStockProducts,
            'normalStockProducts' => $normalStockProducts,
            'entryStockCount' => $entryStockCount,
            'exitStockCount' => $exitStockCount,
            'adjustmentStockCount' => $adjustmentStockCount,
            'date' => now()->toDateString(),
        ];

        $pdf = Pdf::loadView('reports.stock_report', $data);

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
