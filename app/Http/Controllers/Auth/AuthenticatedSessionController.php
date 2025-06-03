<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Models\ProfilePackage;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Retrieve the input fields
        $credentials = $request->only('email', 'password');
    
        // Determine the login field (email or mobile) based on the input
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    
        // Attempt authentication using the determined field
        if (Auth::attempt([$loginField => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
    
            // Check if the login request is for admin login
            $isAdminRequest = $request->input('is_admin');
    
            if ($isAdminRequest == "true" || $isAdminRequest === true) {
                // Admin login path: ensure the user has admin privileges
                if (auth()->user()->roles->pluck('name')->first() === 'admin') {
                    return redirect()->intended('/admin');
                } else {
                    Auth::logout();
                    throw ValidationException::withMessages([
                        'email' => ['You do not have admin privileges to log in as admin.'],
                    ]);
                }
            } else {
                if (auth()->user()->roles->pluck('name')->first() === 'member') {
                    $user = auth()->user();
                    $profile = $user->profile;
                    // Redirect to package purchase if no package or expired
                    if (!$profile || !$profile->profile_package_id) {
                        return redirect()->route('basic_details.index');
                    }
                    $profilePackage = ProfilePackage::find($profile->profile_package_id);
                    if (!$profilePackage || Carbon::parse($profilePackage->expires_at)->isPast()) {
                        return redirect()->route('basic_details.index');
                    }
                    return redirect()->route('basic_details.index');
                } else {
                    Auth::logout();
                    throw ValidationException::withMessages([
                        'email' => ['Invalid Email.'],
                    ]);
                }
            }
        }
    
        // If authentication fails, throw an error
        throw ValidationException::withMessages([
            'password' => ['The provided credentials are incorrect.'],
        ]);
    }
    
    
       
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}