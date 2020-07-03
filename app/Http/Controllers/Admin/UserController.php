<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::whereHas(
            'roles', function($q){
                $q->whereIn('name', ['inventory_staff', 'orders_staff']);
            }
        )->paginate();
 
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['inventory_staff', 'orders_staff'])->get()->pluck('name', 'id');
        $roles->prepend('Select a role', 0);
        return view('admin.users.create_edit', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = 1;

        if ($user->save()) {
            $user->attachRole($request->role_id);
            return redirect(route('admin.users.edit', $user->id))->withFlashSuccess('New user created!');
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.users.create'))->withFlashDanger('error', $error)->withInput();
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['inventory_staff', 'orders_staff'])->get()->pluck('name', 'id');
        $roles->prepend('Select a role', 0);
        return view('admin.users.create_edit', compact('user', 'roles'));
    }

    public function update(User $user, StaffUpdateRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->active = 1;
        if ($user->save()) {
            $user->attachRole($request->role_id);
            return redirect(route('admin.users.edit', $user->id))->withFlashSuccess(__('labels.users.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.users.edit', $user->id))->withFlashDanger('error', $error)->withInput();
    }
}
