<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    
    public function handle($request, Closure $next, ... $roles)
    {
        // dd($roles);
        if (!Auth::check()){
            return redirect('login'); 
        }
        else{
            $user = Auth::user();
            foreach($roles as $role) {
                if($user->role->slug == $role){
                    return $next($request);
                }
             }
        }
        return redirect()->back();
    
    }
    
}
