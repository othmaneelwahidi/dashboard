<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Stock::with('product', 'user')->get();
    }

    public function headings(): array
    {
        return [
            'Stock ID',
            'Product Name',
            'User Name',
            'Movement Type',
            'Quantity',
            'Reason',
            'Created At',
        ];
    }

    public function map($stock): array
    {
        return [
            $stock->id,
            $stock->product->name ?? 'N/A',
            $stock->user->name ?? 'N/A',
            ucfirst($stock->movement_type),
            $stock->quantity,
            $stock->reason,
            $stock->created_at->now(),
        ];
    }
}
