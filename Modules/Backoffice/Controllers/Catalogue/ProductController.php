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

class ProductController extends Controller
{

    private $pricingService;
  
    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.products.index');
    }

    public function data()
    {
        return datatables()->of(Product::query()->where('parent_id', 0))->toJson();
    }

    public function view(Product $product)
    {
        $approved_status = DB::table('order_status')->where('slug', 'APPROVED')->first();
        $orderlines = OrderLine::where('product_sku', $product->sku)
                                    ->where('status', $approved_status->id)
                                    ->orderBy('created_at', 'DESC')
                                    ->with('order')->take(10)->get();
        $cur_pricelist = $product->pricing()->with('pricing_group')->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')->orderBy('pricings.from_date', 'DESC')->get();
        return view('backoffice.products.view', compact('product', 'orderlines', 'cur_pricelist'));
    }

    public function view_stocks(Product $product)
    {
        $stocks = $product->stocks()->with('stock_group')->orderBy('created_at', 'DESC')->paginate(100);
        return view('backoffice.products.view_stocks', compact('product', 'stocks'));
    }

    public function view_categories(Product $product)
    {
        $categories = $product->categories()->orderBy('created_at', 'DESC')->get();
        return view('backoffice.products.view_categories', compact('product', 'categories'));
    }

    public function create_stock(Product $product)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_groups = StockGroup::all()->pluck('name', 'id');
        return view('backoffice.products.create_edit_stock', compact('product', 'warehouses', 'stock_groups'));
    }

    public function store_stock(Product $product, StockStoreRequest $request)
    {
        $count = DB::table('stocks')
            ->where('stock_group_id', $request->stock_group_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->where('product_id', $product->id)
            ->count();

        if ($count > 0) {
            return redirect(route('backoffice.products.create_stock', $product->id))->withFlashDanger('Current stock type and warehouse have stock')->withInput();
        }

        $stock = new Stock();
        $stock->quantity = $request->quantity;
        $stock->product_id = $product->id;
        $stock->stock_group_id = $request->stock_group_id;
        $stock->warehouse_id = $request->warehouse_id;
        if ($stock->save()) {
            return redirect(route('backoffice.products.edit_stock', [$product->id, $stock->id]))->withFlashSuccess(trans('labels.products.stock.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.products.create_stock', $product->id))->withFlashDanger('error', $error)->withInput();
    }

    public function edit_stock(Product $product, Stock $stock)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_groups = StockGroup::all()->pluck('name', 'id');
        return view('backoffice.products.create_edit_stock', compact('product', 'stock', 'warehouses', 'stock_groups'));
    }

    public function update_stock(Product $product, Stock $stock, StockUpdateRequest $request)
    {
        $count = DB::table('stocks')
            ->where('id', '<>', $stock->product_id)
            ->where('product_id',  $stock->product_id)
            ->where('stock_group_id', $request->stock_group_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->count();
 
        if ($count > 0) {
            return redirect(route('backoffice.products.edit_stock.update', [$stock->product_id, $stock->id]))->withFlashDanger('Current stock type and warehouse have stock quantity')->withInput();
        }

        $stock->quantity = $request->quantity;
        $stock->product_id = $product->id;
        $stock->stock_group_id = $request->stock_group_id;
        $stock->warehouse_id = $request->warehouse_id;
        if ($stock->save()) {
            return redirect(route('backoffice.products.edit_stock', [$product->id, $stock->id]))->withFlashSuccess(trans('labels.products.stock.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.products.edit_stock', [$product->id, $stock->id]))->withFlashDanger($error)->withInput();
    }

    public function delete_stock(Product $product, Stock $stock)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_groups = StockGroup::all()->pluck('name', 'id');

        return view('backoffice.products.delete_stock', compact('product', 'stock', 'warehouses', 'stock_groups'));
    }

    public function destroy_stock(Product $product, Stock $stock)
    {
        $stock->delete();
        return redirect(route('backoffice.products.view_stocks', $product->id))->withFlashSuccess(trans('labels.products.stock.deleted'));
    }

    public function create_category(Product $product)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('backoffice.products.create_category', compact('product', 'categories'));
    }

    public function store_category(Product $product, Request $request)
    {
        $hasCategory = $product->categories()->where('category_id', $request->category_id)->exists();
        if ($hasCategory) {
            return redirect(route('backoffice.products.view_categories', $product->id))->withFlashDanger(trans('labels.products.categories.exist'));
        }
        $product->categories()->attach($request->category_id);
        return redirect(route('backoffice.products.view_categories', $product->id))->withFlashSuccess(trans('labels.products.categories.created'));
    }

    public function delete_category(Product $product, Category $category)
    {
        return view('backoffice.products.delete_category', compact('product', 'category'));
    }

    public function destroy_category(Product $product, Category $category)
    {
        $product->categories()->detach($category->id);
        return redirect(route('backoffice.products.view_categories', $product->id))->withFlashSuccess(trans('labels.products.categories.deleted'));
    }

}