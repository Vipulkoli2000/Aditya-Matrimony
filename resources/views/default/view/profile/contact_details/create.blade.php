<x-layout.user_banner>
    <style>
        .panel {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px; 
            margin: 20px auto; 
        }
        .panel h2 {
            margin-bottom: 15px;
            text-align: center;
            color: #333;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 20px; 
            margin-bottom: 10px;
        }
        .form-group {
            flex: 1; 
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f7f7f7;
        }
        .hidden {
            display: none;
        }
        .sidebar {
            width: 300px; 
            position: sticky;
            top: 0; 
            height: 100vh; 
            background-color: #f5f5f5; 
            padding: 15px;
            border-left: 1px solid #ddd; 
        }

        /*progress bar */
        .profile-completion {
            width: 80%;  
            margin: 0 auto;  
        }
        .progress {
            height: 30px;  
        }
        button.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
            border: none; /* Optional: remove border */
        }

        /* Responsive adjustments for screens up to 425px wide */
        @media screen and (max-width: 425px) {
            .panel {
                padding: 10px;
                margin: 10px;
                max-width: 100%;
            }
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            .profile-completion {
                width: 95%;
            }
            /* Instead of hiding the sidebar, position it off-canvas */
            .sidebar {
                position: fixed;
                top: 0;
                left: -80%;
                width: 80%;
                height: 100%;
                background-color: #f5f5f5;
                padding: 15px;
                border-left: none;
                border-right: 1px solid #ddd;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .sidebar.show {
                left: 0;
            }
            /* Sidebar toggle button */
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                background-color: #ff3846;
                color: #fff;
                border: none;
                padding: 8px 12px;
                border-radius: 4px;
                z-index: 1100;
                cursor: pointer;
            }
        }

        /* Flex container to position the form and sidebar side-by-side */
        .flex-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .flex-container > form {
            flex: 1;
            margin-right: 20px;
        }
    </style>

    <div class="flex-container">
        <form action="{{ route('profiles.store') }}" method="POST">
            @csrf
            <input type="hidden" name="redirect_url" id="redirect_url" value="">

            <div>
                <div class="profile-completion">
                    <h2>Profile Completion</h2>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                             style="width: {{ $profileCompletion }}%;" 
                             aria-valuenow="{{ $profileCompletion }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ $profileCompletion }}%
                        </div>
                    </div>
                </div>
                <h3 class="text-center" style="color: #FF3846;  margin: 20px;">Contact Details</h3>

                <div class="panel">
                    <h4>Location Information</h4>
                    <div class="container mt-3" id="dropdowns">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-input" name="country" id="country">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.country', []) as $value => $name)
                                            <option value="{{ $value }}" {{ ($user->country === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="text-danger small">{{ $errors->first('country') }}</span>
                                    @endif  
                                </div>
                            </div>
                            <div class="col hidden" id="stateContainer">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-input" name="state" id="state">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.state', []) as $value => $name)
                                            <option value="{{ $value }}" {{ ($user->state === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                        <span class="text-danger small">{{ $errors->first('state') }}</span>
                                    @endif  
                                </div>
                            </div>
                            <div class="col hidden" id="cityContainer">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="{{ $user->city }}" id="city" placeholder="Enter City" >
                                    @if ($errors->has('city'))
                                        <span class="text-danger small">{{ $errors->first('city') }}</span>
                                    @endif  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h4>Address / Contact Information</h4>
                    <div class="container mt-3">
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="address_line_1" class="form-label">Address Line 1</label>
                                <input type="text" name="address_line_1" value="{{ $user->address_line_1 }}" id="address_line_1" class="form-control" placeholder="Enter Address Line 1">
                                @if ($errors->has('address_line_1'))
                                    <span class="text-danger small">{{ $errors->first('address_line_1') }}</span>
                                @endif  
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" name="address_line_2" value="{{ $user->address_line_2 }}" id="address_line_2" class="form-control" placeholder="Enter Address Line 2">
                                @if ($errors->has('address_line_2'))
                                    <span class="text-danger small">{{ $errors->first('address_line_2') }}</span>
                                @endif  
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="landmark" class="form-label">Landmark</label>
                                    <input type="text" name="landmark" value="{{ $user->landmark }}" id="landmark" class="form-control" placeholder="Enter Landmark">
                                    @if ($errors->has('landmark'))
                                        <span class="text-danger small">{{ $errors->first('landmark') }}</span>
                                    @endif  
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input type="text" name="pincode" value="{{ $user->pincode }}" id="pincode" class="form-control" placeholder="Enter Pincode">
                                    @if ($errors->has('pincode'))
                                        <span class="text-danger small">{{ $errors->first('pincode') }}</span>
                                    @endif  
                                </div>
                            </div>
                        </div>  
                        <div class="row mt-3">
                            <div class="col">
                                <div class="col">
                                    <div class="form-group">
                                      <label for="mobile" class="form-label">Mobile</label>
                                      <input name="mobile" type="text" id="mobile" class="form-control" 
                                             placeholder="1234567890"
                                             value="{{ $user->mobile }}" 
                                             title="Please enter a valid 10-digit mobile number">
                                      @if ($errors->has('mobile'))
                                        <span class="text-danger small">{{ $errors->first('mobile') }}</span>
                                      @endif  
                                    </div>
                                  </div>
                                  
                                  <script>
                                  document.addEventListener("DOMContentLoaded", function() {
                                    const mobileInput = document.getElementById("mobile");
                                  
                                    // Case 1: When the user types the first digit into an empty field,
                                    // automatically insert "+91" before that digit.
                                    mobileInput.addEventListener("keydown", function(e) {
                                      if (mobileInput.value === "" && /^[0-9]$/.test(e.key)) {
                                        e.preventDefault();
                                        mobileInput.value = "+91" + e.key;
                                        mobileInput.setSelectionRange(mobileInput.value.length, mobileInput.value.length);
                                      }
                                    });
                                  
                                    // Case 2: Add "+91" if the value starts with a digit but doesn't already have the prefix.
                                    mobileInput.addEventListener("blur", function() {
                                      let value = mobileInput.value.trim();
                                      if (value && /^[0-9]/.test(value) && !value.startsWith('+91')) {
                                        mobileInput.value = "+91" + value;
                                      }
                                    });
                                  });
                                  </script>
                                  
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="landline">Landline</label>
                                    <input type="text" name="landline" value="{{ $user->landline }}" id="landline" placeholder="Enter Landline" >
                                    @if ($errors->has('landline'))
                                        <span class="text-danger small">{{ $errors->first('landline') }}</span>
                                    @endif  
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">  
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" 
                                       placeholder="example@example.com"
                                       value="{{ $user->email }}"
                                       title="Please enter a valid email address">
                                @if ($errors->has('email'))
                                    <span class="text-danger small">{{ $errors->first('email') }}</span>
                                @endif  
                            </div>
                        </div>
                    </div>
                </div>  

                <div class="container text-end">
                    <button type="submit" class="btn btn-primary btn-sm p-2">Save</button>
                </div>
            </div>
        </form>

        <div class="sidebar">
            <x-common.usersidebar />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countryDropdown = document.getElementById('country');
            const stateContainer = document.getElementById('stateContainer');
            const cityContainer = document.getElementById('cityContainer');
            const stateDropdown = document.getElementById('state');
            const cityInput = document.getElementById('city');

            function toggleStateCity() {
                if (countryDropdown.value === 'india') {
                    stateContainer.classList.remove('hidden');
                    cityContainer.classList.remove('hidden');
                } else {
                    stateContainer.classList.add('hidden');
                    cityContainer.classList.add('hidden');
                    stateDropdown.value = '';
                    cityInput.value = '';
                }
            }

            toggleStateCity();
            countryDropdown.addEventListener('change', toggleStateCity);
        });
        
        // Toggle sidebar visibility on small screens
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
      <div id="customModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: #ffcccc; border: 2px solid #ff0000; border-radius: 8px; padding: 20px; max-width: 400px; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
          <p>You have unsaved changes. Save Changes?</p>
          <div style="margin-top: 20px;">
            <button id="modalYes" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">Yes</button>
            <button id="modalNo" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">No, leave without saving</button>
          </div>
        </div>
      </div>
      
      <script>
        let isDirty = false;
        let pendingUrl = null;
        const form = document.querySelector('form');
        const submitButton = document.querySelector('button[type="submit"]');
        const redirectInput = document.getElementById('redirect_url');
      
        // Mark form as dirty when any input changes.
        document.querySelectorAll('input, select, textarea').forEach((element) => {
          element.addEventListener('change', () => {
            isDirty = true;
          });
        });
      
        // When user clicks on any link, check if form is dirty.
        document.querySelectorAll('a').forEach((link) => {
          link.addEventListener('click', function (e) {
            if (isDirty) {
              e.preventDefault();
              pendingUrl = this.href; // save the intended URL
              showModal();
            }
          });
        });
      
        // When the form is submitted, reset isDirty.
        form.addEventListener('submit', function () {
          isDirty = false;
        });
      
        function showModal() {
          document.getElementById('customModal').style.display = 'flex';
        }
        
        function hideModal() {
          document.getElementById('customModal').style.display = 'none';
        }
      
        // On clicking "Yes": set the hidden input and submit the form.
        document.getElementById('modalYes').addEventListener('click', function () {
          hideModal();
          if (pendingUrl) {
            redirectInput.value = pendingUrl;
          }
          submitButton.click();
        });
      
        // On clicking "No": just close the modal.
        // On clicking "No": just close the modal.
    document.getElementById('modalNo').addEventListener('click', function () {
      hideModal();
      isDirty = false;
      if (pendingUrl) {
        window.location.href = pendingUrl;
      }
    });
        
      </script>
</x-layout.user_banner>
