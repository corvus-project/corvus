<?php

namespace Modules\Report\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\StockType;
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
        $stock_types = StockType::all();

        $warehouses_json = null;
        foreach($warehouses as $w){
            $warehouses_json .= '{ value: "'. $w->id .'", label: "'. $w->name . '"},'; 
        }

        $stock_types_json = null;
        foreach($stock_types as $w){
            $stock_types_json .= '{ value: "'. $w->id .'", label: "'. $w->name . '"},'; 
        }


        return view('report::warehouse.list', compact('warehouses', 'warehouses_json', 'stock_types_json'));
    }
 
    public function stock_data()
    {
        $stocks = DB::table('stocks')
            ->join('products', 'products.id', '=', 'stocks.product_id')
            ->join('stock_types', 'stock_types.id', '=', 'stocks.stock_type_id')
            ->join('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->select(
                    
                        'products.id as pid', 
                        'products.sku as product_sku', 
                        'products.name as product_name', 
                        'stocks.quantity', 'stock_types.name as stock_type_name', 
                        'warehouses.name as warehouse_name'
                    );

        return datatables()->of($stocks)->toJson();
    }    
}
