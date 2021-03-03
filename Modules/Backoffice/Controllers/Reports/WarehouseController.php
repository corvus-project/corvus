<?php
namespace Backoffice\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\StockGroup;
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
        foreach($warehouses as $w){
            $warehouses_json .= '{ value: "'. $w->id .'", label: "'. $w->name . '"},'; 
        }

        $stock_groups_json = null;
        foreach($stock_groups as $w){
            $stock_groups_json .= '{ value: "'. $w->id .'", label: "'. $w->name . '"},'; 
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
                    
                        'products.id as pid', 
                        'products.sku as product_sku', 
                        'products.name as product_name', 
                        'stocks.quantity', 'stock_groups.name as stock_group_name', 
                        'warehouses.name as warehouse_name'
                    );

        return datatables()->of($stocks)->toJson();
    }    
 
}