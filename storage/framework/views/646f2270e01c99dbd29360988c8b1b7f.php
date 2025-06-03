<?php if (isset($component)) { $__componentOriginal586923fd33be01a728ed95ac16e3596d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal586923fd33be01a728ed95ac16e3596d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.user_banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.user_banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
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
            flex: 1 0 21%; /* 21% width on larger screens */
            margin: 5px;
            min-width: 200px;
        }

        .image-gallery {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .profile-image {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
            border: 1px solid #ddd;
            object-fit: cover;
            height: 150px;
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

        .form-group {
            margin-right: 15px;
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
            background-color: #ff0000;
            color: white !important;
            border: none;
        }

        /* Mobile Responsive Styles for screens up to 768px */
        @media (max-width: 768px) {
            .card {
                padding: 15px;
                margin: 10px;
            }

            /* Stack card-row items in a single column */
            .card-row {
                flex-direction: column;
            }

            .card-row p {
                flex: 1 0 100%;
                min-width: auto;
                margin: 5px 0;
            }

            /* Center the image gallery */
            .image-gallery {
                justify-content: center;
            }

            /* Sidebar adjustments */
            .sidebar {
                width: 100%;
                position: static;
                height: auto;
                border-left: none;
                margin-top: 20px;
            }
            
            .form-container {
                flex-direction: column;
            }
        }

        /* Additional Mobile Responsive Styles for screens up to 320px */
        @media (max-width: 320px) {
            .card {
                padding: 10px;
                margin: 5px;
            }
            /* Force grid-based card rows to a single column */
            .card-row {
                grid-template-columns: 1fr !important;
            }
            .card-row p {
                flex: 1 0 100%;
                min-width: 0;
                margin: 5px 0;
                font-size: 14px;
            }
            .profile-image {
                max-width: 80px;
                height: auto;
                height: 120px;
            }
            .form-container {
                gap: 10px;
            }
        }

        .form-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 20px; /* Space between form and sidebar */
        }

        /* Ensure the main form area takes up available space */
        .card-container {
            flex: 1;
        }
    </style>

    <div class="container">
        <div class="form-container">

            <div class="card-container">
                <h3>Profile Images</h3>
                <div class="form-row image-gallery">
                    <div class="form-group">
                        <?php if($user->img_1): ?>
                        <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_1); ?>')">
                            <template x-if="imageUrl">
                                <img class="profile-image" :src="imageUrl" alt="Uploaded Image" />
                            </template>
                            <template x-if="!imageUrl">
                                <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                                    <p style="text-align: center;">No image uploaded</p>
                                </div>
                            </template>
                        </div>
                        <?php else: ?>
                        <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                            <p style="text-align: center;">No image uploaded</p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <?php if($user->img_2): ?>
                        <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_2); ?>')">
                            <template x-if="imageUrl">
                                <img class="profile-image" :src="imageUrl" alt="Uploaded Image" />
                            </template>
                            <template x-if="!imageUrl">
                                <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                                    <p style="text-align: center;">No image uploaded</p>
                                </div>
                            </template>
                        </div>
                        <?php else: ?>
                        <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                            <p style="text-align: center;">No image uploaded</p>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <?php if($user->img_3): ?>
                        <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_3); ?>')">
                            <template x-if="imageUrl">
                                <img class="profile-image" :src="imageUrl" alt="Uploaded Image" />
                            </template>
                            <template x-if="!imageUrl">
                                <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                                    <p style="text-align: center;">No image uploaded</p>
                                </div>
                            </template>
                        </div>
                        <?php else: ?>
                        <div class="profile-image" style="display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8;">
                            <p style="text-align: center;">No image uploaded</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <h2>Profile Completion</h2>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($profileCompletion); ?>%;" aria-valuenow="<?php echo e($profileCompletion); ?>" aria-valuemin="0" aria-valuemax="100">
                            <?php echo e($profileCompletion); ?>%
                        </div>
                    </div>
                </div>
                <br/>
                <div class="panel">
                    <h3>Your Profile</h3>
                    <div class="card">
                        <h3 class="text-center" style="color: #FF3846;">Basic Profile</h3>
                        <br/>
                        <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Personal Information</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <?php
                            $prefix = $user->role === 'groom' ? 'G' : ($user->role === 'bride' ? 'B' : '');
                        ?>
                        
                        <p><strong>User ID:</strong> <?php echo e($prefix); ?><?php echo e($user->id); ?></p>
                                                      <p><strong>Full Name:</strong> <?php echo e($user->first_name); ?> <?php echo e($user->middle_name); ?> <?php echo e($user->last_name); ?></p>
                            <p><strong>Mother Tongue:</strong> <?php echo e(ucfirst($user->mother_tongue)); ?></p>
                            <p><strong>Native Place:</strong> <?php echo e(ucfirst($user->native_place)); ?></p>
                            <p><strong>Gender:</strong> <?php echo e(ucfirst($user->gender)); ?></p>
                            <p><strong>Marital Status:</strong> <?php echo e(ucfirst($user->marital_status)); ?></p>
                            <p><strong>Living With:</strong> <?php echo e(ucfirst($user->living_with)); ?></p>
                        </div>
                        <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Health Information</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Blood Group:</strong> <?php echo e(ucfirst($user->blood_group)); ?></p>
                            <p><strong>Height:</strong> <?php echo e(ucfirst($user->height)); ?></p>
                            <p><strong>Weight:</strong> <?php echo e(ucfirst($user->weight)); ?></p>
                            <p><strong>Body Type:</strong> <?php echo e(ucfirst($user->body_type)); ?></p>
                            <p><strong>Complexion:</strong> <?php echo e(ucfirst($user->complexion)); ?></p>
                            <p><strong>Physical Abnormality:</strong> <?php echo e(ucfirst($user->physical_abnormality) ? 'Yes' : 'No'); ?></p>
                            <p><strong>Spectacles:</strong> <?php echo e(ucfirst($user->spectacles) ? 'Yes' : 'No'); ?></p>
                            <p><strong>Lens:</strong> <?php echo e(ucfirst($user->lens) ? 'Yes' : 'No'); ?></p>
                        </div>
                        <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Food Habits</h4>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                            <p><strong>Eating Habits:</strong> <?php echo e(config('data.eating_habits.'.$user->eating_habits) ?? ucfirst($user->eating_habits)); ?></p>
                            <p><strong>Drinking Habits:</strong> <?php echo e(config('data.drinking_habits.'.$user->drinking_habits) ?? ucfirst($user->drinking_habits)); ?></p>
                            <p><strong>Smoking Habits:</strong> <?php echo e(config('data.smoking_habits.'.$user->smoking_habits) ?? ucfirst($user->smoking_habits)); ?></p>
                        </div>
                        <div class="card-row" style="border-top: 1px solid #ccc; padding-top: 10px;">
                            <p><strong>About Self:</strong> <?php echo e(ucfirst($user->about_self)); ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="text-center" style="color: #FF3846;">Religious Profile</h3>
                        <br/>
                        <div class="card-row" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                            <div>
                                <p><strong>Religion:</strong> <?php echo e(ucfirst($user->religion)); ?></p>
                            </div>
                            <div>
                                <p><strong>Caste:</strong> <?php echo e(ucfirst($castes)); ?></p>
                            </div>
                            <div>
                                <p><strong>Gotra:</strong> <?php echo e(ucfirst($user->gotra)); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            <div>
                                <h3 class="text-center" style="color: #FF3846;">Family Details</h3>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Father and Mother Details</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <p><strong>Father's Alive:</strong>
                                        <?php if($user->father_is_alive): ?>
                                            <span>Yes</span>
                                        <?php else: ?>
                                            <span>No</span>
                                        <?php endif; ?>
                                    </p>
                                    <p><strong>Father's Name:</strong> <?php echo e(ucfirst($user->father_name)); ?></p>
                                    <p><strong>Father's Occupation:</strong> <?php echo e(ucfirst($user->father_occupation)); ?></p>
                                    <p><strong>Father's Job Type:</strong> <?php echo e(ucfirst($user->father_job_type)); ?></p>
                                    <p><strong>Father's Organization:</strong> <?php echo e(ucfirst($user->father_organization)); ?></p>
                                    <p><strong>Mother's Alive:</strong>
                                        <?php if($user->mother_is_alive === null): ?>
                                            <span></span>
                                        <?php elseif($user->mother_is_alive): ?>
                                            <span>Yes</span>
                                        <?php else: ?>
                                            <span>No</span>
                                        <?php endif; ?>
                                    </p>
                                    <p><strong>Mother's Name:</strong> <?php echo e(ucfirst($user->mother_name)); ?></p>
                                    <p><strong>Mother's Occupation:</strong> <?php echo e(ucfirst($user->mother_occupation)); ?></p>
                                    <p><strong>Mother's Job Type:</strong> <?php echo e(ucfirst($user->mother_job_type)); ?></p>
                                    <p><strong>Mother's Organization:</strong> <?php echo e(ucfirst($user->mother_organization)); ?></p>
                                    <p><strong>Mother's Native Place:</strong> <?php echo e(ucfirst($user->mother_native_place)); ?></p>
                                    <p><strong>Mother's Name Before Marriage:</strong> <?php echo e(ucfirst($user->mother_name_before_marriage)); ?></p>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Brother Details</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <p><strong>Resident Place:</strong> <?php echo e(ucfirst($user->brother_resident_place)); ?></p>
                                    <p><strong>Married:</strong> <?php echo e($user->brother_is_alive ?? 0); ?> <?php echo e(($user->brother_is_alive ?? 0) == 1 ? 'brother' : 'brothers'); ?></p>
                                    <p><strong>Unmarried:</strong> <?php echo e($user->brother_is_alive ?? 0); ?> <?php echo e(($user->brother_is_alive ?? 0) == 1 ? 'brother' : 'brothers'); ?></p>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Sister Details</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <p><strong>Resident Place:</strong> <?php echo e(ucfirst($user->sister_resident_place)); ?></p>
                                    <p><strong>Married:</strong> <?php echo e($user->number_of_sisters_married ?? 0); ?> <?php echo e(($user->number_of_sisters_married ?? 0) == 1 ? 'sister' : 'sisters'); ?></p>
                                    <p><strong>Unmarried:</strong> <?php echo e($user->number_of_sisters_unmarried ?? 0); ?> <?php echo e(($user->number_of_sisters_unmarried ?? 0) == 1 ? 'sister' : 'sisters'); ?></p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card">
                        <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                            <div>
                                <h3 class="text-center" style="color: #FF3846;">Astronomy Details</h3>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Personal Information</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                                    <p><strong>Date:</strong> <?php echo e($user->date_of_birth); ?></p>
                                    <p><strong>Time:</strong> <?php echo e($user->birth_time); ?></p>
                                    <p><strong>Place:</strong> <?php echo e(ucfirst($user->birth_place)); ?></p>
                                 </div>
                            </div>
                            <div>
                                <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Astronomy Information</h5>
                                <div class="card-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                    <p><strong>राशी:</strong> <?php echo e(config('data.rashee.'.$user->rashee) ?? ucfirst($user->rashee)); ?></p>
                                    <p><strong>नक्षत्र:</strong> <?php echo e(config('data.nakshatra.'.$user->nakshatra) ?? $user->nakshatra); ?></p>
                                    <p><strong>मंगळ:</strong> <?php echo e(config('data.mangal.'.$user->mangal) ?? $user->mangal); ?></p>
                                    <p><strong>चरण:</strong> <?php echo e(config('data.charan.'.$user->charan) ?? $user->charan); ?></p>
                                    <p><strong>गण:</strong> <?php echo e(config('data.gana.'.$user->gana) ?? $user->gana); ?></p>
                                    <p><strong>नाडी:</strong> <?php echo e(config('data.nadi.'.$user->nadi) ?? $user->nadi); ?></p>
                                </div>
                            </div>
                            <div>
                                <div >
                                    <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Patrika Image</h5>
                                     <div class="form-group">
                                        <?php if($user->img_patrika): ?>
                                        <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_patrika); ?>')">
                                            <template x-if="imageUrl">
                                            <a style="display: flex; justify-content: center;" :href="imageUrl" target="_blank">
                                                  <img style="width: 80%; height: 80%; border-radius: 10px;" :src="imageUrl" alt="Uploaded Image" />
                                            </a>    
                                                    </template>
                                            <template x-if="!imageUrl">
                                                <div style="width: 80%; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 10px;">
                                                    <p style="text-align: center;">No image uploaded</p>
                                                </div>
                                            </template>
                                        </div>
                                        <?php else: ?>
                                        <div style="width: 80%; height: 200px; margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; background-color: #f8f8f8; border-radius: 10px;">
                                            <p style="text-align: center;">No image uploaded</p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">More About Patrika</h5>

                                <div class="card-row" >
                                    <p> <?php echo e(ucfirst($user->more_about_patrika)); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="text-center" style="color: #FF3846;">Educational Profile</h3>
                        <div style="border-top: 1px solid #ccc; padding-top: 10px;" class="card-row">
                            <p><strong>Highest Education:</strong> <?php echo e(ucfirst($user->highest_education)); ?></p>
                            <p><strong>Other Education:</strong> <?php echo e(ucfirst($user->other_education)); ?></p>
                            <p><strong>Education in Detail:</strong> <?php echo e(ucfirst($user->education_in_detail)); ?></p>
                            <p><strong>Additional Degree:</strong> <?php echo e(ucfirst($user->additional_degree)); ?></p>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <h4 class="text-center" style="color: #FF3846;">Occupation Details</h4>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Organisation Information</h5>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Occupation:</strong> <?php echo e(ucfirst($user->occupation)); ?></p>
                                <p><strong>Organization:</strong> <?php echo e(ucfirst($user->organization)); ?></p>
                                <p><strong>Designation:</strong> <?php echo e(ucfirst($user->designation)); ?></p>
                                <p><strong>Job Location:</strong> <?php echo e(ucfirst($user->job_location)); ?></p>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Experience/Income</h5>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Job Experience:</strong> <?php echo e(ucfirst($user->job_experience)); ?></p>
                                <p><strong>Income:</strong> <?php echo e(ucfirst($user->income)); ?> <?php echo e(ucfirst($user->currency)); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <h4 class="text-center" style="color: #FF3846;">Contact Details</h4>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Location Information</h5>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Country:</strong> <?php echo e(config('data.country.'.$user->country) ?? ucfirst($user->country)); ?></p>
                                <p><strong>State:</strong> <?php echo e(config('data.state.'.$user->state) ?? ucfirst($user->state)); ?></p>
                                <p><strong>City:</strong> <?php echo e(ucfirst($user->city)); ?></p>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Address / Contact Information</h5>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Address:</strong> <?php echo e(ucfirst($user->address_line_1)); ?>, <?php echo e(ucfirst($user->address_line_2)); ?></p>
                                <p><strong>Landmark:</strong> <?php echo e(ucfirst($user->landmark)); ?></p>
                                <p><strong>Pincode:</strong> <?php echo e(ucfirst($user->pincode)); ?></p>
                                <p><strong>Mobile:</strong> <?php echo e(ucfirst($user->mobile)); ?></p>
                                <p><strong>Landline:</strong> <?php echo e(ucfirst($user->landline)); ?></p>
                                <p><strong>Email:</strong> <?php echo e(ucfirst($user->email)); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div>
                            <h4 class="text-center" style="color: #FF3846;">About Life Partner Profile</h4>
                            <h5 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Age / Height Information</h5>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Partner Min Age:</strong> <?php echo e($user->partner_min_age); ?></p>
                                <p><strong>Partner Max Age:</strong> <?php echo e($user->partner_max_age); ?></p>
                                <p><strong>Partner Min Height:</strong> <?php echo e($user->partner_min_height); ?></p>
                                <p><strong>Partner Max Height:</strong> <?php echo e($user->partner_max_height); ?></p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-center" style="border-top: 1px solid #ccc; padding-top: 10px;">Expected Information About Partners</h4>
                            <div class="card-row" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                <p><strong>Partner Income:</strong> <?php echo e(ucfirst($user->partner_income)); ?> <?php echo e(config('data.partner_currency.'.$user->partner_currency) ?? ucfirst($user->partner_currency)); ?></p>
                                <p><strong>Want to See Patrika:</strong> <?php echo e(ucfirst($user->want_to_see_patrika) ? 'Yes' : 'No'); ?></p>
                                <p><strong>Partner Eating Habit:</strong> <?php echo e(config('data.partner_eating_habbit.'.$user->partner_eating_habbit) ?? ucfirst($user->partner_eating_habbit)); ?></p>
                                <p><strong>Partner City Preference:</strong> <?php echo e(ucfirst($user->partner_city_preference)); ?></p>
                                <p><strong>Partner Education:</strong> <?php echo e(ucfirst($user->partner_education)); ?></p>
                                <p><strong>Partner Job:</strong> <?php echo e(ucfirst($user->partner_job)); ?></p>
                                <p><strong>Partner Business:</strong> <?php echo e(ucfirst($user->partner_business)); ?></p>
                                <p><strong>Partner Foreign Resident:</strong> <?php echo e(ucfirst($user->partner_foreign_resident) ? 'Yes' : 'No'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <?php if (isset($component)) { $__componentOriginal8a8b09d2ee8ef1b33fdefd798d08447d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8b09d2ee8ef1b33fdefd798d08447d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.usersidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.usersidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8b09d2ee8ef1b33fdefd798d08447d)): ?>
<?php $attributes = $__attributesOriginal8a8b09d2ee8ef1b33fdefd798d08447d; ?>
<?php unset($__attributesOriginal8a8b09d2ee8ef1b33fdefd798d08447d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8b09d2ee8ef1b33fdefd798d08447d)): ?>
<?php $component = $__componentOriginal8a8b09d2ee8ef1b33fdefd798d08447d; ?>
<?php unset($__componentOriginal8a8b09d2ee8ef1b33fdefd798d08447d); ?>
<?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function imageLoader() {
            return {
                imageUrl: null,
                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null;
                    }
                }
            };
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal586923fd33be01a728ed95ac16e3596d)): ?>
<?php $attributes = $__attributesOriginal586923fd33be01a728ed95ac16e3596d; ?>
<?php unset($__attributesOriginal586923fd33be01a728ed95ac16e3596d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal586923fd33be01a728ed95ac16e3596d)): ?>
<?php $component = $__componentOriginal586923fd33be01a728ed95ac16e3596d; ?>
<?php unset($__componentOriginal586923fd33be01a728ed95ac16e3596d); ?>
<?php endif; ?>
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/view_profile/create.blade.php ENDPATH**/ ?>