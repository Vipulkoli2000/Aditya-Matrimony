<x-layout.user_banner>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Father Details</title>
        <style>
            /* Existing global styles remain unchanged ... */
        
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
        
            .form-group input, 
            .form-group select, 
            .form-group textarea {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f7f7f7;
            }
        
            /* Initially hide fields as needed */
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
        
            .profile-completion {
                width: 80%;
                margin: 0 auto;
            }
        
            .progress {
                height: 30px;
            }
        
            button.btn {
                background-color: #ff0000;
                color: white !important;
                border: none;
            }
        
            .flex-container {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                justify-content: space-between;
            }
        
            .flex-container form {
                flex: 1;
                margin-right: 20px;
            }
        
            /* Responsive adjustments for screens between 320px and 425px */
            @media (min-width: 320px) and (max-width: 425px) {
                .flex-container {
                    flex-direction: column;
                    align-items: center;  /* Center the children */
                    padding: 10px;
                }
                .panel {
                    margin: 10px;
                    padding: 15px;
                    width: 100%;  /* Ensure panels take full width */
                }
                .form-row {
                    flex-direction: column;
                    gap: 10px;
                }
                .sidebar {
                    width: 100%;
                    position: relative;
                    height: auto;
                    border: none;
                    margin-top: 20px;
                }
                .profile-completion {
                    width: 100%;
                    text-align: center;
                }
            }
        
            /* Fallback adjustments for screens up to 768px */
            @media screen and (max-width: 768px) {
                .flex-container {
                    flex-direction: column;
                }
                .flex-container form {
                    margin-right: 0;
                }
                .profile-completion {
                    width: 90%;
                }
                .sidebar {
                    width: 100%;
                    position: relative;
                    height: auto;
                    border-left: none;
                    border-top: 1px solid #ddd;
                    margin-top: 20px;
                }
                .form-row {
                    flex-direction: column;
                    gap: 10px;
                }
            }
        </style>
        
        
    </head>
    <body>
        <div class="flex-container">
            <form action="{{ route('profiles.family_details_store') }}" method="POST">
                @csrf
                  <!-- Add this hidden field for redirection -->
    <input type="hidden" name="redirect_url" id="redirect_url" value="">
                <div>
                    <div class="profile-completion">
                        <h2>Profile Completion</h2>
                        <div class="progress" style="background-color: transparent; border: 2px solid #60B5FF; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $profileCompletion }}%; background-color: #60B5FF;" 
                                 aria-valuenow="{{ $profileCompletion }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ $profileCompletion }}%
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center" style="color: #60B5FF;  margin: 20px;">Family Background</h3>
                    <div class="panel">
                        <h2>Father Details</h2>
                        {{-- @if(auth()->user() && auth()->user()->hasVerifiedEmail())
                        <p>Email verified</p>
                        @endif --}}
                        <div class="form-row">
                            <div class="form-group">
                                <label for="father_is_alive">Father is Alive</label>
                                <select class="form-input" name="father_is_alive" id="father_is_alive">
                                    <option value="" selected>Select an option</option>
                                    <option value="1" {{ $user->father_is_alive === 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $user->father_is_alive === 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @if ($errors->has('father_is_alive'))
                                    <span class="text-danger small">{{ $errors->first('father_is_alive') }}</span>
                                @endif        
                            </div>
                        </div>
                        
                        <div class="form-row" id="father_details">
                            <!-- First Row -->
                            <div class="form-row"> <!-- Wrapper for the row -->
                                <!-- First Column: Father Name -->
                                <div class="form-group col-md-6">
                                    <label for="father_name">Father Name</label>
                                    <input type="text" class="form-input" name="father_name" value="{{ $user->father_name }}" id="father_name" placeholder="Enter Father Name">
                                    @if ($errors->has('father_name'))
                                        <span class="text-danger small">{{ $errors->first('father_name') }}</span>
                                    @endif   
                                </div>
                            
                                <!-- Second Column: Father Occupation -->
                                <div class="form-group col-md-6">
                                    <label for="father_occupation">Occupation</label>
                                    <select class="form-input" name="father_occupation" id="father_occupation">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.father_occupation') as $value => $name)
                                            <option value="{{$value}}" {{ ($user->father_occupation === $value) ? 'selected' : ''}}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('father_occupation'))
                                        <span class="text-danger small">{{ $errors->first('father_occupation') }}</span>
                                    @endif   
                                </div>
                            </div>
                            
                        
                            <!-- Second Row -->
                            <div class="form-row"> <!-- Wrapper for the row -->
                                <!-- First Column: Father Job Type -->
                                <div class="form-group col-md-6">
                                    <label for="father_job_type">Job Type</label>
                                    <select class="form-input" name="father_job_type" id="father_job_type">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.job_type') as $value => $name)
                                            <option value="{{$value}}" {{ ($user->father_job_type === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('father_job_type'))
                                        <span class="text-danger small">{{ $errors->first('father_job_type') }}</span>
                                    @endif   
                                </div>
                                
                                <!-- Second Column: Father Organization -->
                                <div class="form-group col-md-6">
                                    <label for="father_organization">Organisation Name</label>
                                    <input type="text" class="form-input" name="father_organization" value="{{ $user->father_organization }}" id="father_organization" placeholder="Enter Organisation Name">
                                    @if ($errors->has('father_organization'))
                                        <span class="text-danger small">{{ $errors->first('father_organization') }}</span>
                                    @endif   
                                </div>
                            </div>
                            
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const fatherAliveSelect = document.getElementById('father_is_alive');
                                const fatherDetailsSection = document.getElementById('father_details');
                                const fatherNameField = document.getElementById('father_name');
                                const fatherOccupationField = document.getElementById('father_occupation');
                                const fatherJobTypeField = document.getElementById('father_job_type');
                                const fatherOrganizationField = document.getElementById('father_organization');
                        
                                // Function to toggle visibility of father details and reset values if necessary
                                function toggleFatherDetails() {
                                    if (fatherAliveSelect.value === '1') {
                                        // Show the details if father is alive
                                        fatherDetailsSection.style.display = 'block';
                                    } else {
                                        // Hide the details if father is not alive
                                        fatherDetailsSection.style.display = 'none';
                        
                                        // Reset the values to null when father is not alive
                                        fatherNameField.value = '';
                                        fatherOccupationField.value = '';
                                        fatherJobTypeField.value = '';
                                        fatherOrganizationField.value = '';
                                    }
                                }
                        
                                // Initial call to set visibility based on the current value
                                toggleFatherDetails();
                        
                                // Event listener for changes in the "Father is Alive" dropdown
                                fatherAliveSelect.addEventListener('change', toggleFatherDetails);
                            });
                        </script>
                        
                    </div>
                    <div class="panel">
                        <h2>Mother Details</h2>
                    
                        <div class="form-row">
                            <div class="form-group">
                                <label for="mother_is_alive">Is Alive</label>
                                <select class="form-input" name="mother_is_alive" id="mother_is_alive">
                                    <option value="" selected>Select an option</option>
                                    <option value="1" {{ $user->mother_is_alive === 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $user->mother_is_alive === 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @if ($errors->has('mother_is_alive'))
                                    <span class="text-danger small">{{ $errors->first('mother_is_alive') }}</span>
                                @endif   
                            </div>
                        </div>
                        
                        <!-- Additional fields, initially hidden -->
                        <div class="form-row" id="mother_details">
                        
                            <!-- First Column: Full Name and Occupation -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="mother_name">Full Name</label>
                                    <input class="form-input" name="mother_name" value="{{ $user->mother_name }}" id="mother_name" placeholder="Enter Mother Name">
                                    @if ($errors->has('mother_name'))
                                        <span class="text-danger small">{{ $errors->first('mother_name') }}</span>
                                    @endif   
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <label for="mother_occupation">Occupation</label>
                                    <select class="form-input" name="mother_occupation" id="mother_occupation">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.mother_occupation') as $value => $name)
                                            <option value="{{$value}}" {{ ($user->mother_occupation === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('mother_occupation'))
                                        <span class="text-danger small">{{ $errors->first('mother_occupation') }}</span>
                                    @endif   
                                </div>
                            </div>
                            
                        
                            <!-- Second Column: Job Type and Organization Name -->
                            <div class="form-row">
                                <!-- First Column: Job Type -->
                                <div class="form-group col-md-6">
                                    <label for="mother_job_type">Job Type</label>
                                    <select class="form-input" name="mother_job_type" id="mother_job_type">
                                        <option value="" selected>Select an option</option>
                                        @foreach (config('data.job_type') as $value => $name)
                                            <option value="{{$value}}" {{ ($user->mother_job_type === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('mother_job_type'))
                                        <span class="text-danger small">{{ $errors->first('mother_job_type') }}</span>
                                    @endif   
                                </div>
                            
                                <!-- Second Column: Organization Name -->
                                <div class="form-group col-md-6">
                                    <label for="mother_organization">Organization Name</label>
                                    <input type="text" name="mother_organization" value="{{ $user->mother_organization }}" id="mother_organization" placeholder="Enter Organization Name">
                                    @if ($errors->has('mother_organization'))
                                        <span class="text-danger small">{{ $errors->first('mother_organization') }}</span>
                                    @endif   
                                </div>
                            </div>
                            
                        
                        </div>
                        
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const motherAliveSelect = document.getElementById('mother_is_alive');
                                const motherDetailsSection = document.getElementById('mother_details');
                                const motherNameField = document.getElementById('mother_name');
                                const motherOccupationField = document.getElementById('mother_occupation');
                                const motherJobTypeField = document.getElementById('mother_job_type');
                                const motherOrganizationField = document.getElementById('mother_organization');
                        
                                // Function to toggle visibility and reset values of mother-related details
                                function toggleMotherDetails() {
                                    if (motherAliveSelect.value === '1') {
                                        // Show mother details if she is alive
                                        motherDetailsSection.style.display = 'block';
                                    } else {
                                        // Hide mother details and reset values if she is not alive
                                        motherDetailsSection.style.display = 'none';
                        
                                        // Reset the values to null when mother is not alive
                                        motherNameField.value = '';
                                        motherOccupationField.value = '';
                                        motherJobTypeField.value = '';
                                        motherOrganizationField.value = '';
                                    }
                                }
                        
                                // Initial call to set visibility and reset values based on current state
                                toggleMotherDetails();
                        
                                // Add event listener for changes in the "Mother is Alive" dropdown
                                motherAliveSelect.addEventListener('change', toggleMotherDetails);
                            });
                        </script>
                        
                        <style>
                            .form-row {
                                display: flex;
                                justify-content: space-between;
                            }
                            .form-group {
                                flex: 1;
                                margin-right: 20px; /* Add some space between fields */
                            }
                            .form-group:last-child {
                                margin-right: 0; /* Remove right margin from last field */
                            }
                        </style>
                        <div class="form-row">
                              <!-- Mother Name Before Marriage Field -->
                              <div class="form-group">
                                <label for="mother_name_before_marriage">Mother Name Before Marriage</label>
                                <input type="text" name="mother_name_before_marriage" value="{{ $user->mother_name_before_marriage }}" id="mother_name_before_marriage" placeholder="Enter Mother Name Before Marriage" class="form-control">
                                @if ($errors->has('mother_name_before_marriage'))
                                    <span class="text-danger small">{{ $errors->first('mother_name_before_marriage') }}</span>
                                @endif
                            </div>
                            <!-- Native Place Field -->
                            <div class="form-group">
                                <label for="mother_native_place">Native Place</label>
                                <input type="text" name="mother_native_place" value="{{ $user->mother_native_place }}" id="mother_native_place" placeholder="Enter Native Place" class="form-control">
                                @if ($errors->has('mother_native_place'))
                                    <span class="text-danger small">{{ $errors->first('mother_native_place') }}</span>
                                @endif
                            </div>
                        
                          
                        </div>
                    </div>
                    <div class="panel">
                        <h2>Brother Details</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="brother_resident_place">Resident Place</label>
                                <input type="text" class="form-input" name="brother_resident_place"  value="{{ $user->brother_resident_place }}" id="brother_resident_place" placeholder="Enter Resident Place" >
                                @if ($errors->has('brother_resident_place'))
                                <span class="text-danger small">{{ $errors->first('brother_resident_place') }}</span>
                                @endif             
                            </div>
                             <div class="form-group">
                                <label for="number_of_brothers_married">Brother Married</label>
                                <select name="number_of_brothers_married" id="number_of_brothers_married" class="form-input">
                                    <option value="" selected>Select an option</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($user->number_of_brothers_married == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Brothers' : 'Brother' }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('number_of_brothers_married'))
                                <span class="text-danger small">{{ $errors->first('number_of_brothers_married') }}</span>
                                @endif   
                            </div>
                            
                            <div class="form-group">
                                <label for="number_of_brothers_unmarried">Brother UnMarried</label>
                                <select name="number_of_brothers_unmarried" id="number_of_brothers_unmarried" class="form-input">
                                    <option value="" selected>Select an option</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($user->number_of_brothers_unmarried == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Brothers' : 'Brother' }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('number_of_brothers_unmarried'))
                                <span class="text-danger small">{{ $errors->first('number_of_brothers_unmarried') }}</span>
                                @endif   
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <h2>Sister Details</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="sister_resident_place">Resident Place</label>
                                <input class="form-input" name="sister_resident_place"  value="{{ $user->sister_resident_place }}" id="sister_resident_place" placeholder="Enter Resident Place" >
                                @if ($errors->has('sister_resident_place'))
                                <span class="text-danger small">{{ $errors->first('sister_resident_place') }}</span>
                                @endif   
                             </div>
                             <div class="form-group">
                                <label for="number_of_sisters_married">Sister Married</label>
                                <select name="number_of_sisters_married" id="number_of_sisters_married" class="form-input">
                                    <option value="" selected>Select an option</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($user->number_of_sisters_married == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Sisters' : 'Sister' }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('number_of_sisters_married'))
                                <span class="text-danger small">{{ $errors->first('number_of_sisters_married') }}</span>
                                @endif   
                            </div>
                            <div class="form-group">
                                <label for="number_of_sisters_unmarried">Sister UnMarried</label>
                                <select name="number_of_sisters_unmarried" id="number_of_sisters_unmarried" class="form-input">
                                    <option value="" selected>Select an option</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ ($user->number_of_sisters_unmarried == $i) ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Sisters' : 'Sister' }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('number_of_sisters_unmarried'))
                                <span class="text-danger small">{{ $errors->first('number_of_sisters_unmarried') }}</span>
                                @endif   
                            </div>
                        </div>
                    </div>


                    <div class="panel">
                        <h2>About Parents</h2>
                        <div class="panel">
                            <div class="form-group">
                                <label for="about_parents">About Parents</label>
                                <textarea name="about_parents" id="about_parents" class="form-input" placeholder="Tell us About Parents..." >{{ old('about_parents', $user->about_parents) }}</textarea>
                                @if ($errors->has('about_parents'))
                                <span class="text-danger small">{{ $errors->first('about_parents') }}</span>
                                @endif   
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
         
        </div>

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
          
    </body>
    </html>

    {{-- end --}}
</x-layout.user_banner>
