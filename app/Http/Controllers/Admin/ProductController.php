<?php

namespace App\Http\Controllers\Admin;
 
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\StockType; 
use App\Models\Stock;
use App\Models\Pricing;
use App\Models\PricingGroup;

use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Http\Requests\PricingStoreRequest;
use App\Http\Requests\PricingUpdateRequest;
use App\Http\Controllers\Controller;
use DB; 

class ProductController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    public function data()
    {
        return datatables()->of(Product::query()->where('parent_id', 0))->toJson();        
    }

    public function view(Product $product)
    {
        return view('admin.products.view', compact('product'));
    }

    public function view_pricing(Product $product)
    {
        $pricings = $product->pricing()->with('pricing_group')->take(10)->orderBy('created_at', 'DESC')->paginate(100);
        return view('admin.products.view_pricing', compact('product', 'pricings'));
    }    

    
    public function view_stocks(Product $product)
    {
        $stocks = $product->stocks()->with('stock_type')->take(10)->orderBy('from_date', 'DESC')->paginate(100);
        return view('admin.products.view_stocks', compact('product', 'stocks'));
    }     
    
    public function create_stock(Product $product)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_types = StockType::all()->pluck('name', 'id');
        return view('admin.products.create_edit_stock', compact('product', 'warehouses', 'stock_types'));
    }  
    
    public function store_stock(Product $product, StockStoreRequest $request)
    {  
        $stock = new Stock();
        $stock->quantity = $request->quantity;
        $stock->product_id = $product->id;
        $stock->stock_type_id = $request->stock_type_id;
        $stock->warehouse_id = $request->warehouse_id;
        if ($stock->save()) {
            return redirect(route('admin.products.edit_stock', [$product->id, $stock->id]))->withFlashSuccess(trans('labels.products.stock.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.products.create_stock', $product->id))->withFlashDanger('error', $error)->withInput(); 
    }      

    public function edit_stock(Product $product, Stock $stock)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_types = StockType::all()->pluck('name', 'id');
        return view('admin.products.create_edit_stock', compact('product', 'stock', 'warehouses', 'stock_types'));
    }

    public function update_stock(Product $product, Stock $stock, StockUpdateRequest $request)
    {
  
        $stock->quantity = $request->quantity;
        $stock->product_id = $product->id;
        $stock->stock_type_id = $request->stock_type_id;
        $stock->warehouse_id = $request->warehouse_id;
        if ($stock->save()) {
            return redirect(route('admin.products.edit_stock', [$product->id, $stock->id]))->withFlashSuccess(trans('labels.products.stock.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.products.edit_stock', [$product->id, $stock->id]))->withFlashDanger($error)->withInput(); 
    }

    public function delete_stock(Product $product, Stock $stock)
    {
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $stock_types = StockType::all()->pluck('name', 'id');
        return view('admin.products.delete_stock', compact('product', 'stock', 'warehouses', 'stock_types'));
    }

    public function destroy_stock(Product $product, Stock $stock)
    {
        $stock->delete();
        return redirect(route('admin.products.view_stocks', $product->id))->withFlashSuccess(trans('labels.products.stock.deleted'));
    }

    public function create_pricing(Product $product)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('admin.products.create_edit_pricing', compact('product', 'pricing_groups'));
    }  
    
    public function store_pricing(Product $product, PricingStoreRequest $request)
    {
        $count = DB::table('pricings')
                        ->where('product_id', $product->id)
                        ->where('pricing_group_id', $request->pricing_group_id)
                        ->where(function($query) use($request){
                            $query->whereBetween('from_date', [$request->from_date, $request->to_date])
                            ->orWhereBetween('to_date', [$request->from_date, $request->to_date]);
                        })
                        ->count();
        
        if ($count > 0){
            return redirect(route('admin.products.create_pricing', $product->id))->withFlashDanger('You can\'t add new stock quantity between these dates')->withInput(); 
        }

        $pricing = new Pricing();
        $pricing->amount = intval($request->amount);
        $pricing->from_date = $request->from_date;
        $pricing->to_date = $request->to_date;
        $pricing->product_id = $product->id;
        $pricing->pricing_group_id = $request->pricing_group_id;
        if ($pricing->save()) {
            return redirect(route('admin.products.edit_pricing', [$product->id, $pricing->id]))->withFlashSuccess(trans('labels.products.pricing.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.products.create_pricing'))->withFlashDanger('error', $error)->withInput(); 
    }      

    public function edit_pricing(Product $product, Pricing $pricing)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('admin.products.create_edit_pricing', compact('product', 'pricing', 'pricing_groups'));
    }

    public function update_pricing(Product $product, Pricing $pricing, PricingUpdateRequest $request)
    {
        $count = DB::table('pricings')
                        ->where('id', '!=', $pricing->id)
                        ->where('product_id', $product->id)
                        ->where('pricing_group_id', $request->pricing_group_id)
                        ->where(function($query) use($request){
                            $query->whereBetween('from_date', [$request->from_date, $request->to_date])
                            ->orWhereBetween('to_date', [$request->from_date, $request->to_date]);
                        })->count();
                    
        if ($count > 0){
            return redirect(route('admin.products.edit_pricing', [$product->id, $pricing->id]))->withFlashDanger('You can\'t add new stock quantity between these dates')->withInput(); 
        }        
        $pricing->amount = $request->amount;
        $pricing->from_date = $request->from_date;
        $pricing->to_date = $request->to_date;
        $pricing->product_id = $product->id;
        $pricing->pricing_group_id = $request->pricing_group_id;
        if ($pricing->save()) {
            return redirect(route('admin.products.edit_pricing', [$product->id, $pricing->id]))->withFlashSuccess(trans('labels.products.pricing.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.products.edit_pricing'))->withFlashDanger($error)->withInput(); 
    }

    public function delete_pricing(Product $product, Pricing $pricing)
    {
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        return view('admin.products.delete_pricing', compact('product', 'pricing', 'pricing_groups'));
    }

    public function destroy_pricing(Product $product, Pricing $pricing)
    {
        $pricing->delete();
        return redirect(route('admin.products.view_pricing', $product->id))->withFlashSuccess(trans('labels.products.pricing.deleted'));
    }    
}