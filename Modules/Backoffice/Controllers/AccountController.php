<?php

namespace Corvus\Backoffice\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Corvus\Core\Models\PricingGroup;
use Corvus\Core\Models\Profile;
use Corvus\Core\Models\Role;
use Corvus\Core\Models\StockGroup;
use Corvus\Core\Models\User;
use Corvus\Core\Models\Warehouse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backoffice.accounts.index');
    }

    public function data()
    {
        $users = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'vendor');
        })
            ->leftJoin('account_profiles', 'users.id', '=', 'account_profiles.user_id')
            ->select(
                [
                    'users.id',
                    'users.name',
                    'users.email',
                    'account_profiles.account_number as account_number',
                    'account_profiles.account_group'
                ]
            );
        return datatables()->of($users)->toJson();
    }

    public function orders(User $user)
    {
        return view('backoffice.accounts.orders', compact('user'));
    }

    public function orders_data(User $user)
    {
        $orders = DB::table('order_headers')
            ->join('users', 'order_headers.user_id', '=', 'users.id')
            ->join('order_status', 'order_headers.status', '=', 'order_status.id')
            ->where('order_headers.user_id', $user->id)
            ->select(
                [
                    'order_headers.id as order_headers.id',
                    'users.name as users.name',
                    'order_headers.order_date as order_headers.order_date',
                    'order_status.name as order_status.name',
                    'order_headers.ref_id as order_headers.ref_id'
                ])
            ->orderBy('order_headers.id', 'desc');

        return datatables()->of($orders)->toJson();
    }

    public function view(User $user)
    {
        $stock_groups = StockGroup::all()->pluck('name', 'id');
        $stock_groups->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        $profile = $user->profile;
        return view('backoffice.accounts.view', compact('user', 'warehouses', 'stock_groups', 'pricing_groups', 'profile'));
    }

    public function create()
    {
        $stock_groups = StockGroup::all()->pluck('name', 'id');
        $stock_groups->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        return view('backoffice.accounts.create_edit', compact('warehouses', 'stock_groups', 'pricing_groups'));
    }

    public function edit(User $user)
    {
        $stock_groups = StockGroup::all()->pluck('name', 'id');
        $stock_groups->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        $profile = $user->profile;

        return view('backoffice.accounts.create_edit', compact('user', 'warehouses', 'stock_groups', 'pricing_groups', 'profile'));
    }

    public function profile(User $user)
    {
        $profile = $user->profile;
        return view('backoffice.accounts.create_edit', compact('user', 'profile'));
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = 1;

        if ($user->save()) {
            $user->attachRole(Role::where('name', 'vendor')->first());
            $user->profile()->save(
                new Profile(
                    [
                        "warehouse_id" => $request->warehouse_id,
                        "stock_group_id" => $request->stock_group_id,
                        "pricing_group_id" => $request->pricing_group_id,
                        "account_group" => $request->account_group,
                        "account_number" => $request->account_number,
                    ])
            );

            return redirect(route('backoffice.accounts.edit', $user->id))->withFlashSuccess('New account created!');
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.accounts.create'))->withFlashDanger('error', $error)->withInput();
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->active = 1;
        if ($user->save()) {
            if (!$user->profile) {
                $user->profile()->save(
                    new Profile(
                        [
                            "warehouse_id" => $request->warehouse_id,
                            "stock_group_id" => $request->stock_group_id,
                            "pricing_group_id" => $request->pricing_group_id,
                            "account_group" => $request->account_group,
                            "account_number" => $request->account_number,
                        ]
                    )
                );
            } else {
                $profile = $user->profile;
                $profile->stock_group_id = $request->stock_group_id;
                $profile->pricing_group_id = $request->pricing_group_id;
                $profile->warehouse_id = $request->warehouse_id;
                $profile->account_group = $request->account_group;
                $profile->account_number = $request->account_number;
                $profile->save();
            }

            $user->attachRole(Role::where('name', 'account')->first());
            return redirect(route('backoffice.accounts.edit', $user->id))->withFlashSuccess(__('labels.accounts.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('backoffice.accounts.edit', $user->id))->withFlashDanger('error', $error)->withInput();
    }

    public function token_regenerate(User $user)
    {
        $token = $user->createToken('authToken')->accessToken;

        return redirect(route('backoffice.accounts.view', $user->id))
            ->with('session-token', $token)
            ->withFlashSuccess(__('labels.accounts.updated'));
    }

}
