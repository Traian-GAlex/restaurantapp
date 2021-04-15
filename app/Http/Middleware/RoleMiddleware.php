<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $forRoles
     * @return mixed
     */
    public function handle($request, Closure $next, $forRoles)
    {
        if (!Auth::user()) return redirect("/login");
        if (Auth::user() && !Auth::user()->isInRole($forRoles)) return redirect("/home");
        return $next($request);
    }
}
