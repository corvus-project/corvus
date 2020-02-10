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
        if ($user->hasRole('customer')){
            return redirect(route('portal.dashboard'));
        }
        return redirect(route('admin.dashboard'));
    }

     
}
