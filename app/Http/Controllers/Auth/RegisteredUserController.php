<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SetPasswordMail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

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
            'mobile' => ['required', 'digits:10'],
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
        
        $request->validate($validationRules);
        
        $number = $request->input('country_code') .$request->input('mobile'); 
        $exists = DB::table('users')->where('mobile', $number)->exists();

        if ($exists) {
            return back()->withErrors(['mobile' => 'The mobile number is already registered.']);
        }
        $fullName = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);
        $ranToken = Str::random(60); // Generate a random token
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'mobile' => $number,
            //  'date_of_birth' => $request->date_of_birth,
            //  'password' => Hash::make($request->password),
        ]);
       
        // dd($user->id);
           if($request->role ==='bride'){
              $userRole = 'groom';
           }

           if($request->role ==='groom'){
            $userRole = 'bride';
         }

         DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($ranToken),
            'created_at' => now(),
        ]);
        

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

        $memberRole = Role::where('name', 'member')->first();
        $user->assignRole($memberRole);
        // Auth::login($user);
        // event(new Registered($user));

        // start
        // $user = User::where('email', $request->email)->first();

        // if($user){
        //     $status = Password::sendResetLink(
        //         $request->only('email')
        //     );
        // }
      


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
       

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __('we have emailed you a link to set password.'))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
        // end

        // new start
        $url = route('password.reset', ['token' => $ranToken]). '?email=' . urlencode($user->email); // Adjust this route as necessary

       
        Mail::to($user->email)
           ->send(new SetPasswordMail($url));
           
          return redirect()->back()->with('status','we have emailed you a link to set password.');
        // end end
    }
    
}