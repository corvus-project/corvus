<?php

namespace Modules\Api\Http\Controllers;
 
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockType; 
use App\Models\Stock;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Category;
use App\Models\User;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Http\Requests\PricingStoreRequest;
use App\Http\Requests\PricingUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;
use Auth;
use App\Http\Resources\Products;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = \App::make('user');
        $profile = $user->profile;

        $stocks = DB::table('products')
                        ->leftJoin('pricings', 'products.id', '=', 'pricings.product_id')
                        ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
                        ->leftJoin('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
                        ->where('pricings.pricing_group_id', $profile->pricing_group_id)
                        ->where('stocks.stock_type_id', $profile->stock_type_id)
                        ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
                        ->select('products.*', 'pricings.amount as amount', 'stocks.quantity as quantity', 'warehouses.name as warehouse_name')
                        ->get();        

        return Products::collection($stocks);
    }

    public function show(Product $product)
    {
        $user = \App::make('user');
        $profile = $user->profile;
         
        $selected = DB::table('products')
                        ->leftJoin('pricings', 'products.id', '=', 'pricings.product_id')
                        ->leftJoin('stocks', 'products.id', '=', 'stocks.product_id')
                        ->leftJoin('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
                        ->where('products.id', $product->id)
                        ->where('pricings.pricing_group_id', $profile->pricing_group_id)
                        ->where('stocks.stock_type_id', $profile->stock_type_id)
                        ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
                        ->select('products.*', 'pricings.amount as amount', 'stocks.quantity as quantity', 'warehouses.name as warehouse_name')
                        ->first();        
        
        if (!$selected){
            return response()->json([], 404);
        }
        return new Products($selected);
    }    
}