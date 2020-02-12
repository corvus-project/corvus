<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Auth;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function redirect()
    {
        $user = Auth::user();
        if ($user->hasRole('account')){
            return redirect(route('portal.dashboard'));
        }
        if ($user->hasRole('administrator')){
            return redirect(route('admin.dashboard'));
        }

        return redirect('/');
    }

     
}
