<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\StockType; 
use App\Models\PricingGroup;
use App\Models\Warehouse;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin.accounts.index');
    }

    public function data()
    {
        $users = User::query()->whereHas('roles', function($q) {
                    $q->where('name', 'vendor');
                })
                ->leftJoin('account_profiles', 'users.id', '=', 'account_profiles.user_id')
                ->select('users.id','users.name', 'users.email', 'account_profiles.account_number', 'account_profiles.account_group');                

        return datatables()->of($users)->toJson();

 
    }    

    public function view(User $user)
    {
        $stock_types = StockType::all()->pluck('name', 'id');
        $stock_types->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        $profile = $user->profile;
        return view('admin.accounts.view', compact('user', 'warehouses', 'stock_types', 'pricing_groups', 'profile'));
    }   

    public function create()
    {
        $stock_types = StockType::all()->pluck('name', 'id');
        $stock_types->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        return view('admin.accounts.create_edit', compact('warehouses', 'stock_types', 'pricing_groups'));
    } 

    public function edit(User $user)
    {
        $stock_types = StockType::all()->pluck('name', 'id');
        $stock_types->prepend('Select stock type');
        $pricing_groups = PricingGroup::all()->pluck('name', 'id');
        $pricing_groups->prepend('Select pricing group');
        $warehouses = Warehouse::all()->pluck('name', 'id');
        $warehouses->prepend('Select warehouse');
        $profile = $user->profile;

        return view('admin.accounts.create_edit', compact('user', 'warehouses', 'stock_types', 'pricing_groups', 'profile'));
    }   
     
    public function profile(User $user)
    {
        $profile = $user->profile;
        return view('admin.accounts.create_edit', compact('user', 'profile'));
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
                            "stock_type_id" => $request->stock_type_id,
                            "pricing_group_id" => $request->pricing_group_id,
                            "account_group" => $request->account_group,
                            "account_number" => $request->account_number,                            
                        ])
                    );


            return redirect(route('admin.accounts.edit', $user->id))->withFlashSuccess(trans('admin.accounts.labels.accounts.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.accounts.create'))->withFlashDanger('error', $error)->withInput(); 
    }

    public function update(User $user, UserUpdateRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->active = 1;
        if ($user->save()) {
            if (!$user->profile) {
                $user->profile()->save(
                new Profile(
                    [
                            "warehouse_id" => $request->warehouse_id,
                            "stock_type_id" => $request->stock_type_id,
                            "pricing_group_id" => $request->pricing_group_id,
                            "account_group" => $request->account_group,
                            "account_number" => $request->account_number,
                        ]
                )
            );
            }else{
                $profile = $user->profile;
                $profile->stock_type_id = $request->stock_type_id;
                $profile->pricing_group_id = $request->pricing_group_id;
                $profile->warehouse_id = $request->warehouse_id;
                $profile->account_group = $request->account_group;
                $profile->account_number = $request->account_number;
                $profile->save(); 
            }
 

            $user->attachRole(Role::where('name', 'account')->first());
            return redirect(route('admin.accounts.edit', $user->id))->withFlashSuccess(__('labels.accounts.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.accounts.edit', $user->id))->withFlashDanger('error', $error)->withInput(); 
    }    



    public function token_regenerate(User $user)
    {
        $user->token = $this->createToken($user->id);
        $user->save();
        return redirect(route('admin.accounts.view', $user->id))->withFlashSuccess(__('labels.accounts.updated'));        
    }

    private function createToken($user_id = 0)
    {
        $signer = new Sha256();
        $token = (new Builder())->setIssuer(env('APP_URL', 'http://intellect.test'))// Configures the issuer (iss claim)
        ->setAudience(env('APP_URL', 'http://intellect.test'))// Configures the audience (aud claim)
        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60)// Configures the time that the token can be used (nbf claim)
        //->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
        ->set('user_id', "$user_id")// Configures a new claim, called "uid"
        ->sign($signer, env('JWT_SIGNATURE', '4A4A4A4A4A4'))// creates a signature using "testing" as key
        ->getToken(); // Retrieves the generated token
        return (string)$token;
    }    
}