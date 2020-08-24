<?php

namespace App\Http\Middleware;

use Closure;

class FrontEndAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if($token != env('FRONTEND_API_KEY')){
            return response()->json(['msg'=>'Permission Denied!!! You do not have access.'], 403);
        }
        return $next($request);
    }
}
