<?php

namespace App\Imports;

use App\Models\Stock;
use App\Models\Product;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Stock([
            'product_id' => Product::where('name', $row['product_name'])->firstOrFail()->id,
            'user_id' => User::where('name', $row['user_name'])->firstOrFail()->id,
            'movement_type' => strtolower($row['movement_type']),
            'quantity' => $row['quantity'],
            'reason' => $row['reason'],
        ]);
    }
}
