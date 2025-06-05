<x-layout.user_banner>
   
    
        <style>
            .panel {
                border: 1px solid #ddd;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 900px; /* Optional: Limit the width of the card */
                margin: 20px auto; /* Center the card on the page */
            }
            .panel h2 {
                margin-bottom: 15px;
                text-align: center;
                color: #333;
            }
            .form-row {
                display: flex;
                justify-content: space-between;
                gap: 20px; /* Space between input boxes */
                margin-bottom: 10px;
            }
            .form-group {
                flex: 1; /* Make each input field take up equal space */
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
                height: 100px; /* Adjust height for the textarea */
            }
            .sidebar {
    width: 300px; /* Fixed width for the sidebar */
    position: sticky;
    top: 0; /* Make the sidebar sticky at the top when scrolling */
    height: 100vh; /* Full height of the viewport */
    background-color: #f5f5f5; /* Optional background color for sidebar */
    padding: 15px;
    border-left: 1px solid #ddd; /* Optional border for separation */
}
/* imagedropdown */
    .transparent-input {
        background-color: transparent;
        border: none;
        color: black; /* Ensures the text (number) remains visible */
        text-align: center; /* Center the text */
        font-size: 12px;
        font-weight: bold;
        padding: 0; /* Remove padding */
        width: 20px;
        cursor: pointer;

         /* Match width of the dropdown */
    }

    .transparent-input:focus {
        outline: none; /* Remove focus outline */
    }

    /* Optional: Hide the placeholder if you want */
    .transparent-input::placeholder {
        color: transparent; /* Make the placeholder transparent */
    }
    .dropdown-container {
    display: flex;               /* Use flexbox to align items */
    align-items: center;        /* Center items vertically */
}
.transparent-input {
                    /* Adjust the width as needed */
    padding: 3px;              /* Ensure padding matches dropdown */
    font-size: 12px;           /* Ensure font size matches dropdown */
    color: black;              /* Set text color */
    background-color: transparent; /* Make background transparent */
    border: none;              /* Remove border if needed */
}

.form-select {
    width: 80px;               /* Fixed width for dropdown */
    padding: 3px;              /* Ensure padding matches input */
    font-size: 12px;           /* Ensure font size matches input */
    color: black;              /* Set text color */
}
/* //new */
.dropdown-container {
    position: relative;
    display: inline-block;
}

.dropdown-button {
    cursor: pointer;
    width: 50px; /* Adjust the width */
    height: 20px; /* Adjust the height */
    font-size: 12px; /* Smaller font size */
    text-align: center; /* Center the text horizontally */
    color: black; /* Set text color to black */
    background-color: transparent; /* Make the background transparent */
    border: 1px solid #ccc; /* Add a border */
    padding: 0; /* Remove default padding */
    line-height: 2px; /* Center text vertically within the button */
}
 .dropdown-menu {
    display: none; /* Initially hidden */
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    z-index: 100;
    max-height: 200px; /* Limit height */
    overflow-y: auto; /* Scroll if too many items */
    width: 50px;
 }
.dropdown-menu label {
    color: black; /* Set text color to black */
    font-size: 14px; /* Smaller font size for dropdown items */
    padding: 4px; /* Reduced padding */
}
.checkbox-option {
    margin-right: 5px; /* Space between checkbox and label */
    transform: scale(1.2); /* Make checkboxes smaller */
}


  /* Decrease width by 20% */
  .profile-completion {
        width: 80%; /* 100% - 20% */
        margin: 0 auto; /* Center the container */

    }
    .progress {
        height: 30px; /* Set the width to 100% */
    }
         
    button.btn {
    background-color: #ff0000; /* Rose Red color */
    color: white !important; /* Ensure text color is white */
    border: none; /* Optional: remove border */
}

#more_about_patrika {
    color: black; /* Changes the text inside the textarea to black */
}   

.form-label {
    color: black; /* Changes the label text color to black */
}

.text-danger {
    color: black; /* Changes the error message color to black */
}
/* img */

