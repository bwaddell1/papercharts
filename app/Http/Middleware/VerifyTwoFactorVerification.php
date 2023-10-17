<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class VerifyTwoFactorVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(!str_contains($request->url(), RouteServiceProvider::TWO_FACTOR_VERIFY) && $request->user() && $request->user()->two_factor_confirmed_at && !$request->session()->get('two_factor_verified')) {
            return redirect(RouteServiceProvider::TWO_FACTOR_VERIFY);
        }

        return $next($request);
    }
}
