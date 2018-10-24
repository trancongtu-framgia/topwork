<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $authenticatedUser = Auth::user();
            if ($authenticatedUser->role_id == 1) {
                return redirect()->route('admin.index');
            }
        }

        return $next($request);
    }
}
