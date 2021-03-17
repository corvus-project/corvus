<?php

namespace Corvus\Backoffice\Controllers;

use Illuminate\Http\Request;
use Corvus\Core\Models\Warehouse;
use App\Http\Controllers\Controller;
use Corvus\Core\Requests\WarehouseStoreRequest;
use Corvus\Core\Requests\WarehouseUpdateRequest;
use DB;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('backoffice.warehouses.index', compact('warehouses'));
    }

    public function products(Warehouse $warehouse)
    {
        return view('backoffice.warehouses.products', compact('warehouse'));
    }

    public function data(Warehouse $warehouse)
    {
        $stocks = DB::table('stocks')
            ->leftJoin('products', 'products.id', '=', 'stocks.product_id')
            ->leftJoin('stock_groups', 'stock_groups.id', '=', 'stocks.stock_group_id')
            ->where('stocks.warehouse_id', $warehouse->id)
            ->select([
                'products.id as pid',
                'products.sku as products.sku',
                'products.name as products.name',
                'stocks.quantity as quantity',
                'stock_groups.name as stock_group_name'
                ]
                    );

        return datatables()->of($stocks)->toJson();
    }

    public function create()
    {
        return view('backoffice.warehouses.create_edit');
    }

    public function store(WarehouseStoreRequest $request)
    {
        $group = new Warehouse();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('backoffice.warehouses.edit', $group->id))->withFlashSuccess(trans('labels.warehouses.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.warehouses.create'))->withFlashDanger('error', $error)->withInput();
    }

    public function edit(Warehouse $warehouse)
    {
        return view('backoffice.warehouses.create_edit', compact('warehouse'));
    }

    public function update(Warehouse $warehouse, WarehouseUpdateRequest $request)
    {
        $warehouse->name = $request->name;
        $warehouse->slug = strtoupper (Str::slug($request->name, '_'));
        if ($warehouse->save()) {
            return redirect(route('backoffice.warehouses.edit', $warehouse->id))->withFlashSuccess(trans('labels.warehouses.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.warehouses.edit'))->withFlashDanger($error)->withInput();
    }

    public function delete(Warehouse $warehouse)
    {
        return view('backoffice.warehouses.delete', compact('warehouse'));
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect(route('backoffice.warehouses.index'))->withFlashSuccess(trans('labels.warehouses.deleted'));
    }
}
