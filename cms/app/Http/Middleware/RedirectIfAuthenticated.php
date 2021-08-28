<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case GUARD_CUSTOMER:
                    $login = 'account.dashboard';
                    break;
                default:
                    $login = 'admin.index';
                    break;
            }
            return redirect()->route($login);
        }

        return $next($request);   
    }
}
