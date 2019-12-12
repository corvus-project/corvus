<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Auth\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $user = Auth::user();

        return view('admin.profile', compact('user'));
    }

    public function save(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect(route('admin.profile.form'))->with('success', trans('Your profile has been updated!'));
    }

}
