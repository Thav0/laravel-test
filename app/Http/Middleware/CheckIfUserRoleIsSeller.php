<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfUserRoleIsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( auth('api')->user()->user_role !== 2 ) return response()->json(['status' => 'Apenas vendedores podem aceder']); ;

        return $next($request);
    }
}
