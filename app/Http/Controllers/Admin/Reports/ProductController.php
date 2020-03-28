<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\StockGroup;
use App\Models\User;
use DB;

class ProductController extends Controller
{ 
    public function orders()
    {
        return view('admin.reports.product.list');
    }

    public function order_data()
    {
        $orders = DB::table('order_headers')
            ->leftJoin('users', 'users.id', '=', 'order_headers.user_id')
            ->select(
                'order_headers.id as order_header_id', 
                'order_headers.order_date as order_date', 
                'order_headers.processed_date', 
                'order_headers.amount as order_amount', 
                'order_headers.status as order_status', 
                'users.name as customer_name'
            );

        return datatables()->of($orders)->toJson();
    }    

}
