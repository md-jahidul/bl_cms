<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckFistLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()->password_changed_at == null) {
            Session::flash('message','Please change your password after first login ');
            return redirect('/users/change-password');
        }
        return $next($request);
    }
}
