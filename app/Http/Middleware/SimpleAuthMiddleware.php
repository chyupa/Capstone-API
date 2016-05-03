<?php

namespace App\Http\Middleware;

use Closure;

class SimpleAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        return Auth::onceBasic('username') ?: $next($request);
    }
}