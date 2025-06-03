<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SubCaste;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $users = auth()->user()->profile()->with('subCaste')->get();
        $users = Profile::with('subCaste')->get();
        $profiles = Profile::all();
        return view('dashboard', ['users' => $users, 'profiles' => $profiles]);
    }

    public function load_users(Request $request)
    {
        $offset = $request->input('offset', 0);
        $users = auth()->user()->profile()->skip($offset)->take(4)->get();
        return view('dashboard', ['users' => $users]);
    }
}