<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use DB;
use Log;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = $this->order;
        $status = OrderStatus::all();
        $processing = $status->firstWhere('slug', 'PROCESSING');
        $approved = $status->firstWhere('slug', 'APPROVED');
        $denied = $status->firstWhere('slug', 'DENIED');
        $not_found = $status->firstWhere('slug', 'NOT_FOUND');
        $failed = $status->firstWhere('slug', 'FAILED');
        $user = User::find($order->user_id);
        $profile = $user->profile;

        $order = $this->update_order_status($order, $processing);
        $this->update_products($order, $profile->pricing_group_id, $profile->stock_group_id, $profile->warehouse_id, $approved, $denied, $not_found);

        $approved_order_lines = $order->order_lines()->where('status', $approved->id)->count();
        $order_lines_count = $order->order_lines()->count();

        if ($approved_order_lines == $order_lines_count){
            $this->update_stock_history($order, $profile->stock_group_id, $profile->warehouse_id);
            $order->status = $approved->id;
        }else{
            $order->status = $failed->id;
        }
        $order->save();
    }

    private function update_order_status($order,  $processing)
    {
        $order->status = $processing->id;
        $order->save();
        return $order;
    }

    private function update_stock_history($order,  $stock_group_id, $warehouse_id)
    {
        $orderlines = $order->order_lines()->orderBy('created_at', 'DESC')->get();
        foreach ($orderlines as $orderline) {
            $product = DB::table('products')
                        ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
                        ->where('products.sku', $orderline->product_sku)
                        ->where('stocks.stock_group_id', $stock_group_id)
                        ->where('stocks.warehouse_id', $warehouse_id)
                        ->select('stocks.quantity', 'stocks.id as stock_id', 'stocks.quantity as quantity')
                        ->first();
            DB::table('stocks')->where('id', $product->stock_id)->update(['quantity' => ($product->quantity - intval($orderline->quantity))]); 
            }
    }

    private function update_products($order, $pricing_group_id, $stock_group_id, $warehouse_id, $approved, $denied, $not_found)
    {
        $orderlines = $order->order_lines()->orderBy('created_at', 'DESC')->get();
        foreach($orderlines as $orderline)
        {
            $product = DB::table('products')
                        ->leftJoin('pricings', 'products.id', '=', 'pricings.product_id')
                        ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
                        ->leftJoin('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
                        ->where('products.sku', $orderline->product_sku)
                        ->where('pricings.pricing_group_id', $pricing_group_id)
                        ->where('stocks.stock_group_id', $stock_group_id)
                        ->where('stocks.warehouse_id', $warehouse_id)
                        ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
                        ->select('products.*', 'pricings.amount as amount', 'stocks.quantity as quantity', 'warehouses.name as warehouse_name', 'warehouses.id as warehouse_id')
                        ->first(); 
            
            Log::debug('Procssing the ordered product', ['sku' => $orderline->product_sku]);
            if ($product){
                $orderline->product_name = $product->name;
                $orderline->product_id = $product->id;
                $orderline->amount = $product->amount;
                $orderline->warehouse_name = $product->warehouse_name;
                $orderline->warehouse_id = $product->warehouse_id;
                Log::debug('Processing the product', 
                                [
                                    'sku' => $product->sku, 
                                    'Product quantity' => $product->quantity, 
                                    'Order quantity' => $orderline->quantity]
                                );
                if ($product->quantity >= $orderline->quantity){
                    $orderline->status = $approved->id;
                }else{
                    $orderline->status = $denied->id;
                }
            }else{
                $orderline->status = $not_found->id;
            }

            $orderline->save();
        }
    }

}