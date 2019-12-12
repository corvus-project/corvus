<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PricingGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\PricingGroupStoreRequest;
use App\Http\Requests\PricingGroupUpdateRequest;
 
use Illuminate\Support\Str;

class PricingGroupController extends Controller
{
    public function index()
    {
        $groups = PricingGroup::all();
        return view('admin.pricing_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.pricing_groups.create_edit');
    }

    public function store(PricingGroupStoreRequest $request)
    {
        $group = new PricingGroup();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.pricing_groups.edit', $group->id))->withFlashSuccess(trans('labels.pricing_groups.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.pricing_groups.create'))->withFlashDanger('error', $error)->withInput(); 
    }

    public function edit(PricingGroup $group)
    {
        return view('admin.pricing_groups.create_edit', compact('group'));
    }

    public function update(PricingGroup $group, PricingGroupUpdateRequest $request)
    {
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('admin.pricing_groups.edit', $group->id))->withFlashSuccess(trans('labels.pricing_groups.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.pricing_groups.edit'))->withFlashDanger($error)->withInput(); 
    }
    
    public function delete(PricingGroup $group)
    {
        return view('admin.pricing_groups.delete', compact('group'));
    }

    public function destroy(PricingGroup $group)
    {
        $group->delete();
        return redirect(route('admin.pricing_groups.index'))->withFlashSuccess(trans('labels.pricing_groups.deleted'));
    }
}