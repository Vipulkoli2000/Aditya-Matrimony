<?php if (isset($component)) { $__componentOriginala21681bc28dd0b4a9c0f209e23f7ac5f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala21681bc28dd0b4a9c0f209e23f7ac5f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.admin','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="panel">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6">Add Profile</h1>
        
        <!-- Display validation errors, if any -->
        <?php if($errors->any()): ?>
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('user_profiles.store')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">     

            
            <div>
                <label for="first_name" class="block text-sm font-medium">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name')); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter First Name..." required>
            </div>
            
            <div>
                <label for="middle_name" class="block text-sm font-medium">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" value="<?php echo e(old('middle_name')); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Middle Name...">
            </div>
            
            <div>
                <label for="last_name" class="block text-sm font-medium">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name')); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Last Name...">
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium">Role</label>
                <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="">Select Role</option>
                    <option value="bride" <?php echo e(old('role') == 'bride' ? 'selected' : ''); ?>>Bride</option>
                    <option value="groom" <?php echo e(old('role') == 'groom' ? 'selected' : ''); ?>>Groom</option>
                </select>
            </div>
            
            <div>
                <label for="mobile" class="block text-sm font-medium">Mobile</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo e(old('mobile')); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="e.g., 9876543210" required>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                       class="mt-1 block w-full border-gray-300 rounded-md" placeholder="Enter Email..." required>
            </div>
        </div>
            
            <!-- Password is fixed to "maratha@123" so no input field is needed -->

            <div>
                <label for="package_id" class="block text-sm font-medium">Select Package</label>
                <select name="package_id" id="package_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="">Select Package</option>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($package->id); ?>" <?php echo e(old('package_id') == $package->id ? 'selected' : ''); ?>>
                            <?php echo e($package->name); ?> (Tokens: <?php echo e($package->tokens); ?>, Validity: <?php echo e($package->validity); ?> days)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
          
            
            <div>
                <button type="submit" class="btn btn-primary px-4 py-2">
                    Add Profile
                </button>
            </div>
        </form>
    </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala21681bc28dd0b4a9c0f209e23f7ac5f)): ?>
<?php $attributes = $__attributesOriginala21681bc28dd0b4a9c0f209e23f7ac5f; ?>
<?php unset($__attributesOriginala21681bc28dd0b4a9c0f209e23f7ac5f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala21681bc28dd0b4a9c0f209e23f7ac5f)): ?>
<?php $component = $__componentOriginala21681bc28dd0b4a9c0f209e23f7ac5f; ?>
<?php unset($__componentOriginala21681bc28dd0b4a9c0f209e23f7ac5f); ?>
<?php endif; ?>
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/admin/user_profiles/create.blade.php ENDPATH**/ ?>