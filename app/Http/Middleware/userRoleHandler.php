<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userRoleHandler
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
        $sUserRole = '/' . Auth::user()->role;
        if (Auth::user()->is_active === false) {
            auth('web')->logout();
            echo sprintf("<script>alert('%s, please contact the administrator, you have been deactivated.'); location.href='/login';</script>", Auth::user()->name);
        }
        if ($sUserRole !== $request->route()->getPrefix() && ($sUserRole === '/top' && $request->route()->uri === 'import')) {
            abort(403);
        }
        return $next($request);
    }
}
