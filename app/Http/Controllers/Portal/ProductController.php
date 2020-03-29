<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockGroup;
use App\Models\Warehouse;
use DB;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.products.index');
    }

    public function data()
    {
        $profile = Auth::user()->profile;
        if ($profile) {
            $products = DB::table('pricings')
            ->leftJoin('products', 'products.id', '=', 'pricings.product_id')
            ->leftJoin('stocks', 'stocks.product_id', '=', 'pricings.product_id')
            ->where('pricings.pricing_group_id', $profile->pricing_group_id)
            ->where('stocks.warehouse_id', $profile->warehouse_id)
            ->where('stocks.stock_group_id', $profile->stock_group_id)
            ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
            ->select(
                'products.id as pid',
                'products.sku as product_sku',
                'products.name as product_name',
                'pricings.amount',
                'stocks.quantity'
            );

            return datatables()->of($products)->toJson();
        }else{
            return [];
        }
    }

    public function view(Product $product)
    {
        $profile = Auth::user()->profile;
        $price = DB::table('pricings')
            ->where('pricings.pricing_group_id', $profile->pricing_group_id)
            ->where('pricings.product_id', $product->id)
            ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
            ->select('from_date', 'to_date', 'amount')
            ->first();


        $stock = DB::table('stocks')
                    ->leftJoin('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
                    ->where('stocks.warehouse_id', $profile->warehouse_id)
                    ->where('stocks.stock_group_id', $profile->stock_group_id)
                    ->where('stocks.product_id', $product->id) 
                    
                    ->select('quantity', 'warehouses.name as warehouse_name')
                    ->first();

        return view('portal.products.view', compact('product', 'price', 'stock'));
    }
}