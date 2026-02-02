<x-layout.user_banner>
    <style> 
      /* New Flex Container to hold the main content and the sidebar */
      .content-wrapper {
    max-width: 1200px; /* or any width that fits your design */
    width: 100%;
    margin: 0 auto; /* centers the container horizontally */
    display: flex;
    flex-direction: row;
    align-items: flex-start;
}


.outer-container {
    max-width: 1200px;
    margin: 0 auto;
}



      
      /* Main content will take the remaining space */
      .main-content {
          flex: 1;
      }
      
      /* New inner container to center the content */
      .main-content-inner {
          max-width: 800px;
          margin: 0 auto;
      }

      .card-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 20px;
      }

      .no-profile-photo{
          color: grey;
      }
      
      .card {
          border: 1px solid #ddd;
          border-radius: 8px;
          padding: 20px;
          margin-bottom: 20px;
          width: 100%;
          max-width: 800px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }
      
      .card-row {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          margin: 10px 0;
      }
      
      .card-row p {
          flex: 1 0 21%; /* Take 21% width of the container */
          margin: 5px; /* Space between fields */
          min-width: 200px; /* Ensure a minimum width */
      }
      
      .image-gallery {
          display: flex; /* Use flexbox for horizontal alignment */
          justify-content: space-around; /* Space images evenly */
          margin-bottom: 20px; /* Optional: add space below the gallery */
          gap: 15px; /* Space between images */
          flex-wrap: wrap; /* Allow images to wrap to the next line */
      }
      
      .profile-image {
          max-width: 100px; /* Set maximum width for the images */
          height: auto; /* Maintain aspect ratio */
          border-radius: 8px; /* Optional: adds rounded corners */
          border: 1px solid #ddd; /* Optional: adds a border */
          object-fit: cover; /* Maintain aspect ratio and cover the height */
          height: 150px; /* Set desired height */
      }
      
      .profile-details{
          display: flex;
          justify-content: center;
          align-items: center;
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
      
      .form-group {
          margin-right: 15px; /* Adjust as needed */
      }
      
      .progress {
          background-color: #f3f3f3;
          border-radius: 5px;
          height: 25px;
          width: 100%;
      }
      
      .progress-bar {
          background-color: #007bff;
          height: 100%;
          color: white;
          text-align: center;
          line-height: 25px;
      }
      
      button.btn {
          background-color: #ff0000; /* Rose Red color */
          color: white !important; /* Ensure text color is white */
          border: none; /* Optional: remove border */
      }

      /* Responsive styles for devices with max-width: 320px */
      @media (max-width: 320px) {
          .content-wrapper {
              flex-direction: column;
          }
          .sidebar {
              width: 100%;
              position: relative;
              height: auto;
              border-left: none;
              border-top: 1px solid #ddd;
              margin-top: 15px;
          }
          .main-content-inner {
              padding: 0 10px;
          }
          .card {
              margin: 10px;
              padding: 15px;
          }
          /* Force grid based card-rows (if any inline style is applied, using !important to override) */
          .card-row {
              grid-template-columns: 1fr !important;
          }
      }
    </style>
    <!-- Wrap main content and sidebar in a flex container -->
    <div class="outer-container">

    <div class="content-wrapper">
      <div class="main-content">
        <!-- New inner container to center the content -->
        <div class="main-content-inner">
          <div>
            <h1>{{ $user->first_name }} {{ $user->last_name }}'s Profile</h1>
<div style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 20px;">
            <div class="profile-details">
                @if ($user->img_1)
                <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_1 }}')">
                    <template x-if="imageUrl">
                        <!-- Wrap the image in an anchor tag to open it in a new tab -->
                        <a :href="imageUrl" target="_blank">
                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                        </a>
                    </template>
                    <template x-if="!imageUrl">
                        <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                            <p style="text-align: center; margin: 0;">No image uploaded</p>
                        </div>
                    </template>
                </div>
                @else
                <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                    <p style="text-align: center; margin: 0;">No image uploaded</p>
                </div>
                @endif
            </div>
            <div class="profile-details">
                @if ($user->img_2)
                <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_2 }}')">
                    <template x-if="imageUrl">
                        <!-- Wrap the image in an anchor tag to open it in a new tab -->
                        <a :href="imageUrl" target="_blank">
                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                        </a>
                    </template>
                    <template x-if="!imageUrl">
                        <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                            <p style="text-align: center; margin: 0;">No image uploaded</p>
                        </div>
                    </template>
                </div>
                @else
                <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                    <p style="text-align: center; margin: 0;">No image uploaded</p>
                </div>
                @endif
            </div>
            <div class="profile-details">
                @if ($user->img_3)
                <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_3 }}')">
                    <template x-if="imageUrl">
                        <!-- Wrap the image in an anchor tag to open it in a new tab -->
                        <a :href="imageUrl" target="_blank">
                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                        </a>
                    </template>
                    <template x-if="!imageUrl">
                        <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                            <p style="text-align: center; margin: 0;">No image uploaded</p>
                        </div>
                    </template>
                </div>
                @else
                <div style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 8px;">
                    <p style="text-align: center; margin: 0;">No image uploaded</p>
                </div>
                @endif
            </div>
            </div>
            <div class="panel">
                 @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="card">
                    <h3 class="text-center">Basic Profile</h3>
                    <div  x-data="interestToggle({{ $user->id }}, {{ $user->is_interest ? 'true' : 'false' }})" >
                        @if($showButton)
                        <form action="{{ route('profiles.show_interest') }}" method="POST">
                            @csrf
                            <input type="hidden" name="interest_id" value="{{$user->id}}">
                            <button type="submit" title="Toggle interest">
                                Show interest
                            </button>
                        </form>
                        @endif
                    </div>
                    <br/>
                    
                    <!-- First Row: User Info -->
                    <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Personal Information</h4>
                    <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                        <p><strong>User ID:</strong> {{ $user->user_id }}</p>
                        <p><strong>Full Name:</strong> {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</p>
                        <p><strong>Mother Tongue:</strong> {{ config('data.mother_tongues.'.$user->mother_tongue) ?? ucfirst($user->mother_tongue) }}</p>
                        <p><strong>Native Place:</strong> {{ ucfirst($user->native_place) }}</p>
                        <p><strong>Gender:</strong> {{ config('data.gender.'.$user->gender) ?? ucfirst($user->gender) }}</p>
                        <p><strong>Marital Status:</strong> {{ config('data.marital_status.'.$user->marital_status) ?? ucfirst($user->marital_status) }}</p>
                        <p><strong>Living With:</strong> {{ config('data.living_with.'.$user->living_with) ?? ucfirst($user->living_with) }}</p>
                    </div>
                    <!-- Third Row: Personal Details -->
                    <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Health Information</h4>
                    <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                        <p><strong>Blood Group:</strong> {{ config('data.blood_group.'.$user->blood_group) ?? ucfirst($user->blood_group) }}</p>
                        <p><strong>Height:</strong> {{ config('data.height.'.$user->height) ?? ucfirst($user->height) }}</p>
                        <p><strong>Weight:</strong> {{ ucfirst($user->weight) }}</p>
                        <p><strong>Body Type:</strong> {{ config('data.body_type.'.$user->body_type) ?? ucfirst($user->body_type) }}</p>
                        <p><strong>Complexion:</strong> {{ config('data.complexion.'.$user->complexion) ?? ucfirst($user->complexion) }}</p>
                        <p><strong>Physical Abnormality:</strong> {{ $user->physical_abnormality === null ? '' : ($user->physical_abnormality ? 'Yes' : 'No') }}</p>
                        <p><strong>Spectacles:</strong> {{ $user->spectacles ? 'Yes' : 'No' }}</p>
                        <p><strong>Lens:</strong> {{ $user->lens ? 'Yes' : 'No' }}</p>
                     </div>
                    <!-- Fifth Row: Other Habits -->
                    <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Food Habits</h4>
                    <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                        <p><strong>Eating Habits:</strong> {{ config('data.eating_habits.'.$user->eating_habits) ?? ucfirst($user->eating_habits) }}</p>
                        <p><strong>Drinking Habits:</strong> {{ config('data.drinking_habits.'.$user->drinking_habits) ?? ucfirst($user->drinking_habits) }}</p>
                        <p><strong>Smoking Habits:</strong> {{ config('data.smoking_habits.'.$user->smoking_habits) ?? ucfirst($user->smoking_habits) }}</p>
                    </div>
                    <!-- Sixth Row: About Self -->
                    <div class="card-row" style="border-top: 1px solid #ccc; padding-top: 10px;">
                        <p><strong>About Self:</strong> {{ ucfirst($user->about_self) }}</p>
                    </div>
                </div>
                <div class="card">
                    <h3 class="text-center">Religious Profile</h3></br>
                    <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <div>
                            <p><strong>Religion:</strong>{{ ucfirst($user->religion) }}</p>
                        </div>
                        <div>
                            <p><strong>Caste:</strong>{{ ucfirst($user->caste_display ?? $castes) }}</p>
                        </div>
                        <div>
                            <p><strong>Gotra:</strong>{{ ucfirst($user->gotra) }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                        <!-- Family Profile -->
                        <div>
                            <h4 class="text-center">Family Profile</h4>
                            <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <p><strong>Father's Alive:</strong>
                                    @if($user->father_is_alive)
                                        <span>Yes</span>
                                    @else
                                        <span>No</span>
                                    @endif
                                </p>
                                <p><strong>Father's Name:</strong> {{ ucfirst($user->father_name) }}</p>
                                <p><strong>Father's Occupation:</strong> {{ ucfirst($user->father_occupation) }}</p>
                                <p><strong>Father's Job Type:</strong> {{ ucfirst($user->father_job_type) }}</p>
                                <p><strong>Father's Organization:</strong> {{ ucfirst($user->father_organization) }}</p>
                                <p><strong>Mother's Alive:</strong> 
                                    @if($user->mother_is_alive === null)
                                        <span></span> 
                                    @elseif($user->mother_is_alive)
                                        <span>Yes</span>
                                    @else
                                        <span>No</span>
                                    @endif
                                </p>
                                <p><strong>Mother's Name:</strong> {{ ucfirst($user->mother_name) }}</p>
                                <p><strong>Mother's Occupation:</strong> {{ ucfirst($user->mother_occupation) }}</p>
                                <p><strong>Mother's Job Type:</strong> {{ ucfirst($user->mother_job_type) }}</p>
                                <p><strong>Mother's Organization:</strong> {{ ucfirst($user->mother_organization) }}</p>
                                <p><strong>Mother's Native Place:</strong> {{ ucfirst($user->mother_native_place) }}</p>
                                <p><strong>Mother's Name Before Marriage:</strong> {{ ucfirst($user->mother_name_before_marriage) }}</p>
                            </div>
                        </div>
                        <!-- Brother Details -->
                        <div>
                            <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Brother Details</h4>
                            <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <p><strong>Resident Place:</strong> {{  ucfirst($user->brother_resident_place) }}</p>
                                <p><strong>Married:</strong> {{ $user->number_of_brothers_married ?? 0 }} {{ ($user->number_of_brothers_married ?? 0) == 1 ? 'brother' : 'brothers' }}</p>
                                <p><strong>Unmarried:</strong> {{ $user->number_of_brothers_unmarried ?? 0 }} {{ ($user->number_of_brothers_unmarried ?? 0) == 1 ? 'brother' : 'brothers' }}</p>
                            </div>
                        </div>
                        <!-- Sister Details -->
                        <div>
                            <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Sister Details</h4>
                            <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <p><strong>Resident Place:</strong> {{ ucfirst($user->sister_resident_place) }}</p>
                                <p><strong>Married:</strong> {{ $user->number_of_sisters_married ?? 0 }} {{ ($user->number_of_sisters_married ?? 0) == 1 ? 'sister' : 'sisters' }}</p>
                                <p><strong>Unmarried:</strong> {{ $user->number_of_sisters_unmarried ?? 0 }} {{ ($user->number_of_sisters_unmarried ?? 0) == 1 ? 'sister' : 'sisters' }}</p>
                            </div>
                        </div>
                        <!-- About Parents -->
                        <div>
                            <div class="card-row" style="border-top: 1px solid #ccc; padding-top: 10px;">
                                <p><strong>About Parents:</strong> {{ ucfirst($user->about_parents) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            <div>
                                <h3 class="text-center" style="">Astronomy Details</h3>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Personal Information</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                                    <p><strong>Date:</strong> {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y') : '' }}</p>
                                    <p><strong>Time:</strong> {{ $user->birth_time }}</p>
                                    <p><strong>Place:</strong> {{ ucfirst($user->birth_place) }}</p>
                                 </div>
                            </div>
                            <div>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Astronomy Information</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <p><strong>राशी:</strong> {{ config('data.rashee.'.$user->rashee) ?? ucfirst($user->rashee) }}</p>
                                    <p><strong>नक्षत्र:</strong> {{ config('data.nakshatra.'.$user->nakshatra) ?? $user->nakshatra }}</p>
                                    <p><strong>मंगळ:</strong> {{ config('data.mangal.'.$user->mangal) ?? $user->mangal }}</p>
                                    <p><strong>चरण:</strong> {{ config('data.charan.'.$user->charan) ?? $user->charan }}</p>
                                    <p><strong>गण:</strong> {{ config('data.gana.'.$user->gana) ?? $user->gana }}</p>
                                    <p><strong>नाडी:</strong> {{ config('data.nadi.'.$user->nadi) ?? $user->nadi }}</p>
                                </div>
                            </div>
                            <div>
                                <div >
                                    <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Patrika Image</h5>
                                     <div class="form-group">
                                        @if($user->img_patrika)
                                        <div x-data="imageLoader()" x-init="fetchImage('{{ $user->img_patrika }}')">
                                            <template x-if="imageUrl">
                                            <a style="display: flex; justify-content: center;" :href="imageUrl" target="_blank">
                                                  <img style="width: 80%; height: 80%; border-radius: 10px;" :src="imageUrl" alt="Uploaded Image" />
                                            </a>    
                                                    </template>
                                            <template x-if="!imageUrl">
                                                <div style="width: 80%; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 10px;">
                                                    <p style="text-align: center; margin: 0;">No image uploaded</p>
                                                </div>
                                            </template>
                                        </div>
                                        @else
                                        <div style="width: 80%; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 10px;">
                                            <p style="text-align: center; margin: 0;">No image uploaded</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">More About Patrika</h5>

                                <div class="card-row" >
                                    <p> {{ ucfirst($user->more_about_patrika) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card">   
                    <h3 class="text-center">Educational Profile</h3> 
                    <div class="card-row">
                        <p><strong>Highest Education:</strong> {{ ucfirst($user->highest_education) }}</p>
                        <p><strong>Other Education:</strong> {{ ucfirst($user->other_education) }}</p>
                        <p><strong>Education in Detail:</strong> {{ ucfirst($user->education_in_detail) }}</p>
                        <p><strong>Additional Degree:</strong> {{ ucfirst($user->additional_degree) }}</p>
                    </div>
                </div>
                <div class="card">
                    <!-- Organisation Information Section -->
                    <div>
                        <h4 class="text-center">Organisation Information</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Occupation:</strong> {{ ucfirst($user->occupation) }}</p>
                            <p><strong>Organization:</strong> {{ ucfirst($user->organization) }}</p>
                            <p><strong>Designation:</strong> {{ ucfirst($user->designation) }}</p>
                            <p><strong>Job Location:</strong> {{ ucfirst($user->job_location) }}</p>
                        </div>
                    </div>
                
                    <!-- Experience/Income Section -->
                    <div>
                        <h4 class="text-center"  style="border-top: 1px solid #ccc; padding-top: 10px;">Experience/Income</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Job Experience:</strong> {{ ucfirst($user->job_experience) }}</p>
                            <p><strong>Income:</strong> {{ ucfirst($user->income) }} {{ ucfirst($user->currency) }}</p>
                        </div>
                    </div> 
                </div>
                <div class="card">
                    <!-- Location Information Section -->
                    <div>
                        <h4 class="text-center">Location Information</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Country:</strong> {{ config('data.country.'.$user->country) ?? ucfirst($user->country) }}</p>
                            <p><strong>State:</strong> {{ config('data.state.'.$user->state) ?? ucfirst($user->state) }}</p>
                            <p><strong>City:</strong> {{ ucfirst($user->city) }}</p>
                        </div>
                    </div>
                
                    <!-- Address / Contact Information Section -->
                    @if(!$showButton)
                    <div>
                        <h4 class="text-center"  style="border-top: 1px solid #ccc; padding-top: 10px;">Address / Contact Information</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Address:</strong> {{ $user->address_line_1 }}, {{ $user->address_line_2 }}</p>
                            <p><strong>Landmark:</strong> {{ $user->landmark }}</p>
                            <p><strong>Pincode:</strong> {{ $user->pincode }}</p>
                            <p><strong>Mobile:</strong> {{ $user->mobile }}</p>
                            <p><strong>Landline:</strong> {{ $user->landline }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="card">
                    <!-- About Life Partner Profile Section -->
                    <div>
                        <h4 class="text-center">About Life Partner Profile</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Partner Min Age:</strong> {{ $user->partner_min_age }}</p>
                            <p><strong>Partner Max Age:</strong> {{ $user->partner_max_age }}</p>
                            <p><strong>Partner Min Height:</strong> {{ $user->partner_min_height }}</p>
                            <p><strong>Partner Max Height:</strong> {{ $user->partner_max_height }}</p>
                        </div>
                    </div>
                
                    <!-- Expected Information About Partners Section -->
                    <div>
                        <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Expected Information About Partners</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Partner Income:</strong> {{ ucfirst($user->partner_income) }} {{ ucfirst($user->partner_currency) }}</p>
                            <p><strong>Partner Currency:</strong> {{ config('data.partner_currency.'.$user->partner_currency) ?? ucfirst($user->partner_currency) }}</p>
                            <p><strong>Want to See Patrika:</strong> {{ $user->want_to_see_patrika === 'yes' ? 'Yes' : ($user->want_to_see_patrika === 'no' ? 'No' : '') }}</p>
                            <p><strong>Partner Eating Habit:</strong> {{ config('data.partner_eating_habbit.'.$user->partner_eating_habbit) ?? ucfirst($user->partner_eating_habbit) }}</p>
                            <p><strong>Partner City Preference:</strong> {{ ucfirst($user->partner_city_preference) }}</p>
                            <p><strong>Partner Education:</strong> {{ ucfirst($user->partner_education) }}</p>
                            <p><strong>Partner Job:</strong> {{ ucfirst($user->partner_job) }}</p>
                            <p><strong>Partner Business:</strong> {{ ucfirst($user->partner_business) }}</p>
                            <p><strong>Partner Foreign Resident:</strong> {{ $user->partner_foreign_resident === 'yes' ? 'Yes' : ($user->partner_foreign_resident === 'no' ? 'No' : '') }}</p>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    </div>

    {{-- image display --}}
    <script>
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
         // interest toggle
         function interestToggle(userId, isInterest) {
                return {
                    interestId: userId,
                    isInterest: isInterest,
                    message: '',
                    async submit() {
                        const endpoint = this.isInterest 
                            ? '{{ route('profiles.remove_interest') }}' 
                            : '{{ route('profiles.show_interest') }}';
        
                        try {
                            const response = await fetch(endpoint, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: JSON.stringify({ interest_id: this.interestId }),
                            });
        
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
        
                            const data = await response.json();
                            console.log(data);
                            this.message = data.message;
        
                            // Toggle favorite state
                            this.isInterest = !this.isInterest;
                        } catch (error) {
                            this.message = 'An error occurred: ' + error.message;
                        }
                    }
                }
            }
    </script>
</x-layout.user_banner>
