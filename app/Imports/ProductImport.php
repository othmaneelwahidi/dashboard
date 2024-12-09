<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
     * Map the row data to a Product model.
     *
     * @param array $row
     * @return \App\Models\Product|null
     */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[0],
            'description' => $row[1],
            'sku' => $row[2],
            'code_barre' => $row[3],
            'prix' => $row[4],
            'qte_min' => $row[5],
            'qte_max' => $row[6],
            'fournisseur' => $row[7],
        ]);
    }
}
