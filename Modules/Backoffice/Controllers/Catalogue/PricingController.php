<?php

namespace Corvus\Backoffice\Controllers\Catalogue;

use App\Http\Controllers\Controller;
use Corvus\Core\Requests\PricingStoreRequest;
use Corvus\Core\Requests\PricingUpdateRequest;
use Corvus\Core\Requests\StockStoreRequest;
use Corvus\Core\Requests\StockUpdateRequest;
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
use Corvus\Core\Services\PricingService;

class PricingController extends Controller
{
    private $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function view_pricing(Product $product)
    {
        $current_price_list = $product->pricing()->with('pricing_group')->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')->orderBy('pricings.from_date', 'DESC')->get();
        $history_price_list = $product->pricing()
            ->with('pricing_group')
            ->whereRaw('NOT  (CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
            ->whereRaw('to_date < CURRENT_DATE')->orderBy('pricings.from_date', 'DESC')->paginate(100);
        $future_price_list = $product->pricing()
            ->with('pricing_group')
            ->whereRaw('NOT  (CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
            ->whereRaw('to_date > CURRENT_DATE')->orderBy('pricings.from_date', 'DESC')->paginate(100);
        return view('backoffice.pricing.view_pricing', compact('product', 'current_price_list', 'history_price_list', 'future_price_list'));
    }

    public function create_pricing(Product $product)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('backoffice.pricing.create_edit_pricing', compact('product', 'pricing_groups'));
    }

    public function store_pricing(Product $product, PricingStoreRequest $request)
    {
        $count = DB::table('pricings')
            ->where('product_id', $product->id)
            ->where('pricing_group_id', $request->pricing_group_id)
            ->whereRaw("('" . $request->from_date . "' BETWEEN pricings.from_date AND pricings.to_date)")
            ->count();

        if ($count > 0) {
            return redirect(route('backoffice.products.create_pricing', $product->id))->withFlashDanger('You can\'t add new pricing between these dates')->withInput();
        }

        $pricing = new Pricing();
        $pricing->price = $request->price;
        $pricing->from_date = $request->from_date;
        $pricing->to_date = $request->to_date;
        $pricing->product_id = $product->id;
        $pricing->pricing_group_id = $request->pricing_group_id;
        if ($pricing->save()) {
            return redirect(route('backoffice.products.edit_pricing', [$product->id, $pricing->id]))->withFlashSuccess(trans('labels.pricing.products.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.products.create_pricing'))->withFlashDanger('error', $error)->withInput();
    }

    public function edit_pricing(Product $product, Pricing $pricing)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('backoffice.pricing.create_edit_pricing', compact('product', 'pricing', 'pricing_groups'));
    }

    public function update_pricing(Product $product, Pricing $pricing, PricingUpdateRequest $request)
    {
        $count = DB::table('pricings')
            ->where('id', '!=', $pricing->id)
            ->where('product_id', $product->id)
            ->where('pricing_group_id', $request->pricing_group_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('from_date', [$request->from_date, $request->to_date])
                    ->orWhereBetween('to_date', [$request->from_date, $request->to_date]);
            })->count();

        if ($count > 0) {
            return redirect(route('backoffice.pricing.edit_pricing', [$product->id, $pricing->id]))->withFlashDanger('You can\'t update the price between these dates')->withInput();
        }

        $pricing->price = $request->price;
        $pricing->from_date = $request->from_date;
        $pricing->to_date = $request->to_date;
        $pricing->product_id = $product->id;
        $pricing->pricing_group_id = $request->pricing_group_id;

        if ($pricing->save()) {
            return redirect(route('backoffice.pricing.edit_pricing', [$product->id, $pricing->id]))->withFlashSuccess(trans('labels.pricing.products.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.pricing.edit_pricing'))->withFlashDanger($error)->withInput();
    }

    public function delete_pricing(Product $product, Pricing $pricing)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('backoffice.pricing.delete_pricing', compact('product', 'pricing', 'pricing_groups'));
    }

    public function destroy_pricing(Product $product, Pricing $pricing)
    {
        $pricing->delete();
        return redirect(route('backoffice.pricing.view_pricing', $product->id))->withFlashSuccess(trans('labels.pricing.products.deleted'));
    }


}
