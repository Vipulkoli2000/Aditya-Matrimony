<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile PDF</title>
    <!--
      If "Berliana Elemixia Script" is available via Google Fonts, you can try including it like below.
      Otherwise, use @font-face to load local font files.
      Uncomment and modify the link below if needed.
    -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Berliana+Elemixia+Script&display=swap" rel="stylesheet"> -->
    <style>
        /* Load custom font if available locally */
        @font-face {
            font-family: 'Berliana Elemixia Script';
            src: local('Berliana Elemixia Script'),
                 url('BerlianaElemixiaScript.woff2') format('woff2'),
                 url('BerlianaElemixiaScript.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        
        /* General Styles */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            margin: 20px;
            background-color: #ffffff;
            color: #444;
            line-height: 1.6;
        }
        /* Main Heading */
        h1 {
            text-align: center;
            margin: 20px 0;
            padding: 15px;
            background-color: #fff;
            color: #d32f2f;
            font-family: 'Berliana Elemixia Script', 'Berliana', cursive;
            font-size: 31px;
            border-bottom: 2px solid #d32f2f;
        }
        /* Profile Images */
        .profile-images {
            text-align: center;
            margin: 30px 0;
        }
        .profile-images img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin: 0 10px;
            border-radius: 50%;
            border: 3px solid #d32f2f;
            transition: transform 0.3s ease;
        }
        .profile-images img:hover {
            transform: scale(1.05);
        }
        .profile-header .full-name {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }
        .profile-header .role {
            font-size: 14px;
            color: #555;
            margin: 0;
        }
        /* Profile Section */
        .profile-section {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #d32f2f;
            border-radius: 5px;
        }
        .profile-section h2 {
            margin-top: 0;
            color: #d32f2f;
            border-bottom: 2px solid #d32f2f;
            padding-bottom: 5px;
            font-size: 15px;
        }
        .profile-field {
            margin: 8px 0;
            border-bottom: 1px solid #ccc;
            padding: 0px 0;
        }
        .profile-field:last-child {
            border-bottom: none;
        }
        .profile-field span {
            font-weight: bold;
            display: inline-block;
            width: 200px;
        }
        /* Footer */
        .footer {
            text-align: center;
            font-size: 7px;
            color: #777;
            margin-top: 40px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        /* Printed On Timestamp (fixed at bottom-right) */
        .print-timestamp {
            position: fixed;
            bottom: 10px;
            right: 10px;
            font-size: 10px;
            color: #777;
        }
        @media print {
            .print-timestamp {
                position: fixed;
                bottom: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Aditya Matrimony</h1>
    
    <!-- Profile Images -->
    <div class="profile-images">
        @if($profile->img_1 || $profile->img_2 || $profile->img_3)
            @if($profile->img_1)
                <img src="file://{{ public_path('storage/images/' . $profile->img_1) }}" alt="Profile Image 1" style="display: inline-block;">
            @endif
            @if($profile->img_2)
                <img src="file://{{ public_path('storage/images/' . $profile->img_2) }}" alt="Profile Image 2" style="display: inline-block;">
            @endif
            @if($profile->img_3)
                <img src="file://{{ public_path('storage/images/' . $profile->img_3) }}" alt="Profile Image 3" style="display: inline-block;">
            @endif
        @else
            <div style="width:130px; height:150px; display:flex; align-items:center; justify-content:center; text-align:center; border:1px solid #ccc; margin: 0 auto;">
                <p style="margin: 10px;">No image uploaded</p>
            </div>
        @endif
        <div class="profile-header">
            <h2 class="full-name">
                {{ $profile->first_name ? ucfirst($profile->first_name) : 'Cant Display Label Name' }} 
                {{ $profile->middle_name ? ucfirst($profile->middle_name) : '' }} 
                {{ $profile->last_name ? ucfirst($profile->last_name) : '' }}
            </h2>
            <p class="role">
                {{ $profile->role ? ucfirst($profile->role) : 'NA' }}
            </p>
        </div>
    </div>

 
    
    <!-- Personal Information -->
    <div class="profile-section">
        <h2>Personal Information</h2>
        <div class="profile-field">
            <span>Full Name:</span> 
            {{ $profile->first_name ? ucfirst($profile->first_name) : 'NA' }} 
            {{ $profile->middle_name ? ucfirst($profile->middle_name) : 'NA' }} 
            {{ $profile->last_name ? ucfirst($profile->last_name) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother Tongue:</span> {{ $profile->mother_tongue ? ucfirst($profile->mother_tongue) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Native Place:</span> {{ $profile->native_place ? ucfirst($profile->native_place) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Gender:</span> {{ $profile->gender ? ucfirst($profile->gender) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Marital Status:</span> {{ $profile->marital_status ? ucfirst($profile->marital_status) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Living With:</span> {{ $profile->living_with ? ucfirst($profile->living_with) : 'NA' }}
        </div>
    </div>
    
    <!-- Health Information -->
    <div class="profile-section">
        <h2>Health Information</h2>
        <div class="profile-field"><span>Blood Group:</span> {{ $profile->blood_group ? ucfirst($profile->blood_group) : 'NA' }}</div>
        <div class="profile-field"><span>Height:</span> {{ $profile->height ? ucfirst($profile->height) : 'NA' }}</div>
        <div class="profile-field"><span>Weight:</span> {{ $profile->weight ? ucfirst($profile->weight) : 'NA' }}</div>
        <div class="profile-field"><span>Body Type:</span> {{ $profile->body_type ? ucfirst($profile->body_type) : 'NA' }}</div>
        <div class="profile-field"><span>Complexion:</span> {{ $profile->complexion ? ucfirst($profile->complexion) : 'NA' }}</div>
        <div class="profile-field">
            <span>Physical Abnormality:</span> {{ $profile->physical_abnormality == 1 ? 'Yes' : 'No' }}
        </div>
        <div class="profile-field">
            <span>Spectacles:</span> {{ $profile->spectacles == 1 ? 'Yes' : 'No' }}
        </div>
        <div class="profile-field">
            <span>Lens:</span> {{ $profile->lens == 1 ? 'Yes' : 'No' }}
        </div>
        <div class="profile-field">
            <span>Eating Habits:</span> {{ $profile->eating_habits ? ucfirst($profile->eating_habits) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Drinking Habits:</span> {{ $profile->drinking_habits ? ucfirst($profile->drinking_habits) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Smoking Habits:</span> {{ $profile->smoking_habits ? ucfirst($profile->smoking_habits) : 'NA' }}
        </div>
    </div>
    
    <!-- Food Habits -->
    <div class="profile-section">
        <h2>Food Habits</h2>
        <div class="profile-field">
            <span>Eating Habits:</span> {{ $profile->eating_habits ? ucfirst($profile->eating_habits) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Drinking Habits:</span> {{ $profile->drinking_habits ? ucfirst($profile->drinking_habits) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Smoking Habits:</span> {{ $profile->smoking_habits ? ucfirst($profile->smoking_habits) : 'NA' }}
        </div>
    </div>
    
    <!-- About Self -->
    <div class="profile-section">
        <h2>About Self</h2>
        <div class="profile-field">
            {{ $profile->about_self ? ucfirst($profile->about_self) : 'NA' }}
        </div>
    </div>
    
    <!-- Religious Information -->
    <div class="profile-section">
        <h2>Religious Information</h2>
        <div class="profile-field">
            <span>Religion:</span> {{ $profile->religion ? ucfirst($profile->religion) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Cast:</span> {{ $profile->cast ? ucfirst($profile->cast) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Gotra:</span> {{ $profile->gotra ? ucfirst($profile->gotra) : 'NA' }}
        </div>
    </div>
    
    <!-- Family Details -->
    <div class="profile-section">
        <h2>Family Details</h2>
        <div class="profile-field">
            <span>Father is Alive:</span> {{ $profile->father_is_alive == 1 ? 'Yes' : 'No' }}
        </div>
        <div class="profile-field">
            <span>Father's Name:</span> {{ $profile->father_name ? ucfirst($profile->father_name) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Father's Occupation:</span> {{ $profile->father_occupation ? ucfirst($profile->father_occupation) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Father's Organization:</span> {{ $profile->father_organization ? ucfirst($profile->father_organization) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Father's Job Type:</span> {{ $profile->father_job_type ? ucfirst($profile->father_job_type) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother is Alive:</span> {{ $profile->mother_is_alive == 1 ? 'Yes' : 'No' }}
        </div>
        <div class="profile-field">
            <span>Mother's Name:</span> {{ $profile->mother_name ? ucfirst($profile->mother_name) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother's Occupation:</span> {{ $profile->mother_occupation ? ucfirst($profile->mother_occupation) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother's Job Type:</span> {{ $profile->mother_job_type ? ucfirst($profile->mother_job_type) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother's Organization Name:</span> {{ $profile->mother_organization ? ucfirst($profile->mother_organization) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother's Name Before Marriage:</span> {{ $profile->mother_name_before_marriage ? ucfirst($profile->mother_name_before_marriage) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mother's Native Place:</span> {{ $profile->mother_native_place ? ucfirst($profile->mother_native_place) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Brothers (Married):</span> {{ $profile->number_of_brothers_married ? ucfirst($profile->number_of_brothers_married) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Brothers (Unmarried):</span> {{ $profile->number_of_brothers_unmarried ? ucfirst($profile->number_of_brothers_unmarried) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Brother Resident Place:</span> {{ $profile->brother_resident_place ? ucfirst($profile->brother_resident_place) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Sisters (Married):</span> {{ $profile->number_of_sisters_married ? ucfirst($profile->number_of_sisters_married) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Sisters (Unmarried):</span> {{ $profile->number_of_sisters_unmarried ? ucfirst($profile->number_of_sisters_unmarried) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Sister Resident Place:</span> {{ $profile->sister_resident_place ? ucfirst($profile->sister_resident_place) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>About Parents:</span> {{ $profile->about_parents ? ucfirst($profile->about_parents) : 'NA' }}
        </div>
    </div>
    
    <!-- Birth Details -->
<div class="profile-section">
      <h2>Astronomy Details</h2>
     <div class="profile-field">
        <span>Date of Birth:</span> {{ $profile->date_of_birth ? ucfirst($profile->date_of_birth) : 'NA' }}
     </div>
      <div class="profile-field">
         <span>Birth Time:</span> {{ $profile->birth_time ? ucfirst($profile->birth_time) : 'NA' }}
      </div>
      <div class="profile-field">
          <span>Birth Place:</span> {{ $profile->birth_place ? ucfirst($profile->birth_place) : 'NA' }}
      </div>

        @if($profile->img_patrika)
            <img src="file://{{ public_path('storage/images/' . $profile->img_patrika) }}" alt="Patrika Image" 
              style="display: inline-block; width: 630px; height: 300px;">
       @else
         <div style="width:500px; height:200px; display:flex; align-items:center; justify-content:center; text-align:center; border:1px solid #ccc; margin: 0 auto;">
             <p style="margin: 10px;">No image uploaded</p>
            </div>
      @endif
</div>

    
    <!-- Education & Occupation -->
    <div class="profile-section">
        <h2>Education & Occupation</h2>
        <div class="profile-field">
            <span>Highest Education:</span> {{ $profile->highest_education ? ucfirst($profile->highest_education) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Education in Detail:</span> {{ $profile->education_in_detail ? ucfirst($profile->education_in_detail) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Additional Degree:</span> {{ $profile->additional_degree ? ucfirst($profile->additional_degree) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Occupation:</span> {{ $profile->occupation ? ucfirst($profile->occupation) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Organization:</span> {{ $profile->organization ? ucfirst($profile->organization) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Designation:</span> {{ $profile->designation ? ucfirst($profile->designation) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Job Location:</span> {{ $profile->job_location ? ucfirst($profile->job_location) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Job Experience:</span> {{ $profile->job_experience ? ucfirst($profile->job_experience) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Income:</span> {{ $profile->income ? ucfirst($profile->income) : 'NA' }} {{ $profile->currency ? ucfirst($profile->currency) : '' }}
        </div>
    </div>
    
    <!-- Contact Details -->
    <div class="profile-section">
        <h2>Contact Details</h2>
        <div class="profile-field">
            <span>Country:</span> {{ $profile->country ? ucfirst($profile->country) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>State:</span> {{ $profile->state ? ucfirst($profile->state) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>City:</span> {{ $profile->city ? ucfirst($profile->city) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Address Line 1:</span> {{ $profile->address_line_1 ? ucfirst($profile->address_line_1) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Address Line 2:</span> {{ $profile->address_line_2 ? ucfirst($profile->address_line_2) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Landmark:</span> {{ $profile->landmark ? ucfirst($profile->landmark) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Pincode:</span> {{ $profile->pincode ? ucfirst($profile->pincode) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Mobile:</span> {{ $profile->mobile ? ucfirst($profile->mobile) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Landline:</span> {{ $profile->landline ? ucfirst($profile->landline) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Email:</span> {{ $profile->email ? ucfirst($profile->email) : 'NA' }}
        </div>
    </div>
    
    <!-- Partner Preferences -->
    <div class="profile-section">
        <h2>Partner Preferences</h2>
        <div class="profile-field">
            <span>Partner Minimum Age:</span> {{ $profile->partner_min_age ? ucfirst($profile->partner_min_age) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Maximum Age:</span> {{ $profile->partner_max_age ? ucfirst($profile->partner_max_age) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Minimum Height:</span> {{ $profile->partner_min_height ? ucfirst($profile->partner_min_height) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Maximum Height:</span> {{ $profile->partner_max_height ? ucfirst($profile->partner_max_height) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Income:</span> {{ $profile->partner_income ? ucfirst($profile->partner_income) : 'NA' }} {{ $profile->partner_currency ? ucfirst($profile->partner_currency) : '' }}
        </div>
        <div class="profile-field">
            <span>Want to See Patrika:</span> {{ $profile->want_to_see_patrika ? ucfirst($profile->want_to_see_patrika) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Sub Cast:</span> {{ $profile->partner_sub_cast ? ucfirst($profile->partner_sub_cast) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Eating Habit:</span> {{ $profile->partner_eating_habbit ? ucfirst($profile->partner_eating_habbit) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner City Preference:</span> {{ $profile->partner_city_preference ? ucfirst($profile->partner_city_preference) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Education:</span> {{ $profile->partner_education ? ucfirst($profile->partner_education) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Education Specialization:</span> {{ $profile->partner_education_specialization ? ucfirst($profile->partner_education_specialization) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Job:</span> {{ $profile->partner_job ? ucfirst($profile->partner_job) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Business:</span> {{ $profile->partner_business ? ucfirst($profile->partner_business) : 'NA' }}
        </div>
        <div class="profile-field">
            <span>Partner Foreign Resident:</span> {{ $profile->partner_foreign_resident ? ucfirst($profile->partner_foreign_resident) : 'NA' }}
        </div>
    </div>
    
    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') ? ucfirst(config('app.name')) : 'NA' }}. @lang('All rights reserved.')
    </div>
    <!-- Printed On Timestamp -->
    <div class="print-timestamp">
        Printed on: {{ date("Y-m-d H:i:s") }}
    </div>
</body>
</html>
