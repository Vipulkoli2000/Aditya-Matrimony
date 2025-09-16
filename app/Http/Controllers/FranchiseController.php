<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FranchiseController extends Controller
{
    /**
     * Display the franchise welcome page.
     */
    public function welcome()
    {
        $franchise = Auth::guard('franchise')->user();
        return view('franchise.welcome', compact('franchise'));
    }
}
