<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = User::query()->whereHas('roles', function($q) {
            $q->where('name', 'vendor');
        })->orderBy('created_at', 'desc')->take(10)->get();        
 
        $orders = Order::query()
            ->join('users', 'order_headers.user_id', '=', 'users.id')
            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
            ->select(
                'order_headers.id as order_id',
                'users.name as user_name', 
                'order_headers.id', 
                'order_headers.processed_date', 
                'order_headers.order_date', 

                'order_status.name as status_name'
                )->orderBy('order_headers.created_at', 'desc')->take(10)->get();     

        $products = Product::take(10)->orderBy('created_at', 'desc')->get();     
        return view('admin.dashboard', compact('accounts', 'products', 'orders'));
    }
}