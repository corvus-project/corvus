<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Csv;
use App\Models\PricingGroup;
use App\Models\Warehouse;
use App\Models\StockType;
use App\Models\User;
use DB;
use App\Exports\ProductsExport;
use App\Exports\PricesExport;
use App\Exports\StocksExport;
use App\Exports\OrdersExport;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_types = StockType::all()->pluck('name', 'id');

        $customers = User::query()->whereHas('roles', function($q) {
            $q->where('name', 'customer');
        })->get()->pluck('name', 'id');

        $pricing_groups->put(0, 'Select');
        $pricing_groups = $pricing_groups->reverse();

        $stock_types->put(0, 'Select');
        $stock_types = $stock_types->reverse();

        $customers->put(0, 'Select');
        $customers = $customers->reverse();

        $warehouses->put(0, 'Select');
        $warehouses = $warehouses->reverse();

        return view('admin.tools.export', compact('pricing_groups', 'warehouses', 'stock_types', 'customers'));
    }

    public function product_list(){
        return (new ProductsExport())->download('products.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function price_list(Request $request){
        $date_selection = $request->date_selection;
        $pricing_group_id = $request->pricing_group_id;
        return (new PricesExport($date_selection, $pricing_group_id))->download('prices.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function stock_list(Request $request){
        $warehouse_id = $request->warehouse_id;
        $stock_type_id = $request->stock_type_id;
        return (new StocksExport($warehouse_id, $stock_type_id))->download('stocks.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function order_list(Request $request){
        $customer_id = $request->customer_id;
        $process_date = $request->process_date;
        $order_date = $request->order_date;
        return (new OrdersExport($customer_id, $process_date, $order_date))->download('orders.csv', \Maatwebsite\Excel\Excel::CSV);
    }


}
