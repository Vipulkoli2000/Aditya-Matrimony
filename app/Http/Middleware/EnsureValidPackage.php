<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilePackage;
use Carbon\Carbon;

class EnsureValidPackage
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Only apply to authenticated users with 'member' role
        if (Auth::check() && Auth::user()->roles && Auth::user()->roles->pluck('name')->first() === 'member') {
            
            // Routes that are always allowed (even without active package)
            $allowed = [
                'dashboard',
                'user_packages.create',
                'purchase_packages.store',
                'logout',
                'profiles.update_password',
                'profiles.password.update',
                'razorpay.createOrder',
                'razorpay.verifyPayment',
                'razorpay.failure',
                'all.purchased.packages',
                'generate.invoice'
            ];
            
            $routeName = $request->route()->getName();
            
            // If route is in allowed list, let them through
            if (in_array($routeName, $allowed)) {
                return $next($request);
            }
            
            // Check if user has valid package
            $profile = Auth::user()->profile;
            $hasValidPackage = $profile && $profile->hasActivePackage();
            
            // If no valid package, redirect to packages page
            if (!$hasValidPackage) {
                return redirect()->route('user_packages.create')
                    ->with('error', 'You need an active package to access this feature. Please purchase a package to continue.');
            }
        }

        return $next($request);
    }
}
