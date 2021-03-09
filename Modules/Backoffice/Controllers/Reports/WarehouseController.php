<?php

namespace Corvus\Backoffice\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Corvus\Core\Models\Warehouse;
use Corvus\Core\Models\Product;
use Corvus\Core\Models\StockGroup;
use DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function stock()
    {
        $warehouses = Warehouse::all();
        $stock_groups = StockGroup::all();

        $warehouses_json = null;
        foreach ($warehouses as $w) {
            $warehouses_json .= '{ value: "' . $w->id . '", label: "' . $w->name . '"},';
        }

        $stock_groups_json = null;
        foreach ($stock_groups as $w) {
            $stock_groups_json .= '{ value: "' . $w->id . '", label: "' . $w->name . '"},';
        }

        return view('backoffice.reports.warehouse.stocks', compact('warehouses', 'warehouses_json', 'stock_groups_json'));
    }

    public function stock_data()
    {
        $stocks = DB::table('stocks')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('stock_groups', 'stock_groups.id', '=', 'stocks.stock_group_id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->select(
                [
                    'products.id as products.id',
                    'products.sku as products.sku',
                    'products.name as products.name',
                    'stocks.quantity as stocks.quantity',
                    'stock_groups.name as stock_groups.name',
                    'warehouses.name as warehouse.name',
                    'stock_groups.id as stock_groups.id',
                    'warehouses.id as warehouse.id'
                ]

            );

        return datatables()->of($stocks)->toJson();
    }

}
