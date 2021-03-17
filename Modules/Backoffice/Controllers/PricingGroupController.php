<?php

namespace Corvus\Backoffice\Controllers;

use Illuminate\Http\Request;
use Corvus\Core\Models\PricingGroup;
use App\Http\Controllers\Controller;
use Corvus\Core\Requests\PricingGroupStoreRequest;
use Corvus\Core\Requests\PricingGroupUpdateRequest;

use Illuminate\Support\Str;

class PricingGroupController extends Controller
{
    public function index()
    {
        $groups = PricingGroup::all();
        return view('backoffice.pricing_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('backoffice.pricing_groups.create_edit');
    }

    public function store(PricingGroupStoreRequest $request)
    {
        $group = new PricingGroup();
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('backoffice.pricing_groups.edit', $group->id))->withFlashSuccess(trans('labels.pricing_groups.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.pricing_groups.create'))->withFlashDanger('error', $error)->withInput();
    }

    public function edit(PricingGroup $group)
    {
        return view('backoffice.pricing_groups.create_edit', compact('group'));
    }

    public function update(PricingGroup $group, PricingGroupUpdateRequest $request)
    {
        $group->name = $request->name;
        $group->slug = strtoupper (Str::slug($request->name, '_'));
        if ($group->save()) {
            return redirect(route('backoffice.pricing_groups.edit', $group->id))->withFlashSuccess(trans('labels.pricing_groups.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.pricing_groups.edit'))->withFlashDanger($error)->withInput();
    }

    public function delete(PricingGroup $group)
    {
        return view('backoffice.pricing_groups.delete', compact('group'));
    }

    public function destroy(PricingGroup $group)
    {
        $group->delete();
        return redirect(route('backoffice.pricing_groups.index'))->withFlashSuccess(trans('labels.pricing_groups.deleted'));
    }
}
