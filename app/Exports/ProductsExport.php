<?php

namespace App\Exports;

use Corvus\Core\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ProductsExport implements FromQuery
{
    use Exportable;

    public function __construct()
    {
    }

    public function query()
    {
        return Product::query()->select('sku', 'name', 'description');
    }
}
