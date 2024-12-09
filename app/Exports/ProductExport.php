<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of products to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all(); // Export all products
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'SKU',
            'Code Barre',
            'Price',
            'Qte Min',
            'Qte Max',
            'Fournisseur',
            'Created At',
            'Updated At',
        ];
    }
}
