<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Package;

class PurchasePackagesController extends Controller
{
    public function store(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $user = auth()->user()->profile;
        
        // Process package purchase
        $user->profilePackages()->attach($package->id, [
            'tokens_received' => $package->tokens,
            'tokens_used' => 0,
            'starts_at' => now(),
            'expires_at' => now()->addDays($package->validity),
        ]);

        // Update user's available tokens
        $user->available_tokens += $package->tokens;
        $user->save();

        // Generate and download invoice
        return redirect()->route('generate.invoice', $package->id)
            ->with('success', 'Package purchased successfully!');
    }
}