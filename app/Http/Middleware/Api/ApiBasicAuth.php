<?php

namespace App\Http\Middleware\Api;

use App\Models\Api;
use Closure;
use Illuminate\Http\Request;

class ApiBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->hasHeader('PublicKey') && $request->hasHeader('SecretKey')){
            $api = Api::where('public_key', $request->header('PublicKey'))
            ->where('secret_key', $request->header('SecretKey'))
            ->where('status', 1)
            ->first();
            if($api && isset($api->id)){
                return $next($request);
            }
        }
        
        return errorJsonResponse_h('API validation failed');
    }
}
