<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB; 
use App\Jobs\ProcessOrder;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $status = OrderStatus::all();
        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'vendor');
        })->get();

        $status_json = null;
        foreach($status as $s){
            $status_json .= '{ value: "'. $s->id .'", label: "'. $s->name . '"},'; 
        }

        $customer_json = null;
        foreach($users as $s){
            $customer_json .= '{ value: "'. $s->id .'", label: "'. $s->name . '"},'; 
        }

        return view('admin.orders.index', compact('status_json', 'customer_json'));
    }

    public function view(Order $order)
    {
        $status = OrderStatus::all();
        $allowed_status = $status->whereNotIn('slug', ['CANCELED', 'APPROVED'])->pluck('id')->toArray();

        $orderlines = $order->order_lines()->orderBy('created_at', 'DESC')->get();
        return view('admin.orders.view', compact('order', 'orderlines','allowed_status'));
    }

    public function update(Order $order)
    {
        ProcessOrder::dispatch($order);
        return redirect(route('admin.orders.view', $order->id))->withFlashSuccess(trans('labels.order.update.success')); 
    }

    public function data()
    {
        $orders = DB::table('order_headers')
            ->join('users', 'order_headers.user_id', '=', 'users.id')
            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
        //select columns for new virtual table. ID columns must be renamed, because they have the same title
            ->select([
                    'users.name as user_id', 
                    'order_headers.id as oid', 
                    'order_headers.ref_id', 
                    'order_headers.order_date', 
                    'order_status.name as status_name'
                    ]);

        return datatables()->of($orders)->toJson();

    }
}