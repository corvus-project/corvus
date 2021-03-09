<?php

namespace Corvus\Backoffice\Controllers\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Corvus\Core\Models\Warehouse;
use Corvus\Core\Models\Product;
use Corvus\Core\Models\StockGroup;
use Corvus\Core\Models\User;
use Corvus\Core\Models\OrderStatus;
use DB;

class CustomerController extends Controller
{
    public function orders()
    {
        $customers = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'vendor');
        })->get();

        $customers_json = null;
        foreach ($customers as $w) {
            $customers_json .= '{ value: "' . $w->id . '", label: "' . $w->name . '"},';
        }

        $status_list = OrderStatus::all();
        $status_json = null;
        foreach ($status_list as $status) {
            $status_json .= '{ value: "' . $status->id . '", label: "' . $status->name . '"},';
        }

        return view('backoffice.reports.customer.orders', compact('customers_json', 'status_json'));
    }

    public function order_data()
    {
        $orders = DB::table('order_headers')
            ->leftJoin('users', 'users.id', '=', 'order_headers.user_id')
            ->leftJoin('order_status', 'order_status.id', '=', 'order_headers.status')
            ->select([
                    'order_headers.id as order_headers.id',
                    'order_headers.order_date as order_headers.order_date',
                    'order_headers.processed_date as order_headers.processed_date',
                    'order_headers.amount as order_headers.order_amount',
                    'order_status.name as order_status.name',
                    'users.name as users.name',
                    'order_headers.status as order_headers.status'
                ]
            );

        return datatables()->of($orders)->editColumn('order_headers.order_date', function ($orders) {
            $array = json_decode(json_encode($orders), true);
            return date('d M Y', strtotime($array['order_headers.order_date']));
        })
            ->editColumn('order_headers.processed_date', function ($orders) {
                $array = json_decode(json_encode($orders), true);
                if ($array['order_headers.processed_date']) {
                    return date('d M Y', strtotime($array['order_headers.processed_date']));
                }
                return 'Not Processed';
            })
            ->toJson();
    }

}
