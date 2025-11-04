<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            !Auth::check() ||
            !in_array(Auth::user()->role_id, [1, 2]) ||
            Auth::user()->status == USER_STATUS_INACTIVE
        ) {
            return redirect()->route('admin.login.get');
        }
        return $next($request);
    }
}
