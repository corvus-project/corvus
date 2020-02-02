<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StocksExport implements FromQuery
{
    use Exportable;

    public function __construct($warehouse_id, $stock_type_id)
    {
        $this->warehouse_id = $warehouse_id;
        $this->stock_type_id = $stock_type_id;
    }

    public function query()
    {
        $warehouse_id = $this->warehouse_id;
        $stock_type_id = $this->stock_type_id;
        
        $q = Stock::query()
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('stock_types', 'stock_types.id', '=', 'stocks.stock_type_id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')            
            ->select(
                'products.sku as product_sku', 
                'products.name as product_name', 
                'stocks.quantity as quantity',
                'warehouses.name as warehouse_name',
                'stock_types.name as stock_type_name'
                )
            ->where(function ($query) use ($warehouse_id) {
                if ($warehouse_id > 0){
                    $query->where('warehouse_id', $warehouse_id);
                }
            })
            ->where(function ($query) use ($stock_type_id) {
                if ($stock_type_id > 0){
                    $query->where('stock_type_id', $stock_type_id);
                }
            });            

        return $q;
    }
}