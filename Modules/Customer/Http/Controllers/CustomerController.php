<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use Modules\Customer\Http\Requests\UserRequest;
use Modules\Customer\Http\Requests\UserUpdateRequest;
use Modules\Customer\Http\Requests\ProfileRequest;
use App\Models\StockType; 
use App\Models\PricingGroup;
use App\Models\Warehouse;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('customer::index');
    }

    public function data()
    {
        return datatables()->of(User::query()->whereHas('roles', function($q) {
            $q->where('name', 'customer');
        }))->toJson();        
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
        return view('customer::view', compact('user', 'warehouses', 'stock_types', 'pricing_groups', 'profile'));
    }   

    public function create()
    {
        return view('customer::create_edit');
    } 

    public function edit(User $user)
    {
        return view('customer::create_edit', compact('user'));
    }       

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = 1;
        $user->profile(new Profile);
        if ($user->save()) {
            $user->attachRole(Role::where('name', 'customer')->first());
            return redirect(route('admin.customers.edit', $user->id))->withFlashSuccess(trans('customer::labels.customers.created'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.customers.create'))->withFlashDanger('error', $error)->withInput(); 
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
            $user->attachRole(Role::where('name', 'customer')->first());
            return redirect(route('admin.customers.edit', $user->id))->withFlashSuccess(__('customer::labels.customers.updated'));
        }
        $error = $user->errors()->all(':message');
        return redirect(route('admin.customers.edit', $user->id))->withFlashDanger('error', $error)->withInput(); 
    }    

    public function profile_update(User $user, ProfileRequest $request)
    {
        if (!$user->profile){
            $user->profile()->save(
                new Profile(
                        [
                            "warehouse_id" => $request->warehouse_id,
                            "stock_type_id" => $request->stock_type_id,
                            "pricing_group_id" => $request->pricing_group_id,
                        ])
                    );
                    return redirect(route('admin.customers.view', $user->id))->withFlashSuccess(__('customer::labels.customers.updated'));                            
        }
        $profile = $user->profile;
        $profile->stock_type_id = $request->stock_type_id;
        $profile->pricing_group_id = $request->pricing_group_id;
        $profile->warehouse_id = $request->warehouse_id;
        $profile->save();        
        return redirect(route('admin.customers.view', $user->id))->withFlashSuccess(__('customer::labels.customers.updated'));        
    }

    public function token_regenerate(User $user)
    {
        $user->token = $this->createToken($user->id);
        $user->save();
        return redirect(route('admin.customers.view', $user->id))->withFlashSuccess(__('customer::labels.customers.updated'));        
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