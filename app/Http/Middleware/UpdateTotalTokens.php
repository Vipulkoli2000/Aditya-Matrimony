<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ProfilePackage;
use Symfony\Component\HttpFoundation\Response;

class UpdateTotalTokens
{

    private function updateTotalTokens($profileId){

        $totalTokens = ProfilePackage::where('profile_id', $profileId)
        ->where('expires_at', '>', now())
        ->get()
        ->sum(function($package){
            return $package->tokens_received - $package->tokens_used;
        });

         auth()->user()->profile->update(['available_tokens'=> $totalTokens]);
         if(auth()->user()->profile->available_tokens === 0){
            $val = 0;
                auth()->user()->update(['active'=> $val]);
            }else{
                $val = 1;
                auth()->user()->update(['active'=> $val]);
            }
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->profile) {
            $profileId = auth()->user()->profile->id;
            $this->updateTotalTokens($profileId);  // Call the function to update tokens
        }
        return $next($request);
        
    }
}