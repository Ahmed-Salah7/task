<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
                case "admin":
                    $redirect = RouteServiceProvider::HOMEAdmin;
                    return redirect(url($redirect));
                    break;
                default:
                    $redirect = RouteServiceProvider::HOME;
                    return redirect(url($redirect));
            }
        }
        return $next($request);
    }
}