.container-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Form container takes most of the width */
        .form-container {
            flex: 1;
            margin-right: 20px; /* Spacing between the form and the sidebar */
        }
        /* Sidebar styling remains as before */
        .sidebar {
            width: 300px; /* Fixed width for the sidebar */
            position: sticky;
            top: 0; /* Sticky sidebar at the top when scrolling */
            height: 100vh; /* Full viewport height */
            background-color: #f5f5f5; /* Background color for the sidebar */
            padding: 15px;
            border-left: 1px solid #ddd;
        }
 
        </style>
    </head>
    <body>
        <div class="container-flex">
             <div class="form-container">
        <form action="{{ route('profiles.astronomy_details_store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="redirect_url" id="redirect_url" value="">

                     <div class="l">
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
                        <h3 class="text-center" style="color: #60B5FF; margin: 20px;">Astronomy Details</h3>

    <div class="panel">
        <h2>Personal Information</h2>
        <div class="row mb-2">
            <!-- Date of Birth -->
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label" style="color: black;">Date of Birth</label>
                <input id="date_of_birth" name="date_of_birth" type="date" 
                       class="form-control @error('date_of_birth') is-invalid @enderror"
                       value="{{ $user->date_of_birth }}" placeholder="Enter Date of Birth" required
                       max="{{ now()->subYears(18)->format('Y-m-d') }}" 
                       title="You must be at least 18 years old" />
                <x-input-error :messages="$errors->get('date_of_birth')" class="text-danger small" />
            </div>
        
            <!-- Birth Time -->
            <div class="col-md-6">
                <label for="birth_time" class="form-label">Birth Time (IST)</label>
                <input type="time" id="birth_time" name="birth_time" class="form-control"
                       value="{{ $user->birth_time }}" required>
                <small style="color: #60B5FF;">Format: HH:MM (IST)</small>
            </div>
        </div>
        
        
        
        <div class="form-row">
            <div class="form-group">
                <label for="birth_place">Birth Place</label>
                <input type="text" id="birth_place" name="birth_place" class="form-control" value="{{ $user->birth_place }}" required>
                @if ($errors->has('birth_place'))
                <span class="text-danger small">{{ $errors->first('birth_place') }}</span>
                @endif     
            </div>
        </div>    
    </div>
