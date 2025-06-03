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
        if (Auth::check() && Auth::user()->roles->pluck('name')->first() === 'member') {
            $allowed = [
                'user_packages.create',
                'purchase_packages.store',
                'logout',
                'profiles.update_password',
                'profiles.password.update'
            ];
            $routeName = $request->route()->getName();
            if (!in_array($routeName, $allowed)) {
                $profile = Auth::user()->profile;
                $valid = false;
                if ($profile && $profile->profile_package_id) {
                    $pkg = ProfilePackage::find($profile->profile_package_id);
                }
            }
            $routeName = $request->route()->getName();
            if (!in_array($routeName, $allowed)) {
                $valid = false;
                $profile = Auth::user()->profile;
                if ($profile) {
                    $pkg = ProfilePackage::where('profile_id', $profile->id)
                        ->latest('id')
                        ->first();
                    if ($pkg && Carbon::parse($pkg->expires_at)->isFuture()) {
                        $valid = true;
                    }
                }
                if (!$valid) {
                    return redirect()->route('user_packages.create');
                }
            }
        }

        return $next($request);
    }
}
