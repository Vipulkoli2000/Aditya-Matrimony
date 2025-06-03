<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Caste;
use App\Models\Package;
use App\Models\Profile;
use App\Models\SubCaste;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;

class ProfilePackagesController extends Controller
{
    public function show_interest(Request $request)
    {
        $interestUserId = $request->interest_id;
        $interestProfile = Profile::find($interestUserId);

        if (!$interestProfile) {
            return redirect()->back()->with('error', 'profile does not exists');
        }

        $profile = auth()->user()->profile;
        $tokenToUse = config('data.tokens.show_interest');
        // $this->useTokens($tokenToUse);
        if (!$this->useTokens($tokenToUse)) {
            // dd('not enought token');
            return redirect()->back()->with('error', 'Not enough tokens to add to interests');
        }

        $message = 'Tokens Available ' . $profile->available_tokens;
        $profile->interestProfiles()->attach($interestProfile->id);

        // return response()->json(['message' => 'added to interests']);
        return redirect()->back()->with('success', $message);
    }

    public function showProfile($id)
    {
        // Find the user by ID
        $tokenToUse = config('data.tokens.view_profile');
        $user = Profile::findOrFail($id);
        $profile = auth()->user()->profile;
        $showButton = true;
 
        $castes = Caste::find($user->caste);
        $subCastes = SubCaste::find($user->sub_caste);
        if ($subCastes){
            $subCastes = $subCastes->name; 
        };

        if ($castes){
            $castes = $castes->name; 
        };
        $users = auth()->user()->profile->interestProfiles()->get();      
          $interestedUsers = auth()->user()->profile->interestProfiles()->get();
          $viewdProfiles = auth()->user()->profile->viewProfiles()->get();
           foreach($interestedUsers as $intUsers){
            if($intUsers->id === $user->id){
                $showButton = false;
                
                foreach($viewdProfiles as $viewedProfile){
                    if($viewedProfile->id === $user->id){ 
                        return view('default.view.profile.other_view.create', ['user' => $user, 'showButton'=>$showButton, 'castes' => $castes, 'subCastes' => $subCastes]);
                    }
                }
                
                        if (!$this->useTokens($tokenToUse)) {
                            return redirect()->back()->with('error', 'Not enough tokens to view Profile');
                        }
                        $profile->viewProfiles()->attach($user->id);
                $message = 'Tokens Available ' . $profile->available_tokens;
                session()->flash('success', $message);
                

                return view('default.view.profile.other_view.create', ['castes' => $castes, 'subCastes' => $subCastes, 'user' => $user, 'showButton'=>$showButton])->with('success', $message);
            } 
        } 
        
        foreach($viewdProfiles as $viewedProfile){
            if($viewedProfile->id === $user->id){ 
                return view('default.view.profile.other_view.create', ['castes' => $castes, 'subCastes' => $subCastes, 'user' => $user, 'showButton'=>$showButton]);
            }
        }
        
        if (!$this->useTokens($tokenToUse)) {
            return redirect()->back()->with('error', 'Not enough tokens to view Profile');
        }
        $profile->viewProfiles()->attach($user->id);
        // Return a view with the user's data
        $message = 'Tokens Available ' . $profile->available_tokens;
        session()->flash('success', $message);
        return view('default.view.profile.other_view.create', [ 'castes' => $castes, 'subCastes' => $subCastes, 'user' => $user, 'showButton'=>$showButton])->with('success', $message);
    }

