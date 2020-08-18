<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class ApiDebugEntryCheck
 * @package App\Http\Middleware
 */
class ApiDebugEntryCheck
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
        if (Auth::user()->hasRole('developer')) {
            return $next($request);
        }

        abort(403);
    }
}
