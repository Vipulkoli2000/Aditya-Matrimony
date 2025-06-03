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
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'regex:/^[\w\.\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,6}$/', 'max:255', 'unique:users'],
            'mobile' => ['required', 'digits:10'],
            'date_of_birth' => ['required', 'date'],    
            //  'password' => ['required', 'confirmed', Rules\Password::defaults()],
             'role'=>  ['required'],
        ]);
        
        $number = $request->input('country_code') .$request->input('mobile'); 
        $exists = \DB::table('users')->where('mobile', $number)->exists();

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
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
             'mobile' => $number,
             'role' => $userRole,
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