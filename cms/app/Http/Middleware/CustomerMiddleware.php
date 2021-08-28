<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard(GUARD_CUSTOMER)->check()) {
            return $next($request);
        }

        return redirect()->route('page.home')->with(SHOW_LOGIN_FORM)->with('error','You need to log in to continue')->with('redirect_to', $request->url());
    }
}
