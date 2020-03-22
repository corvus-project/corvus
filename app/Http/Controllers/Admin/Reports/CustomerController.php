<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\StockType;
use App\Models\User;
use App\Models\OrderStatus;
use DB;

class CustomerController extends Controller
{ 
    public function orders()
    {
        $customers = User::query()->whereHas('roles', function($q) {
            $q->where('name', 'vendor');
        })->get();

        $customers_json = null;
        foreach($customers as $w){
            $customers_json .= '{ value: "'. $w->id .'", label: "'. $w->name . '"},'; 
        }

        $status_list = OrderStatus::all();
        $status_json = null;
        foreach($status_list as $status){
            $status_json .= '{ value: "'. $status->id .'", label: "'. $status->name . '"},'; 
        }
        
        return view('admin.reports.customer.orders', compact('customers_json', 'status_json'));
    }

    public function order_data()
    {
        $orders = DB::table('order_headers')
            ->leftJoin('users', 'users.id', '=', 'order_headers.user_id')
            ->leftJoin('order_status', 'order_status.id', '=', 'order_headers.status')
            ->select(
                'order_headers.id as order_header_id', 
                'order_headers.order_date as order_date', 
                'order_headers.processed_date as processed_date', 
                'order_headers.amount as order_amount', 
                'order_status.name as order_status_name', 
                'users.name as customer_name',
                'order_headers.status as order_status_id'
            );

        return datatables()->of($orders)->toJson();
    }    

}
