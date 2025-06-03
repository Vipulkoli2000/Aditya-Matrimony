<x-layout.user_banner>
    <style>
         a.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
        }
       
        a.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
        }

        /* Add this rule to style the disabled register button */
        #registerBtn:disabled {
            background-color: grey !important;
            border: grey !important;
            color: white !important;
            cursor: not-allowed;
        }

        /* Responsive Styles for Mobile View */
        @media (max-width: 768px) {
            /* Override inline card width for mobile */
            .card {
                width: 90% !important;
                margin: 0 auto !important;
            }
            /* Optional: add some horizontal padding to the container */
            .d-flex.justify-content-center.align-items-center.min-vh-100 {
                padding: 0 15px;
            }
            /* Reduce heading font size */
            h2 {
                font-size: 1.75rem;
            }
            /* Make first name, middle name, and last name stack on mobile */
            .col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light position-relative" style="background-image: url('/assets/images/map.svg'); background-size: cover; background-position: center;">
           <!-- Floating life partner box -->
           <div style="position: absolute; left: calc(50% - 600px); top: 40%; transform: translateY(-50%); max-width: 300px; padding: 1.5rem; background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); text-align: center; border: 1px solid #fecaca; z-index: 10;" class="d-none d-lg-block">
            <h2 style="font-size: 1.5rem; font-weight: bold; color: #b91c1c;">Want to find your life partner?</h2>
            <p style="color: #dc2626; font-size: 0.9rem;">
                Join our community matrimony and start your journey to finding your soulmate by following these steps
            </p>

            <div style="display: flex; flex-direction: column; align-items: center; gap: 1.5rem; font-family: sans-serif;">
  
  <!-- Step 1 -->
  <div style="display: flex; flex-direction: column; align-items: center;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Register
    </div>
    <div style="font-size: 1.5rem; color: #b91c1c; line-height: 1;">↓</div>
  </div>

  <!-- Step 2 -->
  <div style="display: flex; flex-direction: column; align-items: center; margin-top: -17px;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Login your account
    </div>
    <div style="font-size: 1.5rem; color: #b91c1c; line-height: 1;">↓</div>
  </div>

  <!-- Step 3 -->
  <div style="display: flex; flex-direction: column; align-items: center; margin-top: -17px;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Buy a package
    </div>
    <div style="font-size: 1.5rem; color: #b91c1c; line-height: 1;">↓</div>
  </div>

  <!-- Step 4 -->
  <div style="display: flex; flex-direction: column; align-items: center; margin-top: -17px;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Create a Profile
    </div>
    <div style="font-size: 1.5rem; color: #b91c1c; line-height: 1;">↓</div>
  </div>

  <!-- Step 5 -->
  <div style="display: flex; flex-direction: column; align-items: center; margin-top: -17px;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Start Searching
    </div>
   </div>

</div>


        </div>

        <div class="card" style="width: 480px;">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3 text-center">Register</h2>
                <div class="border rounded p-3 text-center bg-light">
                    <p class="mb-0 fw-bold text fs-7" style="font-size: 12px;">
                        Only <span class="text-danger">Maratha</span> <u>brides and grooms</u> are eligible to register on 
                        <a href="https://marathavivahmandaldombivli.com" target="_blank" class="text-primary fw-semibold">
                            marathavivahmandaldombivli.com
                        </a>. Aditya Matrimony reserves the right to remove the members.  
                        Registrants may be required to provide a caste certificate as per office requirements.
                    </p>
                </div>
                              
                {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                @if(Session::has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row mb-2">
                        <div class="mb-2 ">
                            <label class="form-label" style="color: black; margin: 10px 0;">Looking for:</label>
                            <div class="d-flex gap-2 flex-row">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="bride" value="bride" {{ old('role') === 'bride' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="bride" style="color: black;">
                                        Bride
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="groom" value="groom" {{ old('role') === 'groom' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="groom" style="color: black;">
                                        Groom
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('role')" class="mt-2 text-danger small" />
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label for="first_name" class="form-label" style="color: black; margin: 10px 0">First Name</label>
                        <input id="first_name" name="first_name" type="text" class="form-control" value="{{ old('first_name') }}" placeholder="First Name" required autofocus autocomplete="" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-danger small" />
                    </div>
                    <div class="col">
                        <label for="middle_name" class="form-label" style="color: black; margin: 10px 0;">Middle Name</label>
                        <input id="middle_name" name="middle_name" type="text" class="form-control" value="{{ old('middle_name') }}" placeholder="Middle Name" required autofocus autocomplete="" />
                        <x-input-error :messages="$errors->get('middle_name')" class="mt-2 text-danger small" />
                    </div>
                    <div class="col">
                        <label for="last_name" class="form-label" style="color: black; margin: 10px 0;">Last Name</label>
                        <input id="last_name" name="last_name" type="text" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus autocomplete="" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-danger small" />
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label" style="color: black; margin: 10px 0;">Email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required autofocus autocomplete="" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                    </div>
                    <div class="mb-2">
                        <label for="mobile" class="form-label" style="color: black; margin: 10px 0;">Mobile</label>
                        <div class="input-group">
                            <!-- Country Code Dropdown -->
                            <select class="form-select" name="country_code" id="country_code" style="max-width: 100px; color: black;" required>
                                @foreach (config('data.countryCodes') as $value => $name)
                                <option value="{{$value}}">{{ $value. " ".$name }}</option>
                                @endforeach
                            </select>
                             <input id="mobile" name="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                   value="{{ old('mobile') }}" placeholder="1234567890" required autofocus autocomplete="off"
                                   pattern="^[0-9]{10}$" title="Please enter a valid mobile number" style="color: black;" />
                        </div>
                        <x-input-error :messages="$errors->get('mobile')" class="mt-2 text-danger small" />
                    </div>
                    <div class="mb-2">
                        <label for="date_of_birth" class="form-label" style="color: black; margin: 10px 0;">Date of Birth</label>
                        <input id="date_of_birth" name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                               value="{{ old('date_of_birth') }}" placeholder="Enter Date of Birth" required autofocus
                               max="{{ now()->subYears(18)->format('Y-m-d') }}" title="You must be at least 18 years old" />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2 text-danger small" />
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms" style="color: black;">
                            I agree to the <a href="/terms-and-conditions" target="_blank" class="text-primary">Terms and Conditions</a>
                        </label>
                    </div>
                    <button id="registerBtn" type="submit" class="btn text-white btn-primary w-100">Register</button>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Existing code for updating date of birth...
                            const brideRadio = document.getElementById('bride');
                            const groomRadio = document.getElementById('groom');
                            const dateOfBirthInput = document.getElementById('date_of_birth');
                    
                            function updateMaxDate() {
                                const today = new Date();
                                let minAge = brideRadio.checked ? 18 : 21;
                                const maxDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());
                                dateOfBirthInput.max = maxDate.toISOString().split('T')[0];
                            }
                    
                            brideRadio.addEventListener('change', updateMaxDate);
                            groomRadio.addEventListener('change', updateMaxDate);
                            updateMaxDate();
                    
                            // New code to enable/disable the Register button based on the checkbox
                            const termsCheckbox = document.getElementById('terms');
                            const registerButton = document.getElementById('registerBtn');
                    
                            function toggleRegisterButton() {
                                registerButton.disabled = !termsCheckbox.checked;
                            }
                    
                            termsCheckbox.addEventListener('change', toggleRegisterButton);
                            toggleRegisterButton();
                        });
                    </script>
                </form>
               
                @if (Route::has('password.request'))
                <p class="text-end my-2 small"> 
                    <a class="text-primary font-weight-bold" href="{{ route('login') }}">
                        {{ __('Already have an Account?') }}
                    </a>
                </p>
                @endif
            </div>
        </div>
    </div>
</x-layout.user_banner>