    public function purchasePackage(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required',
        ]);

        $package = Package::find($validated['package_id']);
        if (!$package) {
            return redirect()->back()->with('error', 'package not found');
        }

        $latestUserPackage = auth()
            ->user()
            ->profile
            ->profilePackages()
            ->withPivot('tokens_received', 'tokens_used', 'starts_at', 'expires_at')
            ->orderBy('expires_at', 'desc')
            ->first();
        
        if ($latestUserPackage && $latestUserPackage->pivot->expires_at > now()) {
            $startsAt = $latestUserPackage->pivot->expires_at;
        } else {
            $startsAt = now();
        }
        $startsAt = Carbon::parse($startsAt);

        $profilePackages = new ProfilePackage();
        $profilePackages->profile_id = auth()->user()->profile->id;
        $profilePackages->package_id = $package->id;
        $profilePackages->tokens_received = $package->tokens;
        $profilePackages->tokens_used = 0;
        $profilePackages->starts_at = $startsAt;
        $profilePackages->expires_at = $startsAt->copy()->addDays($package->validity);
        $profilePackages->save();
        // dd($profilePackages);

        // Update profile's package_id with the latest purchased package
        auth()->user()->profile->update([
            'profile_package_id' => $profilePackages->id
        ]);

        $this->updateTotalTokens(auth()->user()->profile->id);
         
        return redirect()->back();
    }

    private function updateTotalTokens($profileId)
    {
        $totalTokens = ProfilePackage::where('profile_id', $profileId)
            ->where('expires_at', '>', now())
            ->get()
            ->sum(function ($package) {
                return $package->tokens_received - $package->tokens_used;
            });

        auth()->user()->profile->update(['available_tokens' => $totalTokens]);
    }

    // public function useTokens(){
    //     //later
    // }

     //original
    // public function useTokens(string $tokenToUse)
    // {
    //     $userPackages = auth()
    //         ->user()
    //         ->profile
    //         ->profilePackages()
    //         ->where('expires_at', '>', now())
    //         ->orderBy('expires_at')
    //         ->get();

    //     $tokensAvailable = 0;
    //     $tokensAvail = 0;
    //     //  start
    //     foreach ($userPackages as $userPackage) {
    //         $availTokens = $userPackage->pivot->tokens_received - $userPackage->pivot->tokens_used;
    //         $tokensAvail += $availTokens;
    //     }

    //     // If the total available tokens are less than what the user requested, return false
    //     if ($tokensAvail < $tokenToUse) {
    //         return false;  // Not enough tokens
    //     }
    //     // end

    //     foreach ($userPackages as $userPackage) {
    //         $availableTokens = $userPackage->pivot->tokens_received - $userPackage->pivot->tokens_used;
    //         $tokensAvailable += $availableTokens;

    //         if ($tokensAvailable >= $tokenToUse) {
    //             $userPackage->pivot->tokens_used += $tokenToUse;

    //             $userPackage->pivot->save();  // issue
    //             // dd($userPackage->pivot->package_id);
    //             //  $userPackage->profile()->profilePackages->updateExistingPivot($userPackage->pivot->package_id, [
    //             //     'tokens_used' => $tt
    //             // ]);
    //             //   $p = ProfilePackage::find($userPackage->pivot->package_id);
    //             //   $p->tokens_used = $tt;
    //             //   $p->save();

    //             $this->updateTotalTokens(auth()->user()->profile->id);

    //             return true;
    //         } else {
    //             $tokenToUse -= $availableTokens;
    //             $userPackage->pivot->tokens_used = $userPackage->pivot->tokens_received;
    //             $userPackage->pivot->save();
    //         }
    //     }
    //     return false;
    // }

    public function view_interested()
    {
        $users = auth()->user()->profile->interestProfiles()->get();

        return view('default.view.profile.view_interested.index', ['users' => $users]);
    }
   
   

    // public function useTokens(string $tokenToUse)
    // {
    //     // Get the user's profile packages that are not expired
    //     $userPackages = auth()->user()->profile->profilePackages()
    //         ->where('expires_at', '>', now())
    //         ->orderBy('expires_at')
    //         ->get();

    //     $tokensAvailable = 0;
    //     $totalTokensToUse = $tokenToUse;  // Track the initial requested tokens

    //     // First, calculate the total available tokens in all packages
    //     foreach ($userPackages as $userPackage) {
    //         $availableTokens = $userPackage->pivot->tokens_received - $userPackage->pivot->tokens_used;
    //         $tokensAvailable += $availableTokens;
    //     }

    //     // If the total available tokens are less than what the user requested, return false
    //     if ($tokensAvailable < $tokenToUse) {
    //         return false;  // Not enough tokens
    //     }

    //     // Now, loop through the packages to deduct tokens
    //     foreach ($userPackages as $userPackage) {
    //         $availableTokens = $userPackage->pivot->tokens_received - $userPackage->pivot->tokens_used;

    //         if ($availableTokens >= $tokenToUse) {
    //             // If there are enough tokens in this package, use them
    //             $userPackage->pivot->tokens_used += $tokenToUse;
    //             $userPackage->pivot->save();  // Save the updated pivot data

    //             // After using tokens, exit because we used enough tokens
    //             $this->updateTotalTokens(auth()->user()->profile->id);
    //             return true;
    //         } else {
    //             // If there are not enough tokens in this package, use all remaining tokens in this package
    //             $tokenToUse -= $availableTokens;  // Subtract the used tokens from the requested tokens
    //             $userPackage->pivot->tokens_used = $userPackage->pivot->tokens_received;  // Mark all tokens as used
    //             $userPackage->pivot->save();  // Save the updated pivot data
    //         }
    //     }

    //     // If we exit the loop, it means there are still remaining tokens to be used but no more packages available
    //     return false;  // Not enough tokens
    // }


     public function useTokens(string $tokenToUse)
    {
        $userPackages = auth()
            ->user()
            ->profile
            ->profilePackages()
            ->where('expires_at', '>', now())
            ->orderBy('expires_at')
            ->get();

        $tokensAvailable = 0;
        $tokensAvail = 0;
        $tokensAvailablePerPackage = [];
        //  start
        foreach ($userPackages as $userPackage) {
            $availTokens = $userPackage->pivot->tokens_received - $userPackage->pivot->tokens_used;
            $tokensAvail += $availTokens;

            $tokensAvailablePerPackage[] = [
                'pivot_id' => $userPackage->pivot->id,  // Track by pivot id (primary key of the pivot table)
                'userPackage' => $userPackage,
                'availableTokens' => $availTokens
            ];
        }

        // If the total available tokens are less than what the user requested, return false
        if ($tokensAvail < $tokenToUse) {
            return false;  // Not enough tokens
        }
        // end

        foreach ($tokensAvailablePerPackage as $packageData) {
            $userPackage = $packageData['userPackage'];
            $availableTokens = $packageData['availableTokens'];
            $pivotId = $packageData['pivot_id'];  // Unique pivot_id for this instance
        //   dd($pivotId);
            // Ensure you're dealing with a single Profile instance
            $profile = auth()->user()->profile;  // This should give you the Profile model, not a collection
    
            // Find the specific pivot row using the pivot id
            $pivot = $profile->profilePackages()
                ->where('profile_packages.id', $pivotId)  // Find by pivot id (primary key of the pivot table)
                ->first()->pivot;        // Access the pivot record
    
            if ($availableTokens >= $tokenToUse) {
                // If the current package has enough tokens to fulfill the request
                $pivot->tokens_used += $tokenToUse;  // Deduct the requested tokens
                $pivot->save();  // Save the updated pivot record
                $this->updateTotalTokens(auth()->user()->profile->id);  // Update the total tokens
                return true;  // Successfully deducted tokens, return true
            } else {
                // If the current package doesn't have enough tokens, use all available tokens from this package
                $tokenToUse -= $availableTokens;
                $pivot->tokens_used += $availableTokens;  // Use all available tokens
                $pivot->save();  // Save the updated pivot record
            }
        }
        return false;
    }
   
    

}