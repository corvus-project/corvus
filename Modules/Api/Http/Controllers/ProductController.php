<?php

namespace Modules\Api\Http\Controllers;
 
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockType; 
use App\Models\Stock;
use App\Models\Pricing;
use App\Models\PricingGroup;
use App\Models\Category;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Http\Requests\PricingStoreRequest;
use App\Http\Requests\PricingUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        return ['date' => Carbon::now()];
    }
}