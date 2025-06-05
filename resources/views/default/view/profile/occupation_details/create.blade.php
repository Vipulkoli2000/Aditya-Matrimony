<x-layout.user_banner>
    <style>
        .container-layout {
            display: flex;
            gap: 20px; /* Optional: adjust spacing between form and sidebar */
            max-width: 1200px; /* Adjust as needed */
            margin: 0 auto;
        }
        .form-container {
            flex: 1;
        }
        .panel {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
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
        .form-group textarea {
            height: 100px;
        }
        .btn-save {
            display: block;
            width: 100%;
            margin-top: 20px;
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
        /* Media query for responsiveness on devices with width between 320px and 425px */
        @media only screen and (max-width: 425px) {
            .container-layout {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                border-left: none;
                margin-top: 20px;
            }
            .progress {
                height: 20px;
            }
            .progress-bar {
                font-size: 12px;
            }
        }
    </style>
    <div class="container-layout">
        <div class="form-container">
            <form action="{{ route('profiles.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_url" id="redirect_url" value="">

                <div>
                    <div class="profile-completion">
                        <h2>Profile Completion</h2>
                        <div class="progress" style="background-color: transparent; border: 2px solid #60B5FF; border-radius: 10px;">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $profileCompletion }}%; background-color: #60B5FF;  border-radius: 10px; line-height: 20px; color: white;" 
                                 aria-valuenow="{{ $profileCompletion }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ $profileCompletion }}%
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center" style="color: #60B5FF; margin: 20px;">Occupation Details</h3>
                    <div class="panel">
                        <h4>Organisation Information</h4>
                        <div class="container mt-3" id="dropdowns">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <select name="occupation" id="occupation">
                                            <option value="" selected>Select an option</option>
                                            @foreach (config('data.occupation', []) as $value => $name)
                                                <option value="{{$value}}" {{ ($user->occupation === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('occupation'))
                                        <span class="text-danger small">{{ $errors->first('occupation') }}</span>
                                        @endif  
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="organization">Organisation</label>
                                        <input type="text" name="organization" value="{{$user->organization}}" id="organization" class="form-control" placeholder="Enter Organization">
                                        @if ($errors->has('organization'))
                                        <span class="text-danger small">{{ $errors->first('organization') }}</span>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" value="{{$user->designation}}" id="designation" class="form-control" placeholder="Enter designation">
                                        @if ($errors->has('designation'))
                                        <span class="text-danger small">{{ $errors->first('designation') }}</span>
                                        @endif  
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="job_location">Job Location</label>
                                        <input type="text" name="job_location" value="{{$user->job_location}}" id="job_location" class="form-control" placeholder="Enter job location">
                                        @if ($errors->has('job_location'))
                                        <span class="text-danger small">{{ $errors->first('job_location') }}</span>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="panel">
                        <h4>Experience / Income Information</h4>
                        <div class="container mt-3" id="dropdowns">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="income">Income (INR)</label>
                                        <input type="text" name="income" value="{{$user->income}}" id="income" class="form-control" placeholder="Enter income">
                                        <x-input-error :messages="$errors->get('income')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="job_experience">Job Experience (months)</label>
                                        <input type="text" name="job_experience" value="{{$user->job_experience}}" id="job_experience" class="form-control" placeholder="Enter Job Experience">
                                        @if ($errors->has('job_experience'))
                                        <span class="text-danger small">{{ $errors->first('job_experience') }}</span>
                                        @endif  
                                    </div>
                                </div>
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
            <div style="background: #ffcccc; border: 2px solid #ff0000; border-radius: 8px; padding: 20px; max-width: 400px; text-align: center;">
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
        
          // Mark the form as dirty when any input changes.
          document.querySelectorAll('input, select, textarea').forEach((element) => {
            element.addEventListener('change', () => {
              isDirty = true;
            });
          });
        
          // Intercept clicks on links if there are unsaved changes.
          document.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', function (e) {
              if (isDirty) {
                e.preventDefault();
                pendingUrl = this.href; // store the target URL
                showModal();
              }
            });
          });
        
          // When the form is submitted, reset the isDirty flag.
          form.addEventListener('submit', function () {
            isDirty = false;
          });
        
          function showModal() {
            document.getElementById('customModal').style.display = 'flex';
          }
          
          function hideModal() {
            document.getElementById('customModal').style.display = 'none';
          }
        
          // Yes button: Set redirect_url and submit the form.
          document.getElementById('modalYes').addEventListener('click', function () {
            hideModal();
            if (pendingUrl) {
              redirectInput.value = pendingUrl;
            }
            submitButton.click();
          });
        
          // No button: Just close the modal; user remains on the page.
         // On clicking "No": just close the modal.
    document.getElementById('modalNo').addEventListener('click', function () {
      hideModal();
      isDirty = false;
      if (pendingUrl) {
        window.location.href = pendingUrl;
      }
    });
        </script>
        
          
    </div>
</x-layout.user_banner>
