<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StockGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockGroupStoreRequest;
use App\Http\Requests\StockGroupUpdateRequest;
 
use Illuminate\Support\Str;

class StockGroupController extends Controller
{
    public function index()
    {
        $stock_groups = StockGroup::all();
        return view('admin.stock_groups.index', compact('stock_groups'));
    }

    public function create()
    {
        return view('admin.stock_groups.create_edit');
    }

    public function store(StockGroupStoreRequest $request)
    {
        $group = new StockGroup();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.stock_groups.edit', $group->id))->withFlashSuccess(trans('labels.stock_groups.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.stock_groups.create'))->withFlashDanger('error', $error)->withInput(); 
    }

    public function edit(StockGroup $stock_group)
    {
        return view('admin.stock_groups.create_edit', compact('stock_group'));
    }

    public function update(StockGroup $group, StockGroupUpdateRequest $request)
    {
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.stock_groups.edit', $group->id))->withFlashSuccess(trans('labels.stock_groups.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.stock_groups.edit'))->withFlashDanger($error)->withInput(); 
    }
    
    public function delete(StockGroup $stock_group)
    {
        return view('admin.stock_groups.delete', compact('stock_group'));
    }

    public function destroy(StockGroup $group)
    {
        $group->delete();
        return redirect(route('admin.stock_groups.index'))->withFlashSuccess(trans('labels.stock_groups.deleted'));
    }
}