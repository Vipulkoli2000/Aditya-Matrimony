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
            <form action="<?php echo e(route('profiles.religious_details_store')); ?>" enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>
                  <!-- Add this hidden field for redirection -->
    <input type="hidden" name="redirect_url" id="redirect_url" value="">
                <div class="l">
                    <div class="profile-completion">
                        <h3>Profile Completion</h3>
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
                    <div class="panel">
                        <h2 style="color: #FF3846;">Religious Details</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <select class="form-input" name="religion" id="religion" disabled>
                                    <option value="hindu" selected>Hindu</option>
                                </select>
                                
                                <!-- Hidden input to ensure 'religion' is sent with the form -->
                                <input type="hidden" name="religion" value="hindu">
                        
                                <?php if($errors->has('religion')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('religion')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-row" id="habitsRow">
                            <div class="form-group">
                                <label for="caste">Caste</label>
                                <select class="form-input" name="caste" id="caste">
                                    <?php $__currentLoopData = $castes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caste): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($caste->id); ?>" <?php echo e($user->caste == $caste->id ? 'selected' : ''); ?>>
                                            <?php echo e($caste->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select> 
                                <?php if($errors->has('caste')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('caste')); ?></span>
                                <?php endif; ?>   
                            </div>
                              
                            <div class="form-group">
                                <label for="gotra">Gotra</label>
                                <input type="text" name="gotra" value="<?php echo e($user->gotra); ?>" id="gotra" placeholder="Enter first name">
                                <?php if($errors->has('gotra')): ?>
                                    <span class="text-danger small"><?php echo e($errors->first('gotra')); ?></span>
                                <?php endif; ?>   
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
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
                const religionSelect = document.getElementById('religion');
                const habitsRow = document.getElementById('habitsRow');
        
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/religious_details/create.blade.php ENDPATH**/ ?>