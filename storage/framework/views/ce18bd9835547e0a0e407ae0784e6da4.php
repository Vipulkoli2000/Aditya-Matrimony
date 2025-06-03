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
      .page-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
      }
      .form-container {
        flex: 1 1 65%; /* Adjust width as needed */
      }
      .sidebar {
        flex: 1 1 30%; /* Adjust width as needed */
        position: sticky;
        top: 0;
        height: 100vh;
        background-color: #f5f5f5;
        padding: 15px;
        border-left: 1px solid #ddd;
      }
      .panel {
        border: 1px solid #ddd;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
      /* Responsive styles for screens 320px and below */
      @media only screen and (max-width: 320px) {
        .panel {
          margin: 10px;
          padding: 15px;
        }
        .form-row {
          flex-direction: column;
        }
        .sidebar {
          width: 100%;
          position: relative;
          height: auto;
          border-left: none;
          margin-top: 20px;
        }
        .row {
          flex-direction: column;
        }
        .col {
          width: 100%;
          margin-bottom: 10px;
        }
      }
    </style>
  
    <div class="page-container">
      <!-- Form Section -->
      <div class="form-container">
        <form action="<?php echo e(route('profiles.educational_details_store')); ?>" enctype="multipart/form-data" method="POST">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="redirect_url" id="redirect_url" value="">

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
          <div class="panel">
            <h2 style="color: #FF3846;">Educational Profile</h2>
            <div class="container mt-3" id="dropdowns">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="highest_education">Highest Education</label>
                    <select name="highest_education" class="form-input" id="highest_education">
                      <option value="" selected>Select an option</option>
                      <?php $__currentLoopData = config('data.highest_education', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(($user->highest_education === $value) ? 'selected' : ''); ?>>
                          <?php echo e($name); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <option value="other" <?php echo e(($user->highest_education === 'other') ? 'selected' : ''); ?>>Other</option>
                    </select>
                    
                    


                    
                    <!-- Other Education Input -->
                    <div id="other-education" class="form-group" style="display: none;">
                      <label for="other_education">Other Education</label>
                      <input type="text" name="other_education" value="<?php echo e(old('other_education', $user->other_education)); ?>" id="other_education" placeholder="Enter education in detail">
                      <?php if($errors->has('other_education')): ?>
                        <span class="text-danger small"><?php echo e($errors->first('other_education')); ?></span>
                      <?php endif; ?>
                    </div>
                    
                    <script>
                      document.addEventListener('DOMContentLoaded', function () {
                        const highestEducationSelect = document.getElementById('highest_education');
                        const otherEducationDiv = document.getElementById('other-education');
                        const otherEducationInput = document.getElementById('other_education');
                
                        function toggleOtherEducationInput() {
                          if (highestEducationSelect.value === 'other') {
                            otherEducationDiv.style.display = 'block';
                          } else {
                            otherEducationDiv.style.display = 'none';
                            otherEducationInput.value = '';
                          }
                        }
                
                        toggleOtherEducationInput();
                        highestEducationSelect.addEventListener('change', function () {
                          toggleOtherEducationInput();
                        });
                      });
                    </script>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="education_in_detail">Education in Detail</label>
                    <input type="text" name="education_in_detail" value="<?php echo e($user->education_in_detail); ?>" id="education_in_detail" placeholder="Enter education in detail">
                    <?php if($errors->has('education_in_detail')): ?>
                      <span class="text-danger small"><?php echo e($errors->first('education_in_detail')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="additional_degree">Additional Degree</label>
                    <input type="text" name="additional_degree" value="<?php echo e($user->additional_degree); ?>" id="additional_degree" placeholder="Enter education in detail">
                    <?php if($errors->has('additional_degree')): ?>
                      <span class="text-danger small"><?php echo e($errors->first('additional_degree')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
  
      <!-- Sidebar Section -->
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
  <?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/educational_details/create.blade.php ENDPATH**/ ?>