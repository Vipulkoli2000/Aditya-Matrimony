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
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f7f7f7;
        }
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

        /*progress bar */
        .profile-completion {
            width: 80%;  
            margin: 0 auto;  
        }
        .progress {
            height: 30px;  
        }
        button.btn {
            background-color: #ff0000; /* Rose Red color */
            color: white !important; /* Ensure text color is white */
            border: none; /* Optional: remove border */
        }

        /* Responsive adjustments for screens up to 425px wide */
        @media screen and (max-width: 425px) {
            .panel {
                padding: 10px;
                margin: 10px;
                max-width: 100%;
            }
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            .profile-completion {
                width: 95%;
            }
            /* Instead of hiding the sidebar, position it off-canvas */
            .sidebar {
                position: fixed;
                top: 0;
                left: -80%;
                width: 80%;
                height: 100%;
                background-color: #f5f5f5;
                padding: 15px;
                border-left: none;
                border-right: 1px solid #ddd;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .sidebar.show {
                left: 0;
            }
            /* Sidebar toggle button */
            .sidebar-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                background-color: #ff3846;
                color: #fff;
                border: none;
                padding: 8px 12px;
                border-radius: 4px;
                z-index: 1100;
                cursor: pointer;
            }
        }

        /* Flex container to position the form and sidebar side-by-side */
        .flex-container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .flex-container > form {
            flex: 1;
            margin-right: 20px;
        }
    </style>

    <div class="flex-container">
        <form action="<?php echo e(route('profiles.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="redirect_url" id="redirect_url" value="">

            <div>
                <div class="profile-completion">
                    <h2>Profile Completion</h2>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" 
                             style="width: <?php echo e($profileCompletion); ?>%;" 
                             aria-valuenow="<?php echo e($profileCompletion); ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            <?php echo e($profileCompletion); ?>%
                        </div>
                    </div>
                </div>
                <h3 class="text-center" style="color: #FF3846;  margin: 20px;">Contact Details</h3>

                <div class="panel">
                    <h4>Location Information</h4>
                    <div class="container mt-3" id="dropdowns">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-input" name="country" id="country">
                                        <option value="" selected>Select an option</option>
                                        <?php $__currentLoopData = config('data.country', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>" <?php echo e(($user->country === $value) ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('country')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('country')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <div class="col hidden" id="stateContainer">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-input" name="state" id="state">
                                        <option value="" selected>Select an option</option>
                                        <?php $__currentLoopData = config('data.state', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value); ?>" <?php echo e(($user->state === $value) ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('state')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('state')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <div class="col hidden" id="cityContainer">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="<?php echo e($user->city); ?>" id="city" placeholder="Enter City" >
                                    <?php if($errors->has('city')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('city')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <h4>Address / Contact Information</h4>
                    <div class="container mt-3">
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="address_line_1" class="form-label">Address Line 1</label>
                                <input type="text" name="address_line_1" value="<?php echo e($user->address_line_1); ?>" id="address_line_1" class="form-control" placeholder="Enter Address Line 1">
                                <?php if($errors->has('address_line_1')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('address_line_1')); ?></span>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="form-group">
                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" name="address_line_2" value="<?php echo e($user->address_line_2); ?>" id="address_line_2" class="form-control" placeholder="Enter Address Line 2">
                                <?php if($errors->has('address_line_2')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('address_line_2')); ?></span>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <div class="form-group">
                                    <label for="landmark" class="form-label">Landmark</label>
                                    <input type="text" name="landmark" value="<?php echo e($user->landmark); ?>" id="landmark" class="form-control" placeholder="Enter Landmark">
                                    <?php if($errors->has('landmark')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('landmark')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input type="text" name="pincode" value="<?php echo e($user->pincode); ?>" id="pincode" class="form-control" placeholder="Enter Pincode">
                                    <?php if($errors->has('pincode')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('pincode')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                        </div>  
                        <div class="row mt-3">
                            <div class="col">
                                <div class="col">
                                    <div class="form-group">
                                      <label for="mobile" class="form-label">Mobile</label>
                                      <input name="mobile" type="text" id="mobile" class="form-control" 
                                             placeholder="1234567890"
                                             value="<?php echo e($user->mobile); ?>" 
                                             title="Please enter a valid 10-digit mobile number">
                                      <?php if($errors->has('mobile')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('mobile')); ?></span>
                                      <?php endif; ?>  
                                    </div>
                                  </div>
                                  
                                  <script>
                                  document.addEventListener("DOMContentLoaded", function() {
                                    const mobileInput = document.getElementById("mobile");
                                  
                                    // Case 1: When the user types the first digit into an empty field,
                                    // automatically insert "+91" before that digit.
                                    mobileInput.addEventListener("keydown", function(e) {
                                      if (mobileInput.value === "" && /^[0-9]$/.test(e.key)) {
                                        e.preventDefault();
                                        mobileInput.value = "+91" + e.key;
                                        mobileInput.setSelectionRange(mobileInput.value.length, mobileInput.value.length);
                                      }
                                    });
                                  
                                    // Case 2: Add "+91" if the value starts with a digit but doesn't already have the prefix.
                                    mobileInput.addEventListener("blur", function() {
                                      let value = mobileInput.value.trim();
                                      if (value && /^[0-9]/.test(value) && !value.startsWith('+91')) {
                                        mobileInput.value = "+91" + value;
                                      }
                                    });
                                  });
                                  </script>
                                  
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="landline">Landline</label>
                                    <input type="text" name="landline" value="<?php echo e($user->landline); ?>" id="landline" placeholder="Enter Landline" >
                                    <?php if($errors->has('landline')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('landline')); ?></span>
                                    <?php endif; ?>  
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">  
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" 
                                       placeholder="example@example.com"
                                       value="<?php echo e($user->email); ?>"
                                       title="Please enter a valid email address">
                                <?php if($errors->has('email')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>  
                            </div>
                        </div>
                    </div>
                </div>  

                <div class="container text-end">
                    <button type="submit" class="btn btn-primary btn-sm p-2">Save</button>
                </div>
            </div>
        </form>

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
        document.addEventListener('DOMContentLoaded', function() {
            const countryDropdown = document.getElementById('country');
            const stateContainer = document.getElementById('stateContainer');
            const cityContainer = document.getElementById('cityContainer');
            const stateDropdown = document.getElementById('state');
            const cityInput = document.getElementById('city');

            function toggleStateCity() {
                if (countryDropdown.value === 'india') {
                    stateContainer.classList.remove('hidden');
                    cityContainer.classList.remove('hidden');
                } else {
                    stateContainer.classList.add('hidden');
                    cityContainer.classList.add('hidden');
                    stateDropdown.value = '';
                    cityInput.value = '';
                }
            }

            toggleStateCity();
            countryDropdown.addEventListener('change', toggleStateCity);
        });
        
        // Toggle sidebar visibility on small screens
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/contact_details/create.blade.php ENDPATH**/ ?>