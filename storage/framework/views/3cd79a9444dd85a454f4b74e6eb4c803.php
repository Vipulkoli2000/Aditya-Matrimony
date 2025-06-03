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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Registered Users -->
                <div class="bg-white shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Registered Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Total users</p>
                    <p class="text-2xl font-bold text-blue-500 mt-2"><?php echo e($totalUsers); ?></p>
                </div>
            
                <!-- Active Users -->
                <div class="bg-blue-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Active Groom Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Currently active</p>
                    <p class="text-2xl font-bold text-blue-500 mt-2"><?php echo e($activeMaleUsers); ?></p>
                </div>
                
                <div class="bg-pink-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Active Bride Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Currently active</p>
                    <p class="text-2xl font-bold text-pink-500 mt-2"><?php echo e($activeFemaleUsers); ?></p>
                </div>
                
            
                <!-- Inactive Users -->
                <div class="bg-red-100 shadow-lg rounded-lg p-4 w-32 h-32 flex flex-col justify-center items-center">
                    <h3 class="text-sm font-semibold text-gray-800 text-center">Inactive Users</h3>
                    <p class="text-xs text-gray-600 text-center mt-1">Not active</p>
                    <p class="text-2xl font-bold text-red-500 mt-2"><?php echo e($inactiveUsers); ?></p>
                </div>
            
            
            </div>



            <div class="mt-8 bg-yellow-100 shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-800">⚠️ Packages Expiring This Month</h3>
                <p class="text-lg text-gray-600 mt-2">List of users whose packages will expire this month.</p>
            
                <?php
                    $expiringThisMonth = $expiringPackages->filter(function($package) {
                        return \Carbon\Carbon::parse($package->expires_at)->format('Y-m') === now()->format('Y-m');
                    });
            
                    $displayedPackages = $expiringThisMonth->take(3); // Show only 5 initially
                    $hasMore = $expiringThisMonth->count() > 3; // Check if there are more than 5
                ?>
            
                <?php if($expiringThisMonth->isEmpty()): ?>
                    <p class="text-gray-500 mt-4">No packages expiring this month.</p>
                <?php else: ?>
                    <div class="overflow-x-auto mt-4">
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2 text-left">User Name</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Package Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $displayedPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $user = $package->profile->user ?? null; ?>
                                <tr class="bg-white">
                                    <td class="border border-gray-300 px-4 py-2">
                                        
                                        <?php echo e($user->name); ?>

                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <?php echo e($user->email ?? 'N/A'); ?>

                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <?php echo e(\Carbon\Carbon::parse($package->expires_at)->format('M d, Y')); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            </tbody>
                        </table>
                    </div>
            
                    <?php if($hasMore): ?>
                        <div class="mt-4 text-right">
                            <a href="<?php echo e(route('admin.expiring-packages')); ?>" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Show More →
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            
            

         <!-- Birthday Users -->
<div class="mt-8 bg-white shadow-lg rounded-lg p-6">
    <h3 class="text-2xl font-semibold text-gray-800">🎂 Members with Birthdays This Month</h3>
    <p class="text-lg text-gray-600 mt-2">Celebrate with these members!</p>

    <?php if($birthdayUsers->isEmpty()): ?>
        <p class="text-gray-500 mt-4">No birthdays this month.</p>
    <?php else: ?>
        <div class="overflow-x-auto mt-4">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">Full Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Mobile</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $birthdayUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="bg-white">
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo e($user->first_name); ?> <?php echo e($user->middle_name); ?> <?php echo e($user->last_name); ?>

                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo e($user->mobile ?? 'N/A'); ?>

                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo e($user->email ?? 'N/A'); ?>

                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo e(\Carbon\Carbon::parse($user->date_of_birth)->format('M d')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <?php if(@$hasMoreBirthdays): ?>
            <div class="mt-4 text-right">
                <a href="<?php echo e(route('admin.birthdays')); ?>" 
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Show More →
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>


            
          
            
            

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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>