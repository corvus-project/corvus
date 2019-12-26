<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
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
        $user = Auth::user();
        $token = $this->createToken($user->id);
        $user->token = $token;
        $user->save();
        return $token;
        return view('welcome');
    }

    
    private function createToken($user_id = 0)
    {
        $signer = new Sha256();
        $token = (new Builder())->setIssuer('https://api.loggfy.com')// Configures the issuer (iss claim)
        ->setAudience('https://api.loggfy.com')// Configures the audience (aud claim)
        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
        ->setNotBefore(time() + 60)// Configures the time that the token can be used (nbf claim)
        //->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
        ->set('user_id', "$user_id")// Configures a new claim, called "uid"
        ->sign($signer, 'rom73akz21')// creates a signature using "testing" as key
        ->getToken(); // Retrieves the generated token
        return (string)$token;
    }
}
