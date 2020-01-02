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

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = \App::make('user');
        $profile = $user->profile;
        $stock_type_id = $profile->stock_type_id;

        $stocks = Product::whereHas('stocks', function($query) use ($stock_type_id){
           $query->where('stock_type_id', $stock_type_id);
        })->get();
        return response()->json(['data' => $stocks], 200);
    }

    public function show(Product $product)
    {
        return ['date' => Carbon::now()];
    }    
}