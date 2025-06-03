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
        .panel {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px; /* Limit on large screens */
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
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f7f7f7;
            height: 100px;
        }
        .form-group input[type="file"] {
            display: block;
            margin: 0 auto;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f7f7f7;
        }
        .sidebar {
            width: 300px; /* Sidebar width on larger screens */
            position: sticky;
            top: 0;
            height: 100vh;
            background-color: #f5f5f5;
            padding: 15px;
            border-left: 1px solid #ddd;
        }
        /* Checkbox styling */
        .form-check {
            display: flex;
            align-items: center;
        }
        /* .form-check-input {
            appearance: checkbox;
            width: 16px;
            height: 16px;
            margin-right: 150px;
            cursor: pointer;
            outline: none;
        } */
        .form-check-label {
            font-size: 14px;
            color: #333;
        }
        /* Progress bar */
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
        /* Mobile Responsive Styles */
        @media only screen and (max-width: 768px) {
            .panel {
                max-width: 100% !important;
                margin: 10px auto !important;
                padding: 15px;
            }
            .l {
                width: 100% !important;
                margin: 0;
                padding: 0;
            }
            .form-row {
                flex-direction: column;
            }
            .form-group {
                margin-bottom: 15px;
            }
            /* Force the form and sidebar to stack in one column */
            form,
            .sidebar {
                width: 100% !important;
                display: block !important;
                float: none !important;
                margin: 0 !important;
            }
            .custom-container {
                flex-direction: column;
            }
  
            .form-container,
            .sidebar {
                width: 100%;
            }
  
            /* Optionally, adjust the sidebar styling for mobile */
            .sidebar {
                position: relative;
                height: auto;
                border-left: none;
                border-top: 1px solid #ddd;
            }
        }
        /* Additional Responsive Adjustments */
        @media only screen and (max-width: 576px) {
            .panel {
                padding: 10px;
            }
            .card-header h5 {
                font-size: 1.2rem;
            }
            .card-body h3 {
                font-size: 1.5rem;
            }
            .form-group label {
                font-size: 14px;
            }
            .progress {
                height: 8px;
            }
            .progress-bar {
                height: 8px;
            }
        }
        @media only screen and (max-width: 992px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
                border-left: none;
                border-top: 1px solid #ddd;
            }
        }
        .custom-container {
            display: flex;
            gap: 20px; /* Adjust spacing as needed */
            margin-left: 20px; /* Added left margin */
        }
  
        .form-container {
            flex: 1;
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
    </style>
    <div class="custom-container">
        <div class="form-container">
            <form action="<?php echo e(route('profiles.basic_details_store')); ?>" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="redirect_url" id="redirect_url" value="">

                <?php echo csrf_field(); ?>
               
                <div class="card border-0 rounded-4 mt-4 me-4 overflow-hidden" 
                    style="border-radius: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);">
                    
                    <div class="card-header text-white py-3 position-relative text-center" 
                        style="background-color: #FF0000; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                        <h5 class="mb-0 text-white fw-bold">
                            Welcome, <?php echo e($user->first_name); ?> <?php echo e($user->middle_name); ?> <?php echo e($user->last_name); ?>

                        </h5>
                        <?php
                            // Sort packages descending by expiry date and get the first item
                            $latestPackage = $purchased_packages->sortByDesc('pivot.expires_at')->first();
                        ?>
                        
                        <?php if($latestPackage): ?>
                            <p class="mb-0 text-white">
                                <strong>Package Name:</strong> <?php echo e($latestPackage->name); ?> | 
                                <strong>Expiry Date:</strong> <?php echo e(\Carbon\Carbon::parse($latestPackage->pivot->expires_at)->format('d-m-Y')); ?>

                            </p>
                        <?php endif; ?>
                        
                    </div>
                    <div class="card-body text-center p-4">
                        <h3 class="fw-bold text-secondary">Profile Completion</h3>
                        <div class="progress mt-3 rounded-pill" style="height: 10px;">
                            <div class="progress-bar bg-success rounded-pill" role="progressbar"
                                style="width: <?php echo e($profileCompletion); ?>%;" 
                                aria-valuenow="<?php echo e($profileCompletion); ?>" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                            </div>
                        </div>
                        <p class="mt-2 text-muted fw-semibold"><?php echo e($profileCompletion); ?>% Completed</p>
                    </div>
                </div>
                <h3 class="text-center" style="color: #FF3846; margin: 20px;">Basic Details</h3>
                <div class="panel">
                    <h2>Personal Information</h2>
                    <!-- Row with First Name, Middle Name, and Last Name in one line -->    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" value="<?php echo e(old('first_name', $user->first_name)); ?>" id="first_name" placeholder="Enter first name" required>
                            <?php if($errors->has('first_name')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('first_name')); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="middle_name">Middle Name <span class="text-danger">*</span></label>
                            <input type="text" name="middle_name" value="<?php echo e(old('middle_name', $user->middle_name)); ?>" id="middle_name" placeholder="Enter Middle name" required>
                            <?php if($errors->has('middle_name')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('middle_name')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" value="<?php echo e(old('last_name', $user->last_name)); ?>" id="last_name" placeholder="Enter Last name" required>
                            <?php if($errors->has('last_name')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('last_name')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Second row with Mother Tongue and Native Place -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="mother_tongue">Mother Tongue <span class="text-danger">*</span></label>
                            <select name="mother_tongue" class="form-input" id="mother_tongue">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.mother_tongues', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('mother_tongue', $user->mother_tongue) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('mother_tongue')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('mother_tongue')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="native_place">Native Place <span class="text-danger">*</span></label>
                            <input type="text" name="native_place" value="<?php echo e(old('native_place', $user->native_place)); ?>" id="native_place" placeholder="Enter Native Place">
                            <?php if($errors->has('native_place')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('native_place')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-input">
                                <option value="" selected>select an option</option>
                                <?php if(config('data.gender')): ?>
                                    <?php $__currentLoopData = config('data.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>" <?php echo e(old('gender', $user->gender) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php if($errors->has('gender')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('gender')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                            <select class="form-input" name="marital_status" id="marital_status">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.marital_status', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('marital_status', $user->marital_status) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            </select>
                            <?php if($errors->has('marital_status')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('marital_status')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="living_with">Living With <span class="text-danger">*</span></label>
                            <select class="form-input" name="living_with" id="living_with">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.living_with', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('living_with', $user->living_with) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('living_with')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('living_with')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Health Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="blood_group">Blood Group <span class="text-danger">*</span></label>
                            <select class="form-input" name="blood_group" id="blood_group">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.blood_group', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('blood_group', $user->blood_group) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('blood_group')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('blood_group')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="height">Height <span class="text-danger">*</span></label>
                            <select class="form-input" name="height" id="height">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.height', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('height', $user->height) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </select>
                            <?php if($errors->has('height')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('height')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg) <span class="text-danger">*</span></label>
                            <input type="text" name="weight" value="<?php echo e(old('weight', $user->weight)); ?>" id="weight" placeholder="Enter Weight in Kgs">
                            <?php if($errors->has('weight')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('weight')); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="body_type">Body Type <span class="text-danger">*</span></label>
                            <select class="form-input" name="body_type" id="body_type">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.body_type', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('body_type', $user->body_type) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('body_type')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('body_type')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Complexion <span class="text-danger">*</span></label>
                            <select class="form-input" name="complexion" id="complexion">
                                <option value="" selected>select an option</option>
                                <?php $__currentLoopData = config('data.complexion'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('complexion', $user->complexion) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select> 
                            <?php if($errors->has('complexion')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('complexion')); ?></span>
                            <?php endif; ?>                 
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group me-">
                            <label for="physical_abnormality">Physical Abnormality <span class="text-danger">*</span></label>
                            <select class="form-input" name="physical_abnormality" id="physical_abnormality">
                                <option value="" selected>select an option</option>
                                <option value="1" <?php echo e(old('physical_abnormality', $user->physical_abnormality) == 1 ? 'selected' : ''); ?>>Yes</option>
                                <option value="0" <?php echo e(old('physical_abnormality', $user->physical_abnormality) == 0 ? 'selected' : ''); ?>>No</option>
                            </select>
                            <?php if($errors->has('physical_abnormality')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('physical_abnormality')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="spectacles" class="me-3 mt-4">Spectacles</label>
                            <input type="checkbox" name="spectacles" id="spectacles" value="1" 
                                <?php echo e(old('spectacles', $user->spectacles) ? 'checked' : ''); ?>

                                style="appearance: checkbox; width: 16px; margin-top: 21px; height: 16px; cursor: pointer; outline: none;">
                        </div>
                        
                        <div class="form-group d-flex align-items-center">
                            <label for="lens" class="me-3 mt-4">Lens</label>                
                            <input type="checkbox"  name="lens" id="lens" value="1" 
                                <?php echo e(old('lens', $user->lens) ? 'checked' : ''); ?>

                                style="appearance: checkbox; width: 16px; margin-top: 21px; height: 16px; cursor: pointer; outline: none;">
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <h2>Food Habits</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="eating_habits">Eating Habbits</label>
                            <select class="form-input" name="eating_habits" id="eating_habits">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.eating_habits', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('eating_habits', $user->eating_habits) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('eating_habits')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('eating_habits')); ?></span>
                            <?php endif; ?>     
                        </div>
                        <div class="form-group">
                            <label for="drinking_habits">Drinking Habbits</label>
                            <select class="form-input" name="drinking_habits" id="drinking_habbits">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.drinking_habits', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('drinking_habits', $user->drinking_habits) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('drinking_habits')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('drinking_habits')); ?></span>
                            <?php endif; ?>     
                        </div>
                        <div class="form-group">
                            <label for="smoking_habits">Smoking Habbits</label>
                            <select class="form-input" name="smoking_habits" id="smoking_habbits">
                                <option value="" selected>Select an option</option>
                                <?php $__currentLoopData = config('data.smoking_habits', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value); ?>" <?php echo e(old('smoking_habits', $user->smoking_habits) === $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('smoking_habits')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('smoking_habits')); ?></span>
                            <?php endif; ?>     
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="form-group">
                        <label for="about_self">About Yourself</label>
                        <textarea name="about_self" id="about_self" class="form-input" placeholder="Tell us about yourself..."><?php echo e(old('about_self', $user->about_self)); ?></textarea>
                        <?php if($errors->has('about_self')): ?>
                        <span class="text-danger small"><?php echo e($errors->first('about_self')); ?></span>
                        <?php endif; ?>     
                    </div>
                </div>
                <div class="panel">
                    <h2>Upload Photos</h2>
                    <div class="alert alert-info mb-4">
                        <p><strong>Image Requirements:</strong></p>
                        <ul>
                            <li>Allowed formats: JPEG, PNG, JPG, GIF</li>
                            <li>Maximum file size: 2MB</li>
                            <li>Recommended dimensions: 500 × 700 pixels</li>
                        </ul>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="photo1">Photo 1</label>
                            <input type="file" name="img_1" id="photo1" value="<?php echo e($user->img_1); ?>">
                            <?php if($errors->has('img_1')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('img_1')); ?></span>
                            <?php endif; ?>  
                        </div>
                        <div class="form-group">
                            <label for="photo2">Photo 2</label>
                            <input type="file" name="img_2" id="photo2">
                            <?php if($errors->has('img_2')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('img_2')); ?></span>
                            <?php endif; ?>  
                        </div>
                        <div class="form-group">
                            <label for="photo3">Photo 3</label>
                            <input type="file" name="img_3" id="photo3">
                            <?php if($errors->has('img_3')): ?>
                            <span class="text-danger small"><?php echo e($errors->first('img_3')); ?></span>
                            <?php endif; ?>  
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <?php if($user->img_1): ?>
                            <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_1); ?>')">
                                <template x-if="imageUrl">
                                    <div class="d-flex flex-column align-items-center">
                                        <a :href="imageUrl" target="_blank">
                                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                                        </a>
                                        <form action="<?php echo e(route('profiles.basic_details_store')); ?>" method="POST" class="mt-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="remove_img_1" value="1">
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Photo 1</button>
                                        </form>
                                    </div>
                                </template>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php if($user->img_2): ?>
                            <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_2); ?>')">
                                <template x-if="imageUrl">
                                    <div class="d-flex flex-column align-items-center">
                                        <a :href="imageUrl" target="_blank">
                                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                                        </a>
                                        <form action="<?php echo e(route('profiles.basic_details_store')); ?>" method="POST" class="mt-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="remove_img_2" value="1">
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Photo 2</button>
                                        </form>
                                    </div>
                                </template>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <?php if($user->img_3): ?>
                            <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_3); ?>')">
                                <template x-if="imageUrl">
                                    <div class="d-flex flex-column align-items-center">
                                        <a :href="imageUrl" target="_blank">
                                            <img style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                                        </a>
                                        <form action="<?php echo e(route('profiles.basic_details_store')); ?>" method="POST" class="mt-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="remove_img_3" value="1">
                                            <button type="submit" class="btn btn-danger btn-sm">Remove Photo 3</button>
                                        </form>
                                    </div>
                                </template>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <div id="customModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
                        <div style="background: #ffcccc; border: 2px solid #ff0000; border-radius: 8px; padding: 20px; max-width: 400px; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                          <p>You have unsaved changes. Do you really want to leave this page without saving?</p>
                          <div style="margin-top: 20px;">
                            <button id="modalYes" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">Yes, leave page</button>
                            <button id="modalNo" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">No, stay on page</button>
                          </div>
                        </div>
                      </div>
                </div>
            </form>
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
    <script>
        // Insert textarea dynamically (if required)
        const textareaContainer = document.getElementById('textarea-container');
        const formGroupDiv = document.createElement('div');
        formGroupDiv.className = 'form-group';
        const label = document.createElement('label');
        label.setAttribute('for', 'eating_habbits');
        label.textContent = 'Eating Habits';
        const textarea = document.createElement('textarea');
        textarea.id = 'eating_habbits';
        textarea.placeholder = 'Describe your eating habits';
        formGroupDiv.appendChild(label);
        formGroupDiv.appendChild(textarea);
        textareaContainer.appendChild(formGroupDiv);
    </script>
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

    

    <div id="customModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: #ffcccc; border: 2px solid #ff0000; border-radius: 8px; padding: 20px; max-width: 400px; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      <p>You have unsaved changes. Do you really want to leave this page without saving?</p>
      <div style="margin-top: 20px;">
        <button id="modalYes" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">Yes, leave page and save the made changes</button>
        <button id="modalNo" style="background: #ff0000; color: #fff; border: none; padding: 10px 15px; margin: 0 10px; border-radius: 4px; cursor: pointer;">No, stay on page</button>
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/basic_details/index.blade.php ENDPATH**/ ?>