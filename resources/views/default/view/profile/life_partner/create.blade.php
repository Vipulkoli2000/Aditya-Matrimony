<x-layout.user_banner>
    <style>
        .main-container {
            display: flex;
            align-items: flex-start;
            max-width: 1200px;
            margin: 0 auto;
        }
        .form-container {
            flex: 1;
            margin-right: 20px; /* Adds space between the form and sidebar */
        }
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
        
        @media screen and (max-width: 425px) {
            .panel {
                margin: 10px auto;
                padding: 10px;
            }
            .row {
                display: flex;
                flex-wrap: wrap;
            }
            .row > .col {
                flex: 0 0 48%;
                max-width: 48%;
                margin-bottom: 10px;
            }
            .row > .col:only-child {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-left: none;
                padding: 10px;
            }
            .main-container {
                flex-direction: column;
            }
            .form-container {
                margin-right: 0;
            }
        }
    </style>
    <body>
        <div class="main-container">
            <div class="form-container">
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
                        <h3 class="text-center" style="color: #FF3846;  margin: 20px;">About Life Partner</h3>
        
                        <div class="panel">
                            <h4>Age / Height Information</h4>
                            <div class="container mt-3" id="dropdowns">
                                <div class="row">
                                    @if($user->role === 'bride')
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partner_min_age">Min Age</label>
                                            <select name="partner_min_age" id="partner_min_age" class="form-input">
                                                <option value="" selected>select an option</option>
                                                @if (config('data.partner_min_age'))
                                                    @foreach (config('data.partner_min_age') as $value => $name)
                                                        <option value="{{$value}}" {{ ($user->partner_min_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('partner_min_age'))
                                            <span class="text-danger small">{{ $errors->first('partner_min_age') }}</span>
                                            @endif  
                                        </div>
                                    </div>
                                    @else 
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partner_min_age">Min Age</label>
                                            <select name="partner_min_age" id="partner_min_age" class="form-input">
                                                <option value="" selected>select an option</option>
                                                @if (config('data.bride_min_age'))
                                                    @foreach (config('data.bride_min_age') as $value => $name)
                                                        <option value="{{$value}}" {{ ($user->partner_min_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('partner_min_age'))
                                            <span class="text-danger small">{{ $errors->first('partner_min_age') }}</span>
                                            @endif  
                                        </div>
                                    </div>
                                    @endif
                                   
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partner_max_age">Max Age</label>
                                            <select name="partner_max_age" id="partner_max_age" class="form-input">
                                                <option value="" selected>select an option</option>
                                                @if (config('data.partner_max_age'))
                                                    @foreach (config('data.partner_max_age') as $value => $name)
                                                        <option value="{{$value}}" {{ ($user->partner_max_age === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('partner_max_age'))
                                            <span class="text-danger small">{{ $errors->first('partner_max_age') }}</span>
                                            @endif  
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partner_min_height">Min Height</label>
                                            <select name="partner_min_height" id="partner_min_height" class="form-input">
                                                <option value="" selected>select an option</option>
                                                @if (config('data.partner_min_height'))
                                                    @foreach (config('data.partner_min_height') as $value => $name)
                                                        <option value="{{$value}}" {{ ($user->partner_min_height === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('partner_min_height'))
                                            <span class="text-danger small">{{ $errors->first('partner_min_height') }}</span>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="partner_max_height">Max Height</label>
                                            <select name="partner_max_height" id="partner_max_height" class="form-input">
                                                <option value="" selected>select an option</option>
                                                @if (config('data.partner_max_height'))
                                                    @foreach (config('data.partner_max_height') as $value => $name)
                                                        <option value="{{$value}}" {{ ($user->partner_max_height === $value) ? 'selected' : ''}} >{{ $name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('partner_max_height'))
                                            <span class="text-danger small">{{ $errors->first('partner_max_height') }}</span>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="panel">
                            <h4>Expected Information About Partners</h4>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_income">Partner Income in INR(Anually)</label>
                                        <input type="text" name="partner_income" value="{{ $user->partner_income }}" id="partner_income" placeholder="Enter Native Place">
                                        @if ($errors->has('partner_income'))
                                            <span class="text-danger small">{{ $errors->first('partner_income') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="want_to_see_patrika">Want to see Patrika</label>
                                        <select class="form-input" name="want_to_see_patrika" id="want_to_see_patrika">
                                            <option value="" selected>Select an option</option>
                                            <option value="yes" {{ $user->want_to_see_patrika === 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $user->want_to_see_patrika === 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @if ($errors->has('want_to_see_patrika'))
                                            <span class="text-danger small">{{ $errors->first('want_to_see_patrika') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_eating_habbit">Eating Habits</label>
                                        <select class="form-input" name="partner_eating_habbit" id="partner_eating_habbit">
                                            <option value="" selected>Select an option</option>
                                            @foreach (config('data.partner_eating_habbit', []) as $value => $name)
                                                <option value="{{ $value }}" {{ ($user->partner_eating_habbit === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('partner_eating_habbit'))
                                            <span class="text-danger small">{{ $errors->first('partner_eating_habbit') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_city_preference">City Preference</label>
                                        <input type="text" name="partner_city_preference" value="{{ $user->partner_city_preference }}" id="partner_city_preference" placeholder="Enter City Preference">
                                        @if ($errors->has('partner_city_preference'))
                                            <span class="text-danger small">{{ $errors->first('partner_city_preference') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_education">Education</label>
                                        <input type="text" name="partner_education" value="{{ $user->partner_education }}" id="partner_education" placeholder="Enter Education">
                                        @if ($errors->has('partner_education'))
                                            <span class="text-danger small">{{ $errors->first('partner_education') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_job">Job</label>
                                        <select class="form-input" name="partner_job" id="partner_job">
                                            <option value="" selected>Select an option</option>
                                            <option value="yes" {{ $user->partner_job === 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $user->partner_job === 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @if ($errors->has('partner_job'))
                                            <span class="text-danger small">{{ $errors->first('partner_job') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_business">Business</label>
                                        <select class="form-input" name="partner_business" id="partner_business">
                                            <option value="" selected>Select an option</option>
                                            <option value="yes" {{ $user->partner_business === 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $user->partner_business === 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @if ($errors->has('partner_business'))
                                            <span class="text-danger small">{{ $errors->first('partner_business') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="partner_foreign_resident">Foreign Resident</label>
                                        <select class="form-input" name="partner_foreign_resident" id="partner_foreign_resident">
                                            <option value="" selected>Select an option</option>
                                            <option value="yes" {{ $user->partner_foreign_resident === 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $user->partner_foreign_resident === 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @if ($errors->has('partner_foreign_resident'))
                                            <span class="text-danger small">{{ $errors->first('partner_foreign_resident') }}</span>
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
            </div>
          
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
</x-layout.user_banner>
