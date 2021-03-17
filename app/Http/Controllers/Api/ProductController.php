<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
use App\Http\Resources\Products;
use Corvus\Core\Models\Product;

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
                        ->where('stocks.stock_group_id', $profile->stock_group_id)
                        ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
                        ->select('products.*', 'pricings.price as price', 'stocks.quantity as quantity', 'warehouses.name as warehouse_name')
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
                        ->where('stocks.stock_group_id', $profile->stock_group_id)
                        ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
                        ->select('products.*', 'pricings.price as price', 'stocks.quantity as quantity', 'warehouses.name as warehouse_name')
                        ->first();
        if (!$selected){
            return response()->json(null, 404);
        }
        return new Products($selected);
    }
}
