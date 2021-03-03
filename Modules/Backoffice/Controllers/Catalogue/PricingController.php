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

class PricingController extends Controller
{

    private $pricingService;
  
    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }


    public function view_pricing(Product $product)
    {
        $pricings = $product->pricing()->with('pricing_group')->orderBy('pricings.from_date', 'DESC')->paginate(100);
        return view('backoffice.products.view_pricing', compact('product', 'pricings'));
    }
}