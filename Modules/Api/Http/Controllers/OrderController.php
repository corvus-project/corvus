<?php

namespace Modules\Api\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;
use Auth;
use App\Http\Resources\Products;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $user = \App::make('user');
        $profile = $user->profile;

        $orderlines = [];
        $lines = $request->all();
         
        $order = Order::create(['user_id' => $user->id, 'order_date' => Carbon::now(), 'status' => 1]);
        $order_id = $order->id;

        foreach($lines as $line){
            $orderlines[] = [
                'product_sku' => $line['sku'],
                'quantity' => $line['quantity'],
                'order_header_id' => $order_id,
                'status' => 1
            ];
        }

        DB::table('order_lines')->insert($orderlines);
        ProcessOrder::dispatch($order);
        return response()->json(['order_id' => $order_id], 201);
    }    
}