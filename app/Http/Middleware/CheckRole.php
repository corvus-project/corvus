<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null, $needsAll = false)
    {
        /*
         * Roles array
         */
        if (strpos($role, ';') !== false) {
            $roles = explode(';', $role);
            $access = Auth::user()->hasRoles($roles, ($needsAll === 'true' ? true : false));
        } else {
            /**
             * Single role.
             */
            $access = Auth::user()->hasRole($role);
        }

        if (!$access) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}