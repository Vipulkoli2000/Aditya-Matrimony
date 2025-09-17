<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdminOrFranchise
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
        // Check if user is authenticated as franchise
        if (Auth::guard('franchise')->check()) {
            return $next($request);
        }

        // Check if user is authenticated as admin
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            if ($user && $user->roles && $user->roles->pluck('name')->contains('admin')) {
                return $next($request);
            }
        }

        // If neither, redirect to admin login
        return redirect('/admin');
    }
}
