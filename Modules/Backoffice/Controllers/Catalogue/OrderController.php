<?php

namespace Backoffice\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use App\Http\Requests\PricingStoreRequest;
use App\Http\Requests\PricingUpdateRequest;
use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Category;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockGroup;
use App\Models\Warehouse;
use App\Models\OrderLine;
use App\Models\OrderStatus;
use DB;
use Illuminate\Http\Request;
use Core\Services\PricingService;

class OrderController extends Controller
{

    public function view_history(Product $product)
    {
        $approved_status = DB::table('order_status')->where('slug', 'APPROVED')->first();
        $orderlines = OrderLine::where('product_sku', $product->sku)
                                    ->where('status', $approved_status->id)
                                    ->orderBy('created_at', 'DESC')
                                    ->with('order')->paginate();
        $order_status_list = OrderStatus::all()->pluck('name', 'id');
                 
        return view('backoffice.products.view_history', compact('product', 'orderlines', 'order_status_list'));
    }
}