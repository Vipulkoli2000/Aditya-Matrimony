<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Get Other caste and subcaste IDs for validation
        $otherCasteId = \App\Models\Caste::where('name', 'Other')->first()?->id;
        $otherSubCasteIds = \App\Models\SubCaste::where('name', 'Other')->pluck('id')->toArray();
        
        $validationRules = [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'regex:/^[\w\.\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,6}$/', 'max:255', 'unique:users'],
            'mobile' => ['nullable', 'digits:10'],
            'date_of_birth' => ['required', 'date'],    
            'role' =>  ['required'],
            'height' => ['required'],
            'weight' => ['required'],
            'complexion' => ['required'],
            'address_line1' => ['required'],
            'address_line2' => ['required'],
            'landmark' => ['required'],
            'pincode' => ['required'],
            'highest_education' => ['required'],
            'father_is_alive' => ['required','boolean'],
            'mother_is_alive' => ['required','boolean'],
            'father_name' => ['nullable','string','max:255'],
            'father_address' => ['nullable','string'],
            'father_mobile' => ['nullable','string','max:20'],
            'mother_name' => ['nullable','string','max:255'],
            'mother_address' => ['nullable','string'],
            'mother_mobile' => ['nullable','string','max:20'],
            'caste' => ['required','exists:castes,id'],
            'sub_caste' => ['required','exists:sub_castes,id'],
            'custom_caste' => ['nullable','string','max:100'],
            'custom_sub_caste' => ['nullable','string','max:100'],
            'has_franchise_code' => ['nullable','in:yes,no'],
            'franchise_code' => ['nullable','string','max:50'],
        ];
        
        // Add conditional validation for custom fields
        if ($otherCasteId && $request->caste == $otherCasteId) {
            $validationRules['custom_caste'][] = 'required';
        }
        
        if (!empty($otherSubCasteIds) && in_array($request->sub_caste, $otherSubCasteIds)) {
            $validationRules['custom_sub_caste'][] = 'required';
        }
        
        // Add conditional validation for franchise code
        if ($request->has_franchise_code === 'yes') {
            $validationRules['franchise_code'][] = 'required';
        }
        
        // Add reCAPTCHA validation if enabled
        if (config('services.recaptcha.enabled')) {
            $validationRules['g-recaptcha-response'] = ['required'];
        }
        
        $request->validate($validationRules);
        
        // Verify reCAPTCHA if enabled
        if (config('services.recaptcha.enabled')) {
            if (!$this->verifyRecaptcha($request->input('g-recaptcha-response'))) {
                return back()->withErrors(['g-recaptcha-response' => 'Please verify that you are not a robot.'])->withInput();
            }
        }
        
        // Build mobile number with country code if provided
        $number = null;
        if ($request->filled('mobile')) {
            $number = $request->input('country_code') . $request->input('mobile');
            
            // Check if mobile already exists
            $exists = DB::table('users')->where('mobile', $number)->exists();
            if ($exists) {
                return back()->withErrors(['mobile' => 'The mobile number is already registered.'])->withInput();
            }
        }
        
        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);
        
        try {
            // Start database transaction
            DB::beginTransaction();
            
            // Create user with fixed password
            $user = User::create([
                'name' => $fullName,
                'email' => $request->email,
                'mobile' => $number,
                'password' => Hash::make('Aditya123'), // Fixed password
            ]);
           
            // Determine user role
            if($request->role ==='bride'){
                $userRole = 'groom';
            }

            if($request->role ==='groom'){
                $userRole = 'bride';
            }

            
            // Create profile
            $profile = Profile::create([
                'user_id' => $user->id,
                'franchise_code' => $request->has_franchise_code === 'yes' ? $request->franchise_code : null,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'mobile' => $number,
                'role' => $userRole,
                'height' => $request->height,
                'weight' => $request->weight,
                'complexion' => $request->complexion,
                'address_line_1' => $request->address_line1,
                'address_line_2' => $request->address_line2,
                'landmark' => $request->landmark,
                'pincode' => $request->pincode,
                'highest_education' => $request->highest_education,
                // Father details
                'father_is_alive' => $request->father_is_alive,
                'father_name' => $request->father_name,
                'father_address' => $request->father_address,
                'father_mobile' => $request->father_mobile,
                // Mother details
                'mother_is_alive' => $request->mother_is_alive,
                'mother_name' => $request->mother_name,
                'mother_address' => $request->mother_address,
                'mother_mobile' => $request->mother_mobile,
                // Caste details
                'caste' => $request->caste,
                'sub_caste' => $request->sub_caste,
                'custom_caste' => $request->custom_caste,
                'custom_sub_caste' => $request->custom_sub_caste,
            ]);

            // Assign role
            $memberRole = Role::where('name', 'member')->first();
            $user->assignRole($memberRole);
            
            // If everything successful, commit the transaction
            DB::commit();
            
            // Redirect to registration success page
            return redirect('/registration-success');
            
        } catch (\Exception $e) {
            // If anything fails, rollback all database changes
            DB::rollBack();
            
            // Return error message
            return back()->withErrors(['error' => 'Registration failed. Please try again. Error: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the registration success view.
     */
    public function success(): View
    {
        return view('auth.registration-success');
    }
    
    /**
     * Verify reCAPTCHA response
     */
    private function verifyRecaptcha($recaptchaResponse)
    {
        if (empty($recaptchaResponse)) {
            return false;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret'),
                'response' => $recaptchaResponse,
                'remoteip' => request()->ip(),
            ]);

            $responseData = $response->json();
            return isset($responseData['success']) && $responseData['success'] === true;
        } catch (\Exception $e) {
            // Log the error if needed
            Log::error('reCAPTCHA verification failed: ' . $e->getMessage());
            return false;
        }
    }
    
}