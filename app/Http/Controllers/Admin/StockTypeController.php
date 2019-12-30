<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StockType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockTypeStoreRequest;
use App\Http\Requests\StockTypeUpdateRequest;
 
use Illuminate\Support\Str;

class StockTypeController extends Controller
{
    public function index()
    {
        $stock_types = StockType::all();
        return view('admin.stock_types.index', compact('stock_types'));
    }

    public function create()
    {
        return view('admin.stock_types.create_edit');
    }

    public function store(StockTypeStoreRequest $request)
    {
        $group = new StockType();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.stock_types.edit', $group->id))->withFlashSuccess(trans('labels.stock_types.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.stock_types.create'))->withFlashDanger('error', $error)->withInput(); 
    }

    public function edit(StockType $stock_type)
    {
        return view('admin.stock_types.create_edit', compact('stock_type'));
    }

    public function update(StockType $group, StockTypeUpdateRequest $request)
    {
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.stock_types.edit', $group->id))->withFlashSuccess(trans('labels.stock_types.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.stock_types.edit'))->withFlashDanger($error)->withInput(); 
    }
    
    public function delete(StockType $stock_type)
    {
        return view('admin.stock_types.delete', compact('stock_type'));
    }

    public function destroy(StockType $group)
    {
        $group->delete();
        return redirect(route('admin.stock_types.index'))->withFlashSuccess(trans('labels.stock_types.deleted'));
    }
}