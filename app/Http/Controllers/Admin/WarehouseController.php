<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseStoreRequest;
use App\Http\Requests\WarehouseUpdateRequest;
 
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('admin.warehouses.create_edit');
    }

    public function store(WarehouseStoreRequest $request)
    {
        $group = new Warehouse();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.warehouses.edit', $group->id))->withFlashSuccess(trans('labels.warehouses.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.warehouses.create'))->withFlashDanger('error', $error)->withInput(); 
    }

    public function edit(Warehouse $warehouse)
    {
        return view('admin.warehouses.create_edit', compact('warehouse'));
    }

    public function update(Warehouse $warehouse, WarehouseUpdateRequest $request)
    {
        $warehouse->name = $request->name;
        $warehouse->slug = strtoupper (Str::slug($request->name, '_'));
        if ($warehouse->save()) {
            return redirect(route('admin.warehouses.edit', $warehouse->id))->withFlashSuccess(trans('labels.warehouses.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.warehouses.edit'))->withFlashDanger($error)->withInput(); 
    }
    
    public function delete(Warehouse $warehouse)
    {
        return view('admin.warehouses.delete', compact('warehouse'));
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect(route('admin.warehouses.index'))->withFlashSuccess(trans('labels.warehouses.deleted'));
    }
}