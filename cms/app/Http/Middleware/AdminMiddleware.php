<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        app()->setLocale('en'); // Set language is english for test
        return $next($request);
    }
}
