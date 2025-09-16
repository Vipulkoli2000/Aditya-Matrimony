<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // public function index()
    // {
    //     $profiles = Profile::all();
    //     $users = User::all();

    //     return view('admin.dashboard', ['profiles' => $profiles, 'users' => $users]);
    // }

    
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('active', 1)->count();
        $inactiveUsers = User::where('active', 0)->count();
    
        $activeMaleUsers = Profile::whereHas('user', function ($query) {
            $query->where('active', 1);
        })->where('role', 'groom')->count();
    
        $activeFemaleUsers = Profile::whereHas('user', function ($query) {
            $query->where('active', 1);
        })->where('role', 'bride')->count();
    
        $allBirthdayUsers = Profile::whereMonth('date_of_birth', now()->month)->get();
        $birthdayUsers = $allBirthdayUsers->take(5);
        $hasMoreBirthdays = $allBirthdayUsers->count() > 5;
    
        $brideCount = Profile::where('role', 'bride')->count();
        $groomCount = Profile::where('role', 'groom')->count();
    
        $expiringPackages = ProfilePackage::whereBetween('expires_at', [now(), now()->addDays(7)])->get();
    
        return view('admin.dashboard', compact(
            'totalUsers', 
            'activeUsers', 
            'inactiveUsers', 
            'activeMaleUsers', 
            'activeFemaleUsers',
            'birthdayUsers', 
            'hasMoreBirthdays', 
            'brideCount', 
            'groomCount',
            'expiringPackages'
        ));
    }
    

    /**
     * Franchise/Admin summary dashboard: shows profile counts.
     * - If franchise is logged in, restrict to that franchise_code
     * - If admin is logged in, show global counts
     */
    public function summary()
    {
        $baseQuery = Profile::query();

        // If franchise, filter by their franchise_code
        if (Auth::guard('franchise')->check()) {
            $franchise = Auth::guard('franchise')->user();
            $baseQuery->where('franchise_code', $franchise->franchise_code);
        }

        // Clone the query to avoid side-effects
        $totalProfiles = (clone $baseQuery)->count();
        $monthlyProfiles = (clone $baseQuery)
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        return view('admin.franchise-dashboard', compact('totalProfiles', 'monthlyProfiles'));
    }

    public function showExpiringPackages()
    {
        $expiringPackages = ProfilePackage::whereMonth('expires_at', now()->month)->get();
    
        return view('admin.expiring-packages', compact('expiringPackages'));

        $expiringPackages = ProfilePackage::with('profile.user')
    ->whereBetween('expires_at', [now(), now()->addDays(7)])
    ->get();

    }



public function showBirthdays(Request $request)
{
    $query = Profile::whereMonth('date_of_birth', now()->month);

    // Apply search filter if provided
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'LIKE', "%{$search}%")
              ->orWhere('middle_name', 'LIKE', "%{$search}%")
              ->orWhere('last_name', 'LIKE', "%{$search}%");
        });
    }

    // Order by day of the month
    $birthdayUsers = $query->orderByRaw('DAY(date_of_birth) ASC')->get();

    return view('admin.birthdays', compact('birthdayUsers'));
}




}