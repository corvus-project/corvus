<?php

namespace Corvus\Backoffice\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use App\Http\Requests\PricingStoreRequest;
use App\Http\Requests\PricingUpdateRequest;
use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use Corvus\Core\Models\Category;
use Corvus\Core\Models\Pricing;
use Corvus\Core\Models\PricingGroup;
use Corvus\Core\Models\Product;
use Corvus\Core\Models\Stock;
use Corvus\Core\Models\StockGroup;
use Corvus\Core\Models\Warehouse;
use Corvus\Core\Models\OrderLine;
use Corvus\Core\Models\OrderStatus;
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