<div class="panel">
    <h2>Astronomy Information</h2>
    <div>
        <!-- Hidden input to ensure 0 is sent when checkbox is unchecked -->
        <input type="hidden" name="when_meet" value="0" />
        
        <!-- Checkbox input -->
        <input name="when_meet" type="checkbox" value="1"
               {{ $user->when_meet ? 'checked' : '' }} 
               id="toggleDropdowns" />
        
        <label class="text-black" for="toggleDropdowns" style="color: black;">
            भेटल्यावर बोलूया
        </label>
    </div>
    
    <!-- Content that will be toggled -->
    <div id="toggleContent" style="display: {{ $user->when_meet ? 'none' : 'block' }};">
        <div class="container" id="dropdowns">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="rashee">राशी</label>
                        <select class="form-input" name="rashee" id="rashee">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.rashee', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($user->rashee === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                            
                        </select>
                        @if ($errors->has('rashee'))
                        <span class="text-danger small">{{ $errors->first('rashee') }}</span>
                        @endif     
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="nakshatra">नक्षत्र</label>
                        <select class="form-input" name="nakshatra" id="nakshatra">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.nakshatra', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($user->nakshatra === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                            
                        </select>
                        @if ($errors->has('nakshatra'))
                        <span class="text-danger small">{{ $errors->first('nakshatra') }}</span>
                        @endif     
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="mangal">मंगळ</label>
                        <select class="form-input" name="mangal" id="mangal">
                            <option value="" selected>Select an option</option>
                            @foreach (config('data.mangal', []) as $value => $name)
                                <option value="{{ $value }}" {{ ($user->mangal === $value) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                            
                        </select>
                        @if ($errors->has('mangal'))
                        <span class="text-danger small">{{ $errors->first('mangal') }}</span>
                        @endif     
                    </div>
                </div>
            </div>
            <div class="container mt-4" id="dropdowns">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="charan">चरण</label>
                            <select class="form-input" name="charan" id="charan">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.charan', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($user->charan === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('charan'))
                            <span class="text-danger small">{{ $errors->first('charan') }}</span>
                            @endif     
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="gana">गण</label>
                            <select class="form-input" name="gana" id="gana">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.gana', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($user->gana === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('gana'))
                            <span class="text-danger small">{{ $errors->first('gana') }}</span>
                            @endif     
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="nadi">नाडी</label>
                            <select class="form-input" name="nadi" id="nadi">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.nadi', []) as $value => $name)
                                    <option value="{{ $value }}" {{ ($user->nadi === $value) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                                
                            </select>
                            @if ($errors->has('nadi'))
                            <span class="text-danger small">{{ $errors->first('nadi') }}</span>
                            @endif     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('toggleDropdowns');
            const content = document.getElementById('toggleContent');
    
            // Initially hide/show content based on checkbox state
            if (checkbox.checked) {
                content.style.display = 'none'; // Hide content when checkbox is checked
            } else {
                content.style.display = 'block'; // Show content when checkbox is unchecked
            }
    
            // Toggle visibility when the checkbox is clicked
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    content.style.display = 'none'; // Hide content when checked
                } else {
                    content.style.display = 'block'; // Show content when unchecked
                }
            });
        });
    </script>
    
    
    
 
     
    
    </div>
   
        <script>
            //numbers
            document.addEventListener('DOMContentLoaded', function() {
        const dropdown1 = document.getElementById('imageDropdown1');
        const selectedValue = parseInt(dropdown1.value);

        const inputs = [];
        for (let i = 2; i <= 12; i++) {
            inputs.push(document.getElementById(`imageDropdown${i}`));
        }

        if (!isNaN(selectedValue)) {
            inputs.forEach((input, index) => {
                let calculatedValue = selectedValue + index + 1; // Start counting from the selected value

                // Wrap values if they go above 12
                if (calculatedValue > 12) calculatedValue -= 12;

                // Set the initial values in the inputs
                input.value = calculatedValue;
            });
        }

        // Add change event listener to the main dropdown
        dropdown1.addEventListener('change', function() {
            const selectedValue = parseInt(this.value);
            
            inputs.forEach((input, index) => {
                let calculatedValue = selectedValue + index + 1; // Start counting from the selected value

                // Wrap values if they go above 12
                if (calculatedValue > 12) calculatedValue -= 12;

                // Update the values in the inputs
                input.value = calculatedValue;
            });
        });
    });
    //dropdown
    document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.dropdown-button');
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    dropdownButtons.forEach((button, index) => {
        const menu = dropdownMenus[index];
        const checkboxes = menu.querySelectorAll('.checkbox-option');

        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default action (e.g., form submission)
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', function (event) {
            if (!button.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });

        // Handle checkbox changes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                updateSelectedValues();
            });
        });

        function updateSelectedValues() {
            // Get all selected values across all dropdowns
            const selectedValues = Array.from(document.querySelectorAll('.checkbox-option:checked')).map(checkbox => checkbox.value);

            // Update each dropdown based on selected values
            dropdownMenus.forEach((otherMenu, otherIndex) => {
                const otherCheckboxes = otherMenu.querySelectorAll('.checkbox-option');

                otherCheckboxes.forEach(option => {
                    if (selectedValues.includes(option.value) && !option.checked) {
                        option.parentElement.style.display = 'none'; // Hide option if selected in another dropdown
                    } else {
                        option.parentElement.style.display = 'block'; // Show option if not selected
                    }
                });
            });
        }
        updateSelectedValues();
    });
});
        </script>
        <div class="panel">
            <!-- More About Patrika Section -->
            <div class="form-group">
                <label for="more_about_patrika" class="form-label">More About Patrika</label>
                <textarea id="more_about_patrika" name="more_about_patrika" class="form-control" rows="4" placeholder="Enter more details...">{{ old('more_about_patrika', $user->more_about_patrika) }}</textarea>
                @if ($errors->has('more_about_patrika'))
                    <span class="text-danger small">{{ $errors->first('more_about_patrika') }}</span>
                @endif
            </div>
        
            <!-- Patrika Image Upload Section -->
            <div class="form-group">
                <label for="photo1">Patrika Image</label>
                <input type="file" name="img_patrika" id="photo1" class="form-control">
                @if ($errors->has('img_patrika'))
                    <span class="text-danger small">{{ $errors->first('img_patrika') }}</span>
                @endif
            </div>
        
            <!-- Display Uploaded Image Section -->
            <div class="form-group">
                
                @if ($user->img_patrika)
                <div x-data="imageLoader()" x-init="fetchImage('{{  $user->img_patrika }}')">
                    <label>Uploaded Image</label>
                    <template x-if="imageUrl">
                        <div class="d-flex align-items-center">
                            <!-- Wrap the image with an anchor tag to open it in a new tab -->
                            <a :href="imageUrl" target="_blank">
                                <img style="max-width: 100px; margin-right: 10px;" :src="imageUrl" alt="Uploaded Image" />
                            </a>
                         </div>
                    </template>
                   
                </div>
                @endif
            </div>
        </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
        
        
          </form>
{{-- dropdown end --}}  

</div>
  
<script>
    // img
    function imageLoader() {
        return {
            imageUrl: null,

            async fetchImage(filename) {
                try {
                    const response = await fetch(`/api/images/${filename}`);
                    if (!response.ok) throw new Error('Image not found');
                    
                    // Create a blob URL for the image
                    const blob = await response.blob();
                    this.imageUrl = URL.createObjectURL(blob);
                } catch (error) {
                    console.error('Error fetching image:', error);
                    this.imageUrl = null; // Handle error case
                }
            }
        };
    }
</script>
<script>
    document.getElementById('toggleDropdowns').addEventListener('change', function() {
    const dropdowns = document.getElementById('dropdowns');

    if (this.checked) {
        dropdowns.style.display = 'none'; // Hide dropdowns
    } else {
        dropdowns.style.display = 'block'; // Show dropdowns
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
