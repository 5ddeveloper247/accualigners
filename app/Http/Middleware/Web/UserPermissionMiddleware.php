<?php

namespace App\Http\Middleware\Web;

use Closure;
use Illuminate\Http\Request;

class UserPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $form_id)
    {
        $role = $request->user()->role_id == 1 ? 'admin' : 'receptionist';
        if(!in_array($form_id, config('custom.form_permission.'.$role))){
            abort(403);
        }

        return $next($request);
    }
}
