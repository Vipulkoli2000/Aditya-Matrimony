<x-layout.user_banner>
    <style>
        /* Existing style for other 'a' tags styled as buttons */
        a.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
        }

        /* Page container styling */
        .min-vh-100 {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Modern font for the whole page */
        }

        /* Card styling for 3D effect and modern look */
        .card {
            width: 100%;
            max-width: 480px; /* Preserving original max-width */
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07); /* Enhanced 3D shadow */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden; /* Ensures content respects border-radius */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2.5rem; /* Increased padding */
        }

        /* Form elements styling */
        .form-label {
            font-weight: 600; /* Slightly bolder labels */
            color: #343a40 !important; /* Darker, more modern color, overriding inline styles */
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px; /* More pronounced rounding */
            border: 1px solid #d1d5db; /* Softer border color */
            padding: 0.4rem 1.0rem; /* Further reduced vertical padding */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04); /* Softer inset shadow */
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #007bff; /* Primary color focus */
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04), 0 0 0 0.25rem rgba(0,123,255,.25); /* Bootstrap-like focus glow */
        }

        /* Primary button styling */
        .btn-primary {
            background-color: #007bff; /* Primary blue - can be changed to #ff0000 for consistency if needed */
            border: none;
            border-radius: 10px;
            padding: 0.85rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase; /* Uppercase text for emphasis */
            letter-spacing: 0.05em; /* Slight letter spacing */
            color: white !important; /* Ensure text is white */
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.25), 0 3px 8px rgba(0,0,0,0.1); /* 3D shadow */
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9; /* Darker blue on hover */
            transform: translateY(-3px); /* Enhanced lift effect */
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3), 0 5px 12px rgba(0,0,0,0.15);
        }

        .btn-primary:active {
            transform: translateY(-1px); /* Press down effect */
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.2), 0 2px 5px rgba(0,0,0,0.1);
        }

        /* "Remember me" checkbox styling (also applies to "I agree" checkbox) */
        .form-check {
            display: flex;
            align-items: center;
            margin-top: 0.5rem; /* Spacing above checkbox */
        }
        .form-check-input {
            margin-top: 0;
            margin-right: 0.6rem;
            width: 1.2em; /* Slightly larger checkbox */
            height: 1.2em;
            border-radius: 4px; /* Softly rounded checkbox */
            border: 1px solid #adb5bd;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: background-color 0.2s, border-color 0.2s;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .form-check-label {
            color: #495057 !important; /* Overriding inline styles */
            padding-top: 0.1em; /* Fine-tune vertical alignment */
            font-size: 0.9rem;
        }

        /* Link styling (e.g. "Forgot password", "Already have an account?") */
        .text-primary.font-weight-bold {
            color: #007bff !important;
            text-decoration: none;
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .text-primary.font-weight-bold:hover {
            color: #0056b3 !important;
            text-decoration: underline;
        }

        /* Headings and text styling */
        .card-body h2.font-weight-bold {
            color: #212529; /* Darker, standard heading color */
            font-size: 2rem; /* Larger heading */
            margin-bottom: 0.75rem !important; /* Adjusted spacing */
        }

        .card-body p.mb-4 { /* Descriptive paragraph under heading */
            color: #6c757d; /* Softer text color */
            font-size: 1rem;
            margin-bottom: 2rem !important; /* More space before form */
        }

        /* Alert styling */
        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
            border-radius: 8px; /* Consistent rounding */
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        /* Style for disabled register button (preserved from original register.blade.php) */
        #registerBtn:disabled {
            background-color: grey !important;
            border: grey !important;
            color: white !important;
            cursor: not-allowed;
        }

        /* Responsive Styles for Mobile View */
        @media (max-width: 576px) {
            .card {
                width: 90%; /* Creates space on left/right, centered by parent flex */
                margin-top: 2rem; /* Adds space above the card */
                margin-bottom: 2rem; /* Adds space below the card */
            }
        }
    </style>

    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light position-relative">
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

  <!-- Step 4 -->
  <div style="display: flex; flex-direction: column; align-items: center; margin-top: -17px;">
    <div style="padding: 0.5rem 1rem; border: 2px solid #b91c1c; border-radius: 999px; font-size: 0.9rem; font-weight: 600; color: #b91c1c;">
      Start Searching
    </div>
   </div>

