<x-layout.user_banner>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: black;
        }

        h1, h2, p, li, form {
            color: black;
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

        input[type="text"], input[type="number"], button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            width: 100%;
        }

        /* Update button color to rose red */
        button {
            background-color: #ff0000; /* Rose Red color */
            color: white;
            cursor: pointer;
            width: auto;
            padding: 10px 25px;
            margin-top: 40px; /* Top margin */
            margin-bottom: 20px; /* Bottom margin */
            margin-right: 15px; /* Right margin */
        }

        button:hover {
            background-color: #cc0066; /* Darker shade for hover effect */
        }

        .age-range {
            display: flex;
            align-items: center; /* Vertically align inputs and "to" */
            gap: 10px;
            margin-bottom: 10px;
        }

        .marital-status {
    display: flex;
    align-items: center; /* Vertically align inputs */
    margin-top: 20px; /* Add space from the top */
    margin-bottom: 10px;
    max-width: 500px;
    margin: 14px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    gap: 10px;
    flex-wrap: wrap;
    
}
 

        .advance {
    display: flex;
    align-items: center; /* Vertically align inputs */
    margin-top: 20px; /* Add space from the top */
    margin-bottom: 10px;
    max-width: 500px;
    margin: 14px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    gap: 10px;
    flex-wrap: wrap;
}

        .results {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 cards per row */
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h3 {
            font-size: 1em; /* Reduced size for the heading */
        }

        .card p {
            font-size: 0.9em; /* Reduced size for paragraphs */
        }

        .card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .form-actions {
            display: flex; /* Makes the buttons appear in one line */
            justify-content: flex-end; /* Align buttons to the right */
            gap: 10px; /* Adds spacing between the buttons */
        }

        /* Responsive for smaller screens */
        @media (max-width: 1024px) {
            .results {
                grid-template-columns: repeat(2, 1fr); /* 2 cards per row on medium screens */
            }
        }

        @media (max-width: 600px) {
            .results {
                grid-template-columns: 1fr; /* 1 card per row on small screens */
            }
        }

        button,
        a.btn {
            background-color: #ff0000; /* Rose Red color */
            cursor: pointer;
            padding: 10px 25px;
            margin-top: 40px; /* Top margin */
            margin-bottom: 20px; /* Bottom margin */
            margin-right: 15px; /* Right margin */
            border: none; /* Remove default border */
            text-align: center; /* Center text */
        }

        button:hover,
        a.btn:hover {
            background-color: #cc0066; /* Darker shade for hover effect */
        }

        /* Specific styles for the small button */
        .small-btn {
            padding: 5px 10px; /* Smaller padding for the button */
            font-size: 0.8em; /* Reduced font size */
        }

        .profile-image {
                width: 80%;
                height: auto;
                margin: 10px auto;
                display: block;
                border-radius: 8px;
            }

            .no-profile-photo {
                width: 80%;
                height: 150px;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #888;
                font-weight: bold;
                margin: 10px auto;
                border-radius: 8px;
            }
            .view-profile {
                color: #60B5FF;
                font-weight: bold;
                cursor: pointer;
                display: inline-block;
             }

 /* Other styles remain unchanged */

 
 button,
    a.btn {
        background-color: #ff0000; /* Rose Red color */
        color: white !important; /* Ensure text color is white */
        cursor: pointer;
        padding: 10px 25px;
        margin-top: 40px; /* Top margin */
        margin-bottom: 20px; /* Bottom margin */
        margin-right: 15px; /* Right margin */
        border: none; /* Remove default border */
        text-align: center; /* Center text */
    }

    button:hover,
    a.btn:hover {
        background-color: #cc0066; /* Darker shade for hover effect */
    }    
    
    /* Form Styling */
.age-range {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.form-input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

.form-input:focus {
    border-color: #4CAF50;  /* Green color on focus */
    outline: none;
}

.text-danger {
    color: #e74c3c;
    font-size: 12px;
}

.small {
    font-size: 12px;
}

.advance-card {
    display: flex;
    gap: 10px;
}

.form-group {
    margin-bottom: 16px; /* Space between the form groups */
}

.form-label {
    display: block; /* Makes label a block element */
    margin-bottom: 8px; /* Adds space between label and select */
    font-weight: bold; /* Makes the label text bold */
}

.form-input {
    width: 100%; /* Makes select dropdowns full width */
    padding: 8px; /* Adds padding to the select input */
    font-size: 14px; /* Adjusts font size */
    border: 1px solid #ccc; /* Adds border */
    border-radius: 4px; /* Adds rounded corners */
}




    
    </style>
    
    <div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-9">
    
    <div class="card">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> {{ session('error') }}
        </div>
        @endif
        <h1 class="text-center">User Search</h1>

        <!-- Search Form -->
        <form action="{{ route('search.create') }}" method="GET">
           
        <div class="row" id="searchContainer">
            <!-- Basic Search (Left Side) -->
            <div class="col-md-6" id="basicSearch">
                <div class="card">
                <div class="card-header" style="background-color:#60B5FF; color: white;">
                 <h5 style="margin-bottom: 0; color: white;">Basic Search</h5>
                </div>

                    <div class="card-body">
                        <!-- Age Range Search Inputs -->
                        <div class="age-range" style="text-align: center; justify-content: center; width: 100%;">
                            <div class="form-group" style="width: 45%;">
                                <label for="from_age" class="form-label">From Age</label>
                                <input type="number" class="form-control" id="from_age" name="from_age" placeholder="From age" min="18" max="70" value="{{ request()->input('from_age')  }}">
                            </div>
                            <span style="display: flex; align-items: center; padding: 0 10px;">to</span>
                            <div class="form-group" style="width: 45%;">
                                <label for="to_age" class="form-label">To Age</label>
                                <input type="number" class="form-control" id="to_age" name="to_age" placeholder="To age" min="18" max="70" value="{{ request()->input('to_age') }}">
                            </div>
                        </div>

                        
                        <div class="age-range">
                            <div class="form-group">
                                <label for="from_height" class="form-label">From Height</label>
                                <select class="form-input" name="from_height" id="from_height">
                                    <option value="" selected>Select an option</option>
                                    @foreach (collect(config('data.height', []))->sortKeys()->toArray() as $value => $name)
                                        <option value="{{ $value }}" 
                                                {{ request()->input('from_height') == $value ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('from_height'))
                                    <span class="text-danger small">{{ $errors->first('from_height') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="to_height" class="form-label">To Height</label>
                                <select class="form-input" name="to_height" id="to_height">
                                    <option value="" selected>Select an option</option>
                                    @foreach (collect(config('data.height', []))->sortKeys()->toArray() as $value => $name)
                                        <option value="{{ $value }}" 
                                                {{ request()->input('to_height') == $value ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('to_height'))
                                    <span class="text-danger small">{{ $errors->first('to_height') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
    <label for="income" class="form-label">Income</label>
    <select class="form-input" name="income" id="income">
        <option value="" selected>Select an option</option>
        <option value="50000" {{ request()->input('income') == '50000' ? 'selected' : '' }}>Up to ₹50,000</option>
        <option value="100000" {{ request()->input('income') == '100000' ? 'selected' : '' }}>Up to ₹1 Lakh</option>
        <option value="500000" {{ request()->input('income') == '500000' ? 'selected' : '' }}>Up to ₹5 Lakhs</option>
        <option value="1000000" {{ request()->input('income') == '1000000' ? 'selected' : '' }}>Up to ₹10 Lakhs</option>
        <option value="100000000" {{ request()->input('income') == '100000000' ? 'selected' : '' }}>All Income Levels</option>
    </select>
    @if ($errors->has('income'))
        <span class="text-danger small">{{ $errors->first('income') }}</span>
    @endif
</div>

                            
                        </div>

                       
                        
                        <!-- Marital Status Multi-select Checkboxes -->
                        <div class="marital-status">
                            <label class="form-label">Marital Status</label>
                            <div class="d-flex flex-wrap gap-2">
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Never Married" {{ in_array('Never Married', (array) request()->input('marital_status')) ? 'checked' : '' }}> Never Married</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Married" {{ in_array('Married', (array) request()->input('marital_status')) ? 'checked' : '' }}> Married</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Divorced" {{ in_array('Divorced', (array) request()->input('marital_status')) ? 'checked' : '' }}> Divorced</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Awaiting Divorce" {{ in_array('Awaiting Divorce', (array) request()->input('marital_status')) ? 'checked' : '' }}> Awaiting Divorce</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Separated" {{ in_array('Separated', (array) request()->input('marital_status')) ? 'checked' : '' }}> Separated</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Widowed" {{ in_array('Widowed', (array) request()->input('marital_status')) ? 'checked' : '' }}> Widowed</label>
                                <label class="me-2"><input type="checkbox" name="marital_status[]" value="Annulled" {{ in_array('Annulled', (array) request()->input('marital_status')) ? 'checked' : '' }}> Annulled</label>
                            </div>
                        </div>
                    </div>
                         <button type="button" id="settingsButton" style="background-color: #60B5FF;" class="btn btn-primary d-md-none">Advance Search</button>
                   
                </div>
            </div>
            
            <!-- Advanced Search (Right Side, Initially Hidden) -->
            <div class="col-md-6" id="advancedSettings" style="display: none;">
                <div class="card">
                <div class="card-header" style="background-color:#60B5FF; color: white;">
                 <h5 style="margin-bottom: 0; color: white;">Advance Search</h5>
                </div>
                    <div class="card-body">
                        <div class="advance-card">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-input" name="country" id="country">
                                    <option value="" selected>Select an option</option>
                                    @foreach (collect(config('data.country', []))->sortKeys()->toArray() as $value => $name)
                                        <option value="{{ $value }}" 
                                                {{ request()->input('country') == $value ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state" class="form-label">State</label>
                                <select class="form-input" name="state" id="state">
                                    <option value="" selected>Select an option</option>
                                    @foreach (collect(config('data.state', []))->sortKeys()->toArray() as $value => $name)
                                        <option value="{{ $value }}" 
                                                {{ request()->input('state') == $value ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="highest_education" class="form-label">Highest Education</label>
                            <select class="form-input" name="highest_education" id="highest_education">
                                <option value="" selected>Select an option</option>
                                @foreach (config('data.highest_education', []) as $value => $name)
                                    <option value="{{ $value }}" 
                                            {{ request()->input('highest_education') == $value ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="eating-habits mt-3">
                            <label class="form-label">Eating Habits</label>
                            <div class="d-flex flex-wrap gap-3">
                                <label class="me-3"><input type="checkbox" name="eating_habits[]" value="vegetarian" 
                                        {{ in_array('vegetarian', (array) request()->input('eating_habits')) ? 'checked' : '' }}> Vegetarian</label>
                                <label class="me-3"><input type="checkbox" name="eating_habits[]" value="non-vegetarian" 
                                        {{ in_array('non-vegetarian', (array) request()->input('eating_habits')) ? 'checked' : '' }}> Non-Vegetarian</label>
                                <label class="me-3"><input type="checkbox" name="eating_habits[]" value="vegan" 
                                        {{ in_array('vegan', (array) request()->input('eating_habits')) ? 'checked' : '' }}> Vegan</label>
                                <label class="me-3"><input type="checkbox" name="eating_habits[]" value="eggiterian" 
                                        {{ in_array('eggiterian', (array) request()->input('eating_habits')) ? 'checked' : '' }}> Eggiterian</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Reset Buttons -->
        <div class="form-actions mt-3">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('search.create') }}" class="btn btn-primary">Reset</a> <!-- Link to reset the form -->
        </div>
    </form>

    <hr>

    <!-- Show User Profiles -->
    @if($users->isNotEmpty())
        <h2>Searched Members</h2>
          <div class="results">
            @foreach ($users as $user)
                <div class="card">
                    <div class="form-group" style="position: relative;"> <!-- Added relative positioning -->
                        <div x-data="imageLoaderWithFallback('{{ $user->img_1 }}', '{{ $user->img_2 }}', '{{ $user->img_3 }}')" x-init="tryLoadImage()">
                            <template x-if="imageUrl">
                                <a :href="imageUrl" target="_blank">
                                    <img style="max-width: 100px;" :src="imageUrl" alt="Profile Image" />
                                </a>
                            </template>
                            <template x-if="!imageUrl">
                                <div class="no-profile-photo">No Profile Photo Displayed</div>
                            </template>
                        </div>
            
                        <!-- Heart Icon for Favorite -->
                        {{-- <div style="position: absolute; top: 10px; right: 10px;">
                            @if($user->is_favorited)
                                <form action="{{ route('profiles.remove_favorite') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="favorite_id" value="{{$user->id}}">
                                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-heart" style="color: red;"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('profiles.add_favorite') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="favorite_id" value="{{$user->id}}">
                                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                                        <i class="far fa-heart" style="color: grey;"></i>
                                    </button>
                                </form>
                            @endif
                        </div> --}}
                    </div>
                    <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p>Age: {{ $user->age }}</p>
                 {{-- start --}}
                <div style="position: absolute; top: 10px; right: 10px;">
                <div  x-data="favoriteToggle({{ $user->id }}, {{ $user->is_favorited ? 'true' : 'false' }})" >
                    <form @submit.prevent="submit" style="display: inline;">
                        @csrf
                        <input type="hidden" name="favorite_id" x-model="favoriteId">
                        <button type="submit" class="btn btn-link p-0 m-0" title="Toggle Favorite">
                            <i :class="isFavorited ? 'fas fa-heart text-danger' : 'far fa-heart text-secondary'"></i>
                        </button>
                    </form>
                </div>
                </div>
        
 
        {{-- end --}}
        <a href="{{ route('user.show_profile', $user->id) }}" class="view-profile">View Profile</a>
    </div>
            @endforeach
        </div>
        
        
    @else
        <p>No users found.</p>
    @endif
</div>
</div>
  <div class="col-md-3">

</div> 
</div>
    </div>

    <script>
        function favoriteToggle(userId, isFavorited) {
            return {
                favoriteId: userId,
                isFavorited: isFavorited === true,
                message: '',
                submit: async function() {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const endpoint = this.isFavorited 
                        ? "{{ route('profiles.remove_favorite') }}"
                        : "{{ route('profiles.add_favorite') }}";
    
                    try {
                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ favorite_id: this.favoriteId })
                        });
    
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
    
                        const data = await response.json();
                        this.message = data.message;
    
                        // Toggle favorite state
                        this.isFavorited = !this.isFavorited;
                    } catch (error) {
                        this.message = 'An error occurred: ' + error.message;
                    }
                }
            };
        }
    </script>


 {{-- image display --}}
 <script>
    function imageLoaderWithFallback(img1, img2, img3) {
        return {
            imageUrl: null,
            imageOptions: [img1, img2, img3],
            currentIndex: 0,
            
            async tryLoadImage() {
                // Try each image in sequence until one loads successfully or we run out of options
                while (this.currentIndex < this.imageOptions.length) {
                    const currentImage = this.imageOptions[this.currentIndex];
                    
                    // Skip empty filenames
                    if (!currentImage) {
                        this.currentIndex++;
                        continue;
                    }
                    
                    try {
                        const response = await fetch(`/api/images/${currentImage}`);
                        if (!response.ok) throw new Error('Image not found');
                        
                        // Create a blob URL for the image
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                        return; // Successfully loaded an image
                    } catch (error) {
                        console.error(`Error fetching image ${currentImage}:`, error);
                        this.currentIndex++; // Try next image
                    }
                }
                
                // If we get here, all images failed to load
                this.imageUrl = null;
            }
        };
    }
    </script>

{{-- end --}}

<!-- JavaScript to toggle the settings -->
<script>
    function setAdvancedSearchVisibility() {
        var settingsContent = document.getElementById('advancedSettings');
        var basicSearch = document.getElementById('basicSearch');
        
        // Check if the screen is mobile (less than 768px - Bootstrap's md breakpoint)
        var isMobile = window.innerWidth < 768;
        
        if (isMobile) {
            // On mobile - use the stored preference or hide by default
            var storedVisibility = localStorage.getItem('advancedSearchVisible');
            
            if (storedVisibility === 'true') {
                settingsContent.style.display = 'block';
                basicSearch.classList.add('col-md-6');
                basicSearch.classList.remove('col-md-12');
            } else {
                settingsContent.style.display = 'none';
                basicSearch.classList.add('col-md-12');
                basicSearch.classList.remove('col-md-6');
            }
        } else {
            // On tablet/desktop - always show advanced search
            settingsContent.style.display = 'block';
            basicSearch.classList.add('col-md-6');
            basicSearch.classList.remove('col-md-12');
        }
    }

    // Run on page load
    window.addEventListener('DOMContentLoaded', function() {
        setAdvancedSearchVisibility();
    });
    
    // Run when window is resized
    window.addEventListener('resize', function() {
        setAdvancedSearchVisibility();
    });

    // Button click handler
    document.getElementById('settingsButton').addEventListener('click', function(event) {
        event.preventDefault();  // Prevent page refresh
        
        // Only toggle on mobile
        if (window.innerWidth < 768) {
            var settingsContent = document.getElementById('advancedSettings');
            var basicSearch = document.getElementById('basicSearch');
            
            // Toggle the display of the settings
            if (settingsContent.style.display === 'none') {
                settingsContent.style.display = 'block';
                localStorage.setItem('advancedSearchVisible', 'true');
                basicSearch.classList.add('col-md-6');
                basicSearch.classList.remove('col-md-12');
            } else {
                settingsContent.style.display = 'none';
                localStorage.setItem('advancedSearchVisible', 'false');
                basicSearch.classList.add('col-md-12');
                basicSearch.classList.remove('col-md-6');
            }
        }
    });
</script>
</x-layout.user_banner>    
