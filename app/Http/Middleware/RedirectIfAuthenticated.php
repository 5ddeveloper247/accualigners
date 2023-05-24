<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? ['admin', 'doctor'] : $guards;
        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         if ($guard === 'admin') {
        //             return redirect(RouteServiceProvider::ADMIN);
        //         }
        //         else if ($guard === 'doctor') {
        //             return redirect(RouteServiceProvider::DOCTOR);
        //         }
        //         else{
        //             return redirect(RouteServiceProvider::DOCTOR);
        //         }
                
        //     }
        // }
        if(Auth::check()){
            if(auth()->user()->role->slug === 'admin'){
                return redirect(RouteServiceProvider::ADMIN); 
            }
            else{
             return redirect(RouteServiceProvider::DOCTOR);   
            }
        }

        return $next($request);
    }
}
