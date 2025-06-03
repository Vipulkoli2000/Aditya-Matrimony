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
    <div class="w-[15%] mt-2">
        <a class="btn btn-primary" href="<?php echo e(route('refresh_status.refresh')); ?>">Refresh Status</a>
    </div>
    <br><br>
    <div x-data="form">
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Users</h5>
                <!-- Search & Filter Form -->
                <form method="GET" action="<?php echo e(route('users.index')); ?>" class="flex flex-col gap-2">
                    <!-- Search Input and Button -->
                    <div class="flex items-center gap-2">
                        <input type="text" name="search" placeholder="Search users..." value="<?php echo e(request('search')); ?>"
                            class="border rounded p-2 w-60" />
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                
                    <!-- Status Filter & Reset Button -->
                    <div class="flex items-center gap-2">
                        <select name="status" class="border rounded p-2 w-60" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Active</option>
                            <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Inactive</option>
                        </select>
                
                        <?php if(request()->has('search') || request()->has('status')): ?>
                            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Reset</a>
                        <?php endif; ?>
                    </div>
                </form>
                
                
            </div>

            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                 <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->mobile); ?></td>
                                <td>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                   
                                    <span class="badge whitespace-nowrap badge bg-info"><?php echo e($role->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                 <td>
                                    <?php if($user->active == '1'): ?>
                                    <span class="badge badge-outline-success">Active</span>
                                    <?php else: ?>
                                    <span class="badge badge-outline-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li>
                                            <?php if (isset($component)) { $__componentOriginal8417baeedcb6c131165d53e37e61cc07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8417baeedcb6c131165d53e37e61cc07 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.edit-button','data' => ['link' =>  route('users.edit', $user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('edit-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute( route('users.edit', $user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8417baeedcb6c131165d53e37e61cc07)): ?>
<?php $attributes = $__attributesOriginal8417baeedcb6c131165d53e37e61cc07; ?>
<?php unset($__attributesOriginal8417baeedcb6c131165d53e37e61cc07); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8417baeedcb6c131165d53e37e61cc07)): ?>
<?php $component = $__componentOriginal8417baeedcb6c131165d53e37e61cc07; ?>
<?php unset($__componentOriginal8417baeedcb6c131165d53e37e61cc07); ?>
<?php endif; ?>
                                        </li>
                                        <li>
                                            <?php if (isset($component)) { $__componentOriginalec2502b834f860c8e30d229aa8f280e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec2502b834f860c8e30d229aa8f280e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-button','data' => ['link' =>  route('users.destroy', $user->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute( route('users.destroy', $user->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec2502b834f860c8e30d229aa8f280e2)): ?>
<?php $attributes = $__attributesOriginalec2502b834f860c8e30d229aa8f280e2; ?>
<?php unset($__attributesOriginalec2502b834f860c8e30d229aa8f280e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec2502b834f860c8e30d229aa8f280e2)): ?>
<?php $component = $__componentOriginalec2502b834f860c8e30d229aa8f280e2; ?>
<?php unset($__componentOriginalec2502b834f860c8e30d229aa8f280e2); ?>
<?php endif; ?>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($users->appends(['search' => request('search'), 'status' => request('status')])->links()); ?>

                </div>
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/admin/users/index.blade.php ENDPATH**/ ?>