<?php

namespace App\Exports;

use Corvus\Core\Models\Stock;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StocksExport implements FromQuery
{
    use Exportable;

    public function __construct($warehouse_id, $stock_group_id)
    {
        $this->warehouse_id = $warehouse_id;
        $this->stock_group_id = $stock_group_id;
    }

    public function query()
    {
        $warehouse_id = $this->warehouse_id;
        $stock_group_id = $this->stock_group_id;

        $q = Stock::query()
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('stock_groups', 'stock_groups.id', '=', 'stocks.stock_group_id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->select(
                'products.sku as product_sku',
                'products.name as product_name',
                'stocks.quantity as quantity',
                'warehouses.name as warehouse_name',
                'stock_groups.name as stock_group_name'
                )
            ->where(function ($query) use ($warehouse_id) {
                if ($warehouse_id > 0){
                    $query->where('warehouse_id', $warehouse_id);
                }
            })
            ->where(function ($query) use ($stock_group_id) {
                if ($stock_group_id > 0){
                    $query->where('stock_group_id', $stock_group_id);
                }
            });

        return $q;
    }
}
