<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use App\Models\User;
use Lcobucci\JWT\Parser;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
 
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        try {
            $user = User::where('token', $token)->first();
            $token = (new Parser())->parse((string) $token); 
            $user_id = $token->getClaim('user_id');

            if ($user->id != $user_id){
                return response()->json([
                    'error' => 'Token not valid.'
                ], 401);
            } 
        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.'
            ], 400);
        }
 
        \Log::debug('User', (array)$user->email);
        app()->instance('user', $user);

        return $next($request); 
    }
}
