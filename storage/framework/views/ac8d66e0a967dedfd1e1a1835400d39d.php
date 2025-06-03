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
                    <h3 class="text-center" style="color: #FF3846; margin: 20px;">Occupation Details</h3>
                    <div class="panel">
                        <h4>Organisation Information</h4>
                        <div class="container mt-3" id="dropdowns">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="occupation">Occupation</label>
                                        <select name="occupation" id="occupation">
                                            <option value="" selected>Select an option</option>
                                            <?php $__currentLoopData = config('data.occupation', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php echo e(($user->occupation === $value) ? 'selected' : ''); ?> ><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('occupation')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('occupation')); ?></span>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="organization">Organisation</label>
                                        <input type="text" name="organization" value="<?php echo e($user->organization); ?>" id="organization" class="form-control" placeholder="Enter Organization">
                                        <?php if($errors->has('organization')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('organization')); ?></span>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" value="<?php echo e($user->designation); ?>" id="designation" class="form-control" placeholder="Enter designation">
                                        <?php if($errors->has('designation')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('designation')); ?></span>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="job_location">Job Location</label>
                                        <input type="text" name="job_location" value="<?php echo e($user->job_location); ?>" id="job_location" class="form-control" placeholder="Enter job location">
                                        <?php if($errors->has('job_location')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('job_location')); ?></span>
                                        <?php endif; ?>  
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
                                        <input type="text" name="income" value="<?php echo e($user->income); ?>" id="income" class="form-control" placeholder="Enter income">
                                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('income'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('income')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="job_experience">Job Experience (months)</label>
                                        <input type="text" name="job_experience" value="<?php echo e($user->job_experience); ?>" id="job_experience" class="form-control" placeholder="Enter Job Experience">
                                        <?php if($errors->has('job_experience')): ?>
                                        <span class="text-danger small"><?php echo e($errors->first('job_experience')); ?></span>
                                        <?php endif; ?>  
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/occupation_details/create.blade.php ENDPATH**/ ?>