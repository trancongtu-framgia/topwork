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
            if (strtolower($authenticatedUser->userRole->name) != config('app.admin_role')) {
                try {
                    return redirect()->back();
                }
                catch (\Exception $e) {
                    return redirect()->route('home.index');
                }
            }

            return $next($request);
        }

        return redirect()->route('login');
    }
}