</div>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Register</h2>
                <p class="mb-4">Create your account by filling out the form below.</p>
                {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                @if(Session::has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-2">
                            <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                                <label class="form-label mb-0" style="color: black;">Looking for:</label>
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
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="first_name" class="form-label" style="color: black; margin: 10px 0">First Name</label>
                                <input id="first_name" name="first_name" type="text" class="form-control" value="{{ old('first_name') }}" placeholder="First Name" required autofocus autocomplete="" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-danger small" />
                            </div>
                            <div class="col-md-4">
                                <label for="middle_name" class="form-label" style="color: black; margin: 10px 0;">Middle Name</label>
                                <input id="middle_name" name="middle_name" type="text" class="form-control" value="{{ old('middle_name') }}" placeholder="Middle Name" required autofocus autocomplete="" />
                                <x-input-error :messages="$errors->get('middle_name')" class="mt-2 text-danger small" />
                            </div>
                            <div class="col-md-4">
                                <label for="last_name" class="form-label" style="color: black; margin: 10px 0;">Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus autocomplete="" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2 text-danger small" />
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label" style="color: black; margin: 10px 0;">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required autofocus autocomplete="" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                        </div>
                        <!-- Mobile -->
                        <div class="mb-2">
                            <label for="mobile" class="form-label" style="color: black; margin: 10px 0;">Mobile</label>
                            <div class="input-group">
                                <!-- Country Code Dropdown -->
                                <select class="form-select" name="country_code" id="country_code" style="max-width: 87px; color: black;" required>
                                    @foreach (config('data.countryCodes') as $value => $name)
                                    <option value="{{$value}}">{{ $value. " ".$name }}</option>
                                    @endforeach
                                </select>
                                 <input id="mobile" name="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                       value="{{ old('mobile') }}" placeholder="Mobile Number" required autofocus autocomplete="off"
                                       pattern="^[0-9]{10}$" title="Please enter a valid mobile number" style="color: black;" />
                            </div>
                            <x-input-error :messages="$errors->get('mobile')" class="mt-2 text-danger small" />
                        </div>
                        <!-- Date Of Birth -->
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
                        <button id="registerBtn" type="submit" class="btn text-white btn-primary w-100 d-flex justify-content-center align-items-center">Register</button>
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

                                // Logic for country code dropdown display
                                const countryCodeSelect = document.getElementById('country_code');

                                function updateCountryCodeDisplay() {
                                    if (countryCodeSelect.selectedOptions.length > 0) {
                                        const selectedOption = countryCodeSelect.selectedOptions[0];
                                        const fullText = selectedOption.dataset.fullText || selectedOption.textContent; // Store full text if not already
                                        selectedOption.dataset.fullText = fullText; // Ensure full text is stored
                                        selectedOption.textContent = selectedOption.value; // Display only the value (code)
                                    }
                                }

                                function restoreCountryCodeListDisplay() {
                                    for (let option of countryCodeSelect.options) {
                                        if (option.dataset.fullText) {
                                            option.textContent = option.dataset.fullText;
                                        }
                                    }
                                }

                                // Initial display update if a value is pre-selected
                                updateCountryCodeDisplay(); 

                                countryCodeSelect.addEventListener('change', updateCountryCodeDisplay);
                                
                                // When dropdown is focused (clicked to open), show full text in options
                                countryCodeSelect.addEventListener('focus', restoreCountryCodeListDisplay);

                                // Optional: When dropdown loses focus, re-apply the short display if needed
                                // This can be a bit aggressive, so test if it's desired.
                                // countryCodeSelect.addEventListener('blur', updateCountryCodeDisplay);
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
    </div>
</x-layout.user_banner>
