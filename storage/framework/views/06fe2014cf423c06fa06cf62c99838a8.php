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
        <div class="mb-5 flex flex-wrap justify-between">
            <div class="mb-4 w-full lg:w-1/2">
                <h3 class="text-xl font-bold">User Registrations Report</h3>
                <p class="text-gray-600">View and export user registration data</p>
            </div>
            <div class="flex w-full flex-wrap items-center justify-end gap-3 lg:w-1/2">
                <div class="flex space-x-2">
                    <a href="<?php echo e(route('admin.reports.registrations.export.pdf', request()->query())); ?>" class="btn btn-danger">
                        PDF
                    </a>
                    <a href="<?php echo e(route('admin.reports.registrations.export.excel', request()->query())); ?>" class="btn btn-success">
                        Excel
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Date Range Filter -->
        <div class="panel mb-5">
            <form action="<?php echo e(route('admin.reports.registrations')); ?>" method="GET" class="flex flex-wrap items-end gap-4">
                <div class="form-group">
                    <label for="from_date" class="mb-2 block text-sm font-medium">From Date</label>
                    <input type="date" id="from_date" name="from_date" class="form-input" value="<?php echo e(request('from_date')); ?>">
                </div>
                <div class="form-group">
                    <label for="to_date" class="mb-2 block text-sm font-medium">To Date</label>
                    <input type="date" id="to_date" name="to_date" class="form-input" value="<?php echo e(request('to_date')); ?>">
                </div>
                <div class="form-group flex space-x-2 mt-6">
                    <button type="submit" class="btn btn-primary px-3" style="height:43px">Filter</button>
                    <a href="<?php echo e(route('admin.reports.registrations')); ?>" class="btn btn-outline-danger px-3" style="height:43px">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table-striped table-hover table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        
                        <!-- <th>Package</th> -->
                        <!-- <th>Tokens</th> -->
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $registrations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e(ucfirst($user->name)); ?></td>
                            <td><?php echo e(ucfirst($user->email)); ?></td>
                            <td><?php echo e($user->profile->mobile ?? 'N/A'); ?></td>
                            <td><?php echo e(ucfirst($user->profile->gender ?? 'N/A')); ?></td>
                             
                            <!-- <td>
                                <?php
                                    $currentPackage = 'None';
                                    if ($user->profile && $user->profile->profilePackages && $user->profile->profilePackages->count() > 0) {
                                        $latestPackage = $user->profile->profilePackages->sortByDesc(function($package) {
                                            return $package->pivot->expires_at;
                                        })->first();
                                        
                                        if ($latestPackage) {
                                            $currentPackage = $latestPackage->name;
                                        }
                                    }
                                    echo $currentPackage;
                                ?>
                            </td> -->
                            <!-- <td><?php echo e($user->profile->available_tokens ?? 0); ?></td> -->
                            <td><?php echo e($user->created_at->format('d-m-Y')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="10" class="text-center">No registrations found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <?php echo e($registrations->links()); ?>

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
<?php /**PATH D:\dir\matrimony\resources\views/admin/reports/registrations.blade.php ENDPATH**/ ?>