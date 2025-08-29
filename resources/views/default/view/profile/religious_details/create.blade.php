<x-layout.user_banner>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Information Panel</title>
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
                text-align: center;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }
            .form-group input, .form-group select, .form-group textarea {
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
            /* Initially hide drinking and smoking habit fields */
            .hidden {
                display: none;
            }
            .sidebar {
                width: 280px;
                min-width: 280px;
                max-width: 280px;
                position: sticky;
                top: 20px; /* Position below navbar */
                height: auto;
                background-color: transparent;
                padding: 0;
                border-left: none;
            }
            /* Decrease width by 20% */
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
            /* New container to hold the form and sidebar side by side */
            .main-container {
                display: flex;
                gap: 20px;
                justify-content: center;
            }
            .main-container > form {
                flex: 1;
                max-width: 900px;
            }
            /* Mobile Responsive Styles */
            @media screen and (max-width: 768px) {
                .panel {
                    max-width: 100%;
                    margin: 10px;
                    padding: 15px;
                }
                .form-row {
                    flex-direction: column;
                    gap: 10px;
                }
                .profile-completion {
                    width: 90%;
                }
                .sidebar {
                    width: 100%;
                    position: relative;
                    height: auto;
                    margin-top: 20px;
                    border-left: none;
                    border-top: 1px solid #ddd;
                }
                .main-container {
                    display: block;
                }
            }
        </style>
    </head>
    <body>
        <div class="main-container">
            <form action="{{ route('profiles.religious_details_store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                  <!-- Add this hidden field for redirection -->
    <input type="hidden" name="redirect_url" id="redirect_url" value="">
                <div class="l">
                    <div class="profile-completion">
                        <h3>Profile Completion</h3>
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
                    <div class="panel">
                        <h2 style="color: #60B5FF;">Religious Details</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select class="form-input" name="religion" id="religion" disabled>
                                    <option value="hindu" selected>Hindu</option>
                                </select>
                                
                                <!-- Hidden input to ensure 'religion' is sent with the form -->
                                <input type="hidden" name="religion" value="hindu">
                        
                                @if ($errors->has('religion'))
                                    <span class="text-danger small">{{ $errors->first('religion') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-row" id="habitsRow">
                            <div class="form-group">
                                <label for="caste">Caste</label>
                                <select class="form-input" name="caste" id="caste">
                                    <option value="">Select Caste</option>
                                    @foreach($castes as $caste)
                                        <option value="{{ $caste->id }}" {{ $user->caste == $caste->id ? 'selected' : '' }}>
                                            {{ $caste->name }}
                                        </option>
                                    @endforeach
                                </select> 
                                @if ($errors->has('caste'))
                                    <span class="text-danger small">{{ $errors->first('caste') }}</span>
                                @endif
                                
                                <!-- Custom Caste Input (hidden by default) -->
                                <div id="custom_caste_container" style="display: none; margin-top: 10px;">
                                    <input type="text" name="custom_caste" value="{{ old('custom_caste', $user->custom_caste) }}" id="custom_caste" placeholder="Please specify your caste">
                                    @if ($errors->has('custom_caste'))
                                        <span class="text-danger small">{{ $errors->first('custom_caste') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="sub_caste">Sub-Caste</label>
                                <select class="form-input" name="sub_caste" id="sub_caste">
                                    <option value="">Select Sub-Caste</option>
                                </select>
                                @if ($errors->has('sub_caste'))
                                    <span class="text-danger small">{{ $errors->first('sub_caste') }}</span>
                                @endif
                                
                                <!-- Custom SubCaste Input (hidden by default) -->
                                <div id="custom_sub_caste_container" style="display: none; margin-top: 10px;">
                                    <input type="text" name="custom_sub_caste" value="{{ old('custom_sub_caste', $user->custom_sub_caste) }}" id="custom_sub_caste" placeholder="Please specify your subcaste">
                                    @if ($errors->has('custom_sub_caste'))
                                        <span class="text-danger small">{{ $errors->first('custom_sub_caste') }}</span>
                                    @endif
                                </div>
                            </div>
                              
                            <div class="form-group">
                                <label for="gotra">Gotra</label>
                                <input type="text" name="gotra" value="{{ $user->gotra }}" id="gotra" placeholder="Enter Gotra">
                                @if ($errors->has('gotra'))
                                    <span class="text-danger small">{{ $errors->first('gotra') }}</span>
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
    
        @php $otherCasteId = $castes->firstWhere('name', 'Other')->id ?? null; @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const religionSelect = document.getElementById('religion');
                const habitsRow = document.getElementById('habitsRow');
                const casteSelect = document.getElementById('caste');
                const subcasteSelect = document.getElementById('sub_caste');
                const customCasteContainer = document.getElementById('custom_caste_container');
                const customCasteInput = document.getElementById('custom_caste');
                const customSubCasteContainer = document.getElementById('custom_sub_caste_container');
                const customSubCasteInput = document.getElementById('custom_sub_caste');
                const otherCasteId = @json($otherCasteId);
                const userSubcaste = @json($user->sub_caste ?? null);
                const userCustomCaste = @json(old('custom_caste', $user->custom_caste ?? ''));
                const userCustomSubCaste = @json(old('custom_sub_caste', $user->custom_sub_caste ?? ''));
        
                // Check the initial value of the religion dropdown
                if (religionSelect.value === 'hindu') {
                    habitsRow.classList.remove('hidden');
                } else {
                    habitsRow.classList.add('hidden');
                }
        
                // Listen for changes in the Religion dropdown
                religionSelect.addEventListener('change', function() {
                    if (religionSelect.value === 'hindu') {
                        habitsRow.classList.remove('hidden');
                    } else {
                        habitsRow.classList.add('hidden');
                    }
                });
                
                // Function to handle caste selection
                function handleCasteChange() {
                    if (!casteSelect) return;
                    
                    const selectedOption = casteSelect.options[casteSelect.selectedIndex];
                    const selectedCasteName = selectedOption ? (selectedOption.text || selectedOption.textContent || '').trim().toLowerCase() : '';
                    const selectedCasteId = casteSelect.value;
                    
                    // Show/hide custom caste input (match by lowercase text OR DB id)
                    if (selectedCasteName === 'other' || (otherCasteId && selectedCasteId == otherCasteId)) {
                        customCasteContainer.style.display = 'block';
                        if (customCasteInput) customCasteInput.required = true;
                    } else {
                        customCasteContainer.style.display = 'none';
                        if (customCasteInput) {
                            customCasteInput.required = false;
                            customCasteInput.value = '';
                        }
                    }

                    // Load subcastes and reset subcaste selection
                    if (selectedCasteId) {
                        loadSubcastes(selectedCasteId);
                    } else {
                        subcasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';
                    }
                    
                    // Hide custom subcaste input when caste changes
                    customSubCasteContainer.style.display = 'none';
                    if (customSubCasteInput) {
                        customSubCasteInput.required = false;
                        customSubCasteInput.value = '';
                    }
                }
                
                // Function to handle subcaste selection
                function handleSubCasteChange() {
                    if (!subcasteSelect) return;
                    
                    const selectedOption = subcasteSelect.options[subcasteSelect.selectedIndex];
                    const selectedSubCasteName = selectedOption ? (selectedOption.text || selectedOption.textContent || '').trim().toLowerCase() : '';
                    
                    // Show/hide custom subcaste input
                    if (selectedSubCasteName === 'other') {
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
                    // Clear existing options
                    subcasteSelect.innerHTML = '<option value="">Select Sub-Caste</option>';
                    
                    if (!casteId) {
                        return;
                    }
                    
                    // Fetch subcastes for the selected caste
                    fetch(`/castes/${casteId}/subcastes`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(subcaste => {
                                const option = document.createElement('option');
                                option.value = subcaste.id;
                                option.textContent = subcaste.name;
                                if (selectedSubcaste && selectedSubcaste == subcaste.id) {
                                    option.selected = true;
                                }
                                subcasteSelect.appendChild(option);
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
                casteSelect.addEventListener('change', handleCasteChange);
                subcasteSelect.addEventListener('change', handleSubCasteChange);

                // Ensure initial state is correct on load
                handleCasteChange();
                
                // Initialize on page load
                if (casteSelect && casteSelect.value) {
                    // Set custom caste value if exists
                    if (userCustomCaste && customCasteInput) {
                        customCasteInput.value = userCustomCaste;
                        customCasteContainer.style.display = 'block';
                        customCasteInput.required = true;
                    }
                    
                    handleCasteChange();
                    
                    // Load subcastes with user selection
                    if (userSubcaste) {
                        loadSubcastes(casteSelect.value, userSubcaste);
                        
                        // Set custom subcaste value if exists
                        if (userCustomSubCaste && customSubCasteInput) {
                            setTimeout(() => {
                                // Ensure custom subcaste input is shown when value exists
                                customSubCasteContainer.style.display = 'block';
                                customSubCasteInput.required = true;
                                customSubCasteInput.value = userCustomSubCaste;
                            }, 200);
                        }
                    }
                } else if (casteSelect.value) {
                    loadSubcastes(casteSelect.value, userSubcaste);
                }
            });
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
  
  

        
    </body>
    </html>
</x-layout.user_banner>
