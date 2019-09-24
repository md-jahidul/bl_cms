<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AppAdmin
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
        if(Auth::user()->role_id == "2" || Auth::user()->role_id == "1"){
            return $next($request);
        }else{
            return "your do not have permition";
        }
    }
}
