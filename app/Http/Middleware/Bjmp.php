<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Bjmp
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
        if(!in_array(strtolower(auth()->user()->role),['bjmp'])){
            abort(403);
        }
        return $next($request);
    }
}
