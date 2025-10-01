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

        /* Center button text vertically */
        .btn-primary,
        .btn-outline-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        /* Fix dropdown text color */
        .form-select,
        .form-select option {
            color: black !important;
        }

        /* Responsive Styles for Mobile View */
        @media (max-width: 576px) {
            .card {
                width: 90%; /* Creates space on left/right, centered by parent flex */
                margin-top: 2rem; /* Adds space above the card */
                margin-bottom: 2rem; /* Adds space below the card */
            }
        }

        /* Stepper styles */
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        .stepper .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .stepper .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 12px;
            left: calc(50% + 14px); /* start after circle radius (14px) */
            width: calc(100% - 28px); /* subtract diameter to avoid touching next circle */
            height: 2px;
            background: #d1d5db;
            z-index: 0;
        }
        .stepper .step .step-count {
            display: inline-flex;
            width: 28px;
            height: 28px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #d1d5db;
            color: #000;
            font-weight: 600;
            z-index: 1;
            margin-bottom: 6px;
        }
        .stepper .step.active .step-count,
        .stepper .step.completed .step-count {
            background: #007bff;
            color: #fff;
        }
        .stepper .step.completed::after {
            background: #007bff;
        }
        .stepper .step .step-label {
            font-size: 0.8rem;
            white-space: nowrap;
        }

        /* Validation error styling */
        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545 !important;
        }
    </style>

    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light position-relative">
           <!-- Floating life partner box -->
          
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold mb-3">Register</h2>
                <p class="mb-1">Create your account by filling out the form below.</p>
                <p class="mb-4 mt-1 text-muted">Please complete all required details to continue.</p>
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
                        <ul class="stepper list-unstyled">
                            <li class="step active"><span class="step-count">1</span><div class="step-label">Basic</div></li>
                            <li class="step"><span class="step-count">2</span><div class="step-label">Details</div></li>
                            <li class="step"><span class="step-count">3</span><div class="step-label">Family Details</div></li>
                            <li class="step"><span class="step-count">4</span><div class="step-label">Finish</div></li>
                        </ul>
                        <div class="step-form">
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
                            
                            <!-- Franchise Code Section -->
                            <div class="row mb-2">
                                <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                                    <label class="form-label mb-0" style="color: black;">Have Franchise Code:</label>
                                    <div class="d-flex gap-2 flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_franchise_code" id="has_franchise_yes" value="yes" {{ old('has_franchise_code') === 'yes' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_franchise_yes" style="color: black;">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="has_franchise_code" id="has_franchise_no" value="no" {{ old('has_franchise_code') === 'no' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="has_franchise_no" style="color: black;">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Franchise Code Input Field (hidden by default) -->
                            <div class="mb-2" id="franchise_code_field" style="display: none;">
                                <label for="franchise_code" class="form-label" style="color: black; margin: 10px 0;">Franchise Code</label>
                                <input id="franchise_code" name="franchise_code" type="text" class="form-control" value="{{ old('franchise_code') }}" placeholder="Enter Franchise Code" />
                                <x-input-error :messages="$errors->get('franchise_code')" class="mt-2 text-danger small" />
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
                                <label for="email" class="form-label" style="color: black; margin: 10px 0;">Email <span class="text-muted">(Email or Mobile required)</span></label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email" autofocus autocomplete="" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                            </div>
                            <!-- Mobile -->
                            <div class="mb-2">
                                <label for="mobile" class="form-label" style="color: black; margin: 10px 0;">Mobile <span class="text-muted">(Email or Mobile required)</span></label>
                                <div class="input-group">
                                    <!-- Country Code Dropdown -->
                                    <select class="form-select" name="country_code" id="country_code" style="max-width: 87px; color: black;">
                                        @foreach (config('data.countryCodes') as $value => $name)
                                        <option value="{{$value}}">{{ $value. " ".$name }}</option>
                                        @endforeach
                                    </select>
                                     <input id="mobile" name="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile') }}" placeholder="Mobile Number" autofocus autocomplete="off"
                                           pattern="^[0-9]{10}$" title="Please enter a valid 10-digit mobile number" style="color: black;" />
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
                        </div> {{-- end step 1 --}}
                        {{-- Additional Personal Details --}}
                        <div class="step-form d-none">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="height" class="form-label" style="color: black; margin: 10px 0;">Height (cm)</label>
                                    <input id="height" name="height" type="number" min="50" max="300" class="form-control"
                                           value="{{ old('height') }}" placeholder="Height in centimeters" required />
                                    <x-input-error :messages="$errors->get('height')" class="mt-2 text-danger small" />
                                </div>
                                <div class="col-md-6">
                                    <label for="weight" class="form-label" style="color: black; margin: 10px 0;">Weight (kg)</label>
                                    <input id="weight" name="weight" type="number" min="20" max="300" class="form-control"
                                           value="{{ old('weight') }}" placeholder="Weight in kilograms" required />
                                    <x-input-error :messages="$errors->get('weight')" class="mt-2 text-danger small" />
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="complexion" class="form-label" style="color: black; margin: 10px 0;">Complexion</label>
                                <select id="complexion" name="complexion" class="form-select" required>
                                    <option value="" disabled selected>Select Complexion</option>
                                    <option value="very_fair" {{ old('complexion') == 'very_fair' ? 'selected' : '' }}>Very Fair</option>
                                    <option value="fair" {{ old('complexion') == 'fair' ? 'selected' : '' }}>Fair</option>
                                    <option value="wheatish" {{ old('complexion') == 'wheatish' ? 'selected' : '' }}>Wheatish</option>
                                    <option value="dark" {{ old('complexion') == 'dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                                <x-input-error :messages="$errors->get('complexion')" class="mt-2 text-danger small" />
                            </div>

                            <div class="mb-2">
                                <label for="address_line1" class="form-label" style="color: black; margin: 10px 0;">Address Line 1</label>
                                <input id="address_line1" name="address_line1" type="text" class="form-control"
                                       value="{{ old('address_line1') }}" placeholder="Address Line 1" required />
                                <x-input-error :messages="$errors->get('address_line1')" class="mt-2 text-danger small" />
                            </div>

                            <div class="mb-2">
                                <label for="address_line2" class="form-label" style="color: black; margin: 10px 0;">Address Line 2</label>
                                <input id="address_line2" name="address_line2" type="text" class="form-control"
                                       value="{{ old('address_line2') }}" placeholder="Address Line 2" />
                                <x-input-error :messages="$errors->get('address_line2')" class="mt-2 text-danger small" />
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="landmark" class="form-label" style="color: black; margin: 10px 0;">Landmark</label>
                                    <input id="landmark" name="landmark" type="text" class="form-control"
                                           value="{{ old('landmark') }}" placeholder="Landmark" />
                                    <x-input-error :messages="$errors->get('landmark')" class="mt-2 text-danger small" />
                                </div>
                                <div class="col-md-6">
                                    <label for="pincode" class="form-label" style="color: black; margin: 10px 0;">Pincode</label>
                                    <input id="pincode" name="pincode" type="text" pattern="[0-9]{6}" class="form-control"
                                           value="{{ old('pincode') }}" placeholder="Pincode" required />
                                    <x-input-error :messages="$errors->get('pincode')" class="mt-2 text-danger small" />
                                </div>
                            </div>

                            <div class="mb-2">
                                <label for="highest_education" class="form-label" style="color: black; margin: 10px 0;">Highest Education</label>
                                <select id="highest_education" name="highest_education" class="form-select" required>
                                    <option value="" disabled selected>Select Highest Education</option>
                                    <option value="high_school" {{ old('highest_education') == 'high_school' ? 'selected' : '' }}>High School</option>
                                    <option value="diploma" {{ old('highest_education') == 'diploma' ? 'selected' : '' }}>Diploma</option>
                                    <option value="bachelors" {{ old('highest_education') == 'bachelors' ? 'selected' : '' }}>Bachelors</option>
                                    <option value="masters" {{ old('highest_education') == 'masters' ? 'selected' : '' }}>Masters</option>
                                    <option value="phd" {{ old('highest_education') == 'phd' ? 'selected' : '' }}>PhD</option>
                                </select>
                                <x-input-error :messages="$errors->get('highest_education')" class="mt-2 text-danger small" />
                            </div>
                        </div> {{-- end step 2 --}}
                        <div class="step-form d-none">
                            <!-- Father Details -->
                            <div class="mb-3">
                                <label for="father_is_alive" class="form-label" style="color: black; margin: 10px 0;">Is Father Alive?</label>
                                <select id="father_is_alive" name="father_is_alive" class="form-select" required>
                                    <option value="" disabled selected>Select Option</option>
                                    <option value="1" {{ old('father_is_alive') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('father_is_alive') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                <x-input-error :messages="$errors->get('father_is_alive')" class="mt-2 text-danger small" />
                            </div>
                            <div id="father_details" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="father_name" class="form-label" style="color: black; margin: 10px 0;">Father Name <span class="text-danger">*</span></label>
                                        <input id="father_name" name="father_name" type="text" class="form-control" value="{{ old('father_name') }}" placeholder="Enter Father Name" />
                                        <x-input-error :messages="$errors->get('father_name')" class="mt-2 text-danger small" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="father_mobile" class="form-label" style="color: black; margin: 10px 0;">Father Mobile <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select" name="father_country_code" id="father_country_code" style="max-width: 72px; color: black; border-top-right-radius: 0; border-bottom-right-radius: 0; font-size: 0.85rem;">
                                                @foreach (config('data.countryCodes') as $value => $name)
                                                <option value="{{$value}}" {{ old('father_country_code') == $value ? 'selected' : '' }}>{{ $value." ".$name }}</option>
                                                @endforeach
                                            </select>
                                            <input id="father_mobile" name="father_mobile" type="tel" class="form-control @error('father_mobile') is-invalid @enderror" value="{{ old('father_mobile') }}" placeholder="Mobile Number" pattern="^[0-9]{10}$" title="Please enter a valid mobile number" maxlength="10" style="color: black; border-top-left-radius: 0; border-bottom-left-radius: 0; font-size: 0.85rem;" />
                                        </div>
                                        <x-input-error :messages="$errors->get('father_mobile')" class="mt-2 text-danger small" />
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="father_address" class="form-label" style="color: black; margin: 10px 0;">Father Address <span class="text-danger">*</span></label>
                                    <input id="father_address" name="father_address" type="text" class="form-control" value="{{ old('father_address') }}" placeholder="Enter Father Address" />
                                    <x-input-error :messages="$errors->get('father_address')" class="mt-2 text-danger small" />
                                </div>
                            </div>
                            <!-- Mother Details -->
                            <div class="mb-3 mt-4">
                                <label for="mother_is_alive" class="form-label" style="color: black; margin: 10px 0;">Is Mother Alive?</label>
                                <select id="mother_is_alive" name="mother_is_alive" class="form-select" required>
                                    <option value="" disabled selected>Select Option</option>
                                    <option value="1" {{ old('mother_is_alive') == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('mother_is_alive') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                                <x-input-error :messages="$errors->get('mother_is_alive')" class="mt-2 text-danger small" />
                            </div>
                            <div id="mother_details" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="mother_name" class="form-label" style="color: black; margin: 10px 0;">Mother Name <span class="text-danger">*</span></label>
                                        <input id="mother_name" name="mother_name" type="text" class="form-control" value="{{ old('mother_name') }}" placeholder="Enter Mother Name" />
                                        <x-input-error :messages="$errors->get('mother_name')" class="mt-2 text-danger small" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="mother_mobile" class="form-label" style="color: black; margin: 10px 0;">Mother Mobile <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <select class="form-select" name="mother_country_code" id="mother_country_code" style="max-width: 72px; color: black; border-top-right-radius: 0; border-bottom-right-radius: 0; font-size: 0.85rem;">
                                                @foreach (config('data.countryCodes') as $value => $name)
                                                <option value="{{$value}}" {{ old('mother_country_code') == $value ? 'selected' : '' }}>{{ $value." ".$name }}</option>
                                                @endforeach
                                            </select>
                                            <input id="mother_mobile" name="mother_mobile" type="tel" class="form-control @error('mother_mobile') is-invalid @enderror" value="{{ old('mother_mobile') }}" placeholder="Mobile Number" pattern="^[0-9]{10}$" title="Please enter a valid mobile number" maxlength="10" style="color: black; border-top-left-radius: 0; border-bottom-left-radius: 0; font-size: 0.85rem;" />
                                        </div>
                                        <x-input-error :messages="$errors->get('mother_mobile')" class="mt-2 text-danger small" />
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="mother_address" class="form-label" style="color: black; margin: 10px 0;">Mother Address <span class="text-danger">*</span></label>
                                    <input id="mother_address" name="mother_address" type="text" class="form-control" value="{{ old('mother_address') }}" placeholder="Enter Mother Address" />
                                    <x-input-error :messages="$errors->get('mother_address')" class="mt-2 text-danger small" />
                                </div>
                            </div>
                            
            <!-- Caste and Subcaste Details -->
            <div class="mb-3 mt-4">
                <h6 class="mb-3" style="color: black; font-weight: 600;">Caste & Subcaste Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="caste" class="form-label" style="color: black; margin: 10px 0;">Caste <span class="text-danger">*</span></label>
                        <select id="caste" name="caste" class="form-select" required>
                            <option value="" disabled selected>Select Caste</option>
                            @foreach(\App\Models\Caste::orderBy('name')->get() as $caste)
                                <option value="{{ $caste->id }}" {{ old('caste') == $caste->id ? 'selected' : '' }}>{{ $caste->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('caste')" class="mt-2 text-danger small" />
                        
                        <!-- Custom Caste Input (hidden by default) -->
                        <div id="custom_caste_container" style="display: none; margin-top: 10px;">
                            <label for="custom_caste" class="form-label" style="color: black; margin: 10px 0;">Please specify your caste <span class="text-danger">*</span></label>
                            <input id="custom_caste" name="custom_caste" type="text" class="form-control" value="{{ old('custom_caste') }}" placeholder="Enter your caste" />
                            <x-input-error :messages="$errors->get('custom_caste')" class="mt-2 text-danger small" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="sub_caste" class="form-label" style="color: black; margin: 10px 0;">Subcaste <span class="text-danger">*</span></label>
                        <select id="sub_caste" name="sub_caste" class="form-select" required>
                            <option value="" disabled selected>Select Subcaste</option>
                        </select>
                        <x-input-error :messages="$errors->get('sub_caste')" class="mt-2 text-danger small" />
                        
                        <!-- Custom SubCaste Input (hidden by default) -->
                        <div id="custom_sub_caste_container" style="display: none; margin-top: 10px;">
                            <label for="custom_sub_caste" class="form-label" style="color: black; margin: 10px 0;">Please specify your subcaste <span class="text-danger">*</span></label>
                            <input id="custom_sub_caste" name="custom_sub_caste" type="text" class="form-control" value="{{ old('custom_sub_caste') }}" placeholder="Enter your subcaste" />
                            <x-input-error :messages="$errors->get('custom_sub_caste')" class="mt-2 text-danger small" />
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                         {{-- end step 3 --}}
                        <div class="step-form d-none">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms" style="color: black;">
                                    I agree to the <a href="/terms-and-conditions" target="_blank" class="text-primary">Terms and Conditions</a>
                                </label>
                            </div>
                        </div> {{-- end step 4 --}}

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" id="prevBtn" class="btn btn-primary d-none">Previous</button>
                            <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
                            <button id="registerBtn" type="submit" class="btn text-white btn-primary d-none" disabled>Register</button>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Toggle required attribute based on is_alive selection
                                function toggleRequiredFields(selectId, detailsId) {
                                    const select = document.getElementById(selectId);
                                    const details = document.getElementById(detailsId);
                                    const inputs = details.querySelectorAll('input, select');
                                    
                                    if (select.value === '1') {
                                        inputs.forEach(input => {
                                            input.required = true;
                                        });
                                    } else {
                                        inputs.forEach(input => {
                                            input.required = false;
                                        });
                                    }
                                }

                                // Initial setup for father and mother details
                                const fatherAlive = document.getElementById('father_is_alive');
                                const motherAlive = document.getElementById('mother_is_alive');

                                if (fatherAlive) {
                                    fatherAlive.addEventListener('change', function() {
                                        const fatherDetails = document.getElementById('father_details');
                                        if (this.value === '1') {
                                            fatherDetails.style.display = 'block';
                                            toggleRequiredFields('father_is_alive', 'father_details');
                                        } else {
                                            fatherDetails.style.display = 'none';
                                            toggleRequiredFields('father_is_alive', 'father_details');
                                        }
                                    });
                                    // Trigger change on load if value is already set
                                    if (fatherAlive.value === '1') {
                                        fatherAlive.dispatchEvent(new Event('change'));
                                    }
                                }

                                if (motherAlive) {
                                    motherAlive.addEventListener('change', function() {
                                        const motherDetails = document.getElementById('mother_details');
                                        if (this.value === '1') {
                                            motherDetails.style.display = 'block';
                                            toggleRequiredFields('mother_is_alive', 'mother_details');
                                        } else {
                                            motherDetails.style.display = 'none';
                                            toggleRequiredFields('mother_is_alive', 'mother_details');
                                        }
                                    });
                                    // Trigger change on load if value is already set
                                    if (motherAlive.value === '1') {
                                        motherAlive.dispatchEvent(new Event('change'));
                                    }
                                }
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

                                // Franchise code field toggle functionality
                                const franchiseYes = document.getElementById('has_franchise_yes');
                                const franchiseNo = document.getElementById('has_franchise_no');
                                const franchiseCodeField = document.getElementById('franchise_code_field');
                                const franchiseCodeInput = document.getElementById('franchise_code');

                                function toggleFranchiseCodeField() {
                                    if (franchiseYes.checked) {
                                        franchiseCodeField.style.display = 'block';
                                        franchiseCodeInput.required = true;
                                    } else {
                                        franchiseCodeField.style.display = 'none';
                                        franchiseCodeInput.required = false;
                                        franchiseCodeInput.value = ''; // Clear the field when hidden
                                    }
                                }

                                franchiseYes.addEventListener('change', toggleFranchiseCodeField);
                                franchiseNo.addEventListener('change', toggleFranchiseCodeField);
                                
                                // Initialize on page load
                                toggleFranchiseCodeField();

                                // Handle franchise code from URL parameter
                                const urlParams = new URLSearchParams(window.location.search);
                                const franchiseCodeFromUrl = urlParams.get('franchise_code');
                                
                                if (franchiseCodeFromUrl) {
                                    // Auto-select "Yes" for franchise code
                                    franchiseYes.checked = true;
                                    franchiseNo.checked = false;
                                    
                                    // Show the franchise code field and fill it
                                    franchiseCodeField.style.display = 'block';
                                    franchiseCodeInput.required = true;
                                    franchiseCodeInput.value = franchiseCodeFromUrl;
                                    
                                    // Make the field readonly to prevent changes
                                    franchiseCodeInput.readOnly = true;
                                    franchiseCodeInput.style.backgroundColor = '#f8f9fa';
                                    franchiseCodeInput.style.cursor = 'not-allowed';
                                    
                                    // Disable the radio buttons to prevent changes
                                    franchiseYes.disabled = true;
                                    franchiseNo.disabled = true;
                                }
                        
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
                                // Father/Mother alive dropdown logic
                                const fatherAliveSelect = document.getElementById('father_is_alive');
                                const fatherDetailsSection = document.getElementById('father_details');
                                const motherAliveSelect = document.getElementById('mother_is_alive');
                                const motherDetailsSection = document.getElementById('mother_details');
                        
                                function toggleFatherDetails() {
                                    if (!fatherAliveSelect || !fatherDetailsSection) return;
                                    fatherDetailsSection.style.display = fatherAliveSelect.value === '1' ? 'block' : 'none';
                                }
                        
                                function toggleMotherDetails() {
                                    if (!motherAliveSelect || !motherDetailsSection) return;
                                    motherDetailsSection.style.display = motherAliveSelect.value === '1' ? 'block' : 'none';
                                }
                        
                                if (fatherAliveSelect) {
                                    fatherAliveSelect.addEventListener('change', toggleFatherDetails);
                                    toggleFatherDetails();
                                }
                                if (motherAliveSelect) {
                                    motherAliveSelect.addEventListener('change', toggleMotherDetails);
                                    toggleMotherDetails();
                                }
                                /* Stepper logic */
                                const stepForms = Array.from(document.querySelectorAll('.step-form'));
                                const stepIndicators = Array.from(document.querySelectorAll('.stepper .step'));
                                let currentStep = 0;
                                const prevBtn = document.getElementById('prevBtn');
                                const nextBtn = document.getElementById('nextBtn');

                                function stepIsValid(idx) {
                                    const fields = stepForms[idx].querySelectorAll('input, select, textarea');
                                    let valid = true;
                                    fields.forEach(f => {
                                        if (!f.checkValidity()) {
                                            valid = false;
                                            f.classList.add('is-invalid');
                                        } else {
                                            f.classList.remove('is-invalid');
                                        }
                                    });
                                    return valid;
                                }

                                function showStep(idx) {
                                    stepForms.forEach((sf, i) => sf.classList.toggle('d-none', i !== idx));
                                    stepIndicators.forEach((indicator, i) => {
                                        indicator.classList.toggle('active', i === idx);
                                        indicator.classList.toggle('completed', i < idx);
                                    });
                                    prevBtn.classList.toggle('d-none', idx === 0);
                                    nextBtn.classList.toggle('d-none', idx === stepForms.length - 1);
                                    registerButton.classList.toggle('d-none', idx !== stepForms.length - 1);
                                }

                                prevBtn.addEventListener('click', () => {
                                    if (currentStep > 0) {
                                        currentStep--;
                                        showStep(currentStep);
                                    }
                                });

                                nextBtn.addEventListener('click', () => {
                                    if (!stepIsValid(currentStep)) {
                                        // focus first invalid field
                                        const firstInvalid = stepForms[currentStep].querySelector('.is-invalid');
                                        if (firstInvalid) firstInvalid.focus();
                                        return;
                                    }
                                    if (currentStep < stepForms.length - 1) {
                                        currentStep++;
                                        showStep(currentStep);
                                    }
                                });

                                showStep(currentStep);

                                // Caste and Subcaste "Other" option functionality
                                const casteSelect = document.getElementById('caste');
                                const subCasteSelect = document.getElementById('sub_caste');
                                const customCasteContainer = document.getElementById('custom_caste_container');
                                const customCasteInput = document.getElementById('custom_caste');
                                const customSubCasteContainer = document.getElementById('custom_sub_caste_container');
                                const customSubCasteInput = document.getElementById('custom_sub_caste');
                                const oldSubCaste = {!! json_encode(old('sub_caste')) !!};
                                const oldCustomCaste = {!! json_encode(old('custom_caste', '')) !!};
                                const oldCustomSubCaste = {!! json_encode(old('custom_sub_caste', '')) !!};

                                // Function to handle caste selection
                                function handleCasteChange() {
                                    if (!casteSelect) return;
                                    
                                    const selectedOption = casteSelect.options[casteSelect.selectedIndex];
                                    const selectedCasteName = selectedOption ? selectedOption.text : '';
                                    const selectedCasteId = casteSelect.value;
                                    
                                    // Show/hide custom caste input
                                    if (selectedCasteName === 'Other') {
                                        customCasteContainer.style.display = 'block';
                                        customCasteInput.required = true;
                                    } else {
                                        customCasteContainer.style.display = 'none';
                                        customCasteInput.required = false;
                                        customCasteInput.value = '';
                                    }
                                    
                                    // Load subcastes and reset subcaste selection
                                    if (selectedCasteId) {
                                        loadSubcastes(selectedCasteId);
                                    } else {
                                        subCasteSelect.innerHTML = '<option value="" disabled selected>Select Subcaste</option>';
                                    }
                                    
                                    // Hide custom subcaste input when caste changes
                                    customSubCasteContainer.style.display = 'none';
                                    customSubCasteInput.required = false;
                                    customSubCasteInput.value = '';
                                }
                                
                                // Function to handle subcaste selection
                                function handleSubCasteChange() {
                                    if (!subCasteSelect) return;
                                    
                                    const selectedOption = subCasteSelect.options[subCasteSelect.selectedIndex];
                                    const selectedSubCasteName = selectedOption ? selectedOption.text : '';
                                    
                                    // Show/hide custom subcaste input
                                    if (selectedSubCasteName === 'Other') {
                                        customSubCasteContainer.style.display = 'block';
                                        customSubCasteInput.required = true;
                                    } else {
                                        customSubCasteContainer.style.display = 'none';
                                        customSubCasteInput.required = false;
                                        customSubCasteInput.value = '';
                                    }
                                }

                                // Function to load subcastes based on selected caste
                                function loadSubcastes(casteId, selectedSubcaste = null) {
                                    if (!subCasteSelect) {
                                        console.error('SubCaste select element not found');
                                        return;
                                    }
                                    
                                    // Clear existing options
                                    subCasteSelect.innerHTML = '<option value="" disabled selected>Select Subcaste</option>';
                                    
                                    if (!casteId) {
                                        return;
                                    }
                                    
                                    // Fetch subcastes for the selected caste
                                    fetch(`/castes/${casteId}/subcastes`, {
                                        method: 'GET',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        }
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            data.forEach(subcaste => {
                                                const option = document.createElement('option');
                                                option.value = subcaste.id;
                                                option.textContent = subcaste.name;
                                                if (selectedSubcaste && selectedSubcaste == subcaste.id) {
                                                    option.selected = true;
                                                }
                                                subCasteSelect.appendChild(option);
                                            });
                                            
                                            // Check if selected subcaste is "Other" after loading
                                            if (selectedSubcaste) {
                                                setTimeout(() => {
                                                    handleSubCasteChange();
                                                }, 100);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error loading subcastes:', error);
                                        });
                                }
                                
                                // Bind events
                                if (casteSelect) {
                                    casteSelect.addEventListener('change', handleCasteChange);
                                }
                                
                                if (subCasteSelect) {
                                    subCasteSelect.addEventListener('change', handleSubCasteChange);
                                }
                                
                                // Initialize on page load
                                if (casteSelect && casteSelect.value) {
                                    // Set custom caste value if exists
                                    if (oldCustomCaste && customCasteInput) {
                                        customCasteInput.value = oldCustomCaste;
                                    }
                                    
                                    handleCasteChange();
                                    
                                    // Load subcastes with old selection
                                    if (oldSubCaste) {
                                        loadSubcastes(casteSelect.value, oldSubCaste);
                                        
                                        // Set custom subcaste value if exists
                                        if (oldCustomSubCaste && customSubCasteInput) {
                                            setTimeout(() => {
                                                customSubCasteInput.value = oldCustomSubCaste;
                                            }, 200);
                                        }
                                    }
                                }
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
