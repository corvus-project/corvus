<?php

namespace App\Http\Controllers\Portal;

use Corvus\Core\Models\User;
use Corvus\Core\Models\Order;
use Corvus\Core\Models\Product;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use DB;
use Auth;

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
        $user = Auth::user();
        $profile = $user->profile;
        $orders = Order::query()
            ->join('users', 'order_headers.user_id', '=', 'users.id')
            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
            ->where('order_headers.user_id', $user->id)

            ->select(
                'order_headers.id as order_id',
                'users.name as user_name',
                'order_headers.id',
                'order_headers.processed_date',
                'order_headers.order_date',

                'order_status.name as status_name'
                )->orderBy('order_headers.created_at', 'desc')->take(10)->get();

        return view('portal.dashboard', compact( 'orders'));
    }
}
