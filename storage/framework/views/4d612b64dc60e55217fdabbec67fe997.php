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
    
    <div class="flex justify-between">
        <?php if (\Illuminate\Support\Facades\Blade::check('role', ['admin'])): ?>
            
            <?php if (isset($component)) { $__componentOriginal29a20f76887a06c2f0b01b975de4ca48 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal29a20f76887a06c2f0b01b975de4ca48 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.excel-button','data' => ['link' => route('user_profiles.import')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('excel-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('user_profiles.import'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal29a20f76887a06c2f0b01b975de4ca48)): ?>
<?php $attributes = $__attributesOriginal29a20f76887a06c2f0b01b975de4ca48; ?>
<?php unset($__attributesOriginal29a20f76887a06c2f0b01b975de4ca48); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal29a20f76887a06c2f0b01b975de4ca48)): ?>
<?php $component = $__componentOriginal29a20f76887a06c2f0b01b975de4ca48; ?>
<?php unset($__componentOriginal29a20f76887a06c2f0b01b975de4ca48); ?>
<?php endif; ?>
            <div class="w-[120px]">
                <a href="<?php echo e(route('user_profiles.create')); ?>" class="btn btn-success px-4 py-2">
                    Add Profile 
                </a>
            </div>
        <?php endif; ?>   
    </div> 
    <br><br>
    <div x-data="form"> 
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Profiles</h5>
                <div class="flex items-center">
                    <form action="<?php echo e(route('user_profiles.index')); ?>" method="GET" class="flex items-center">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search profiles" 
                            class="mr-2 px-2 py-1 border border-gray-300 rounded-md">
                        <button class="btn btn-primary px-4 py-2 mr-2" type="submit">Search</button>
                        
                        

                        <!-- Status Filter & Reset Button -->
                        <div class="flex items-center gap-2">
                            <select name="status" style="border: 1px solid #ccc; border-radius: 4px; padding: 8px; width: 100px;" onchange="resetFilter(this)">
                                <option value="">All</option>
                                <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Active</option>
                                <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Inactive</option>
                            </select>
                        
                            <?php if(request()->has('search') || request()->has('status')): ?>
                                <a href="<?php echo e(route('user_profiles.index')); ?>" class="btn btn-secondary">Reset</a>
                            <?php endif; ?>
                        </div>
                        
                        <script>
                            function resetFilter(select) {
                                if (select.value === "") {
                                    window.location.href = "<?php echo e(route('user_profiles.index')); ?>"; // Redirect to remove filters
                                } else {
                                    select.form.submit(); // Submit the form for other values
                                }
                            }
                        </script>
                        
                    </form>
                </div>
            </div>
            <div class="mt-6">
                <div class="table-responsive">
                    <table class="table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>PDFs</th>
                                <th>Invoice</th>
                                <th>Registered Date</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr title="<?php echo e($profile->created_at); ?>">
                                
                                <td><?php echo e($profile->first_name . " " . $profile->middle_name . " " . $profile->last_name); ?></td>
                                <td><?php echo e($profile->mobile); ?></td>
                                <td><?php echo e($profile->gender); ?></td>
                                <td><?php echo e($profile->email); ?></td>
                                <td>
                                    <?php if(optional($profile->user)->active): ?>
                                        <span class="text-green-600 font-bold text-xs">Active</span>
                                    <?php else: ?>
                                        <span class="text-red-600 font-bold text-xs">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('user_profiles.download', $profile->id)); ?>"
                                       class="btn btn-secondary btn-sm inline-flex items-center mr-2">
                                        <img src="<?php echo e(asset('assets/images/pdf.svg')); ?>" alt="Profile PDF"
                                             style="width:20px; height:20px; margin-right:5px;">
                                         
                                    </a>
                                  
                                </td>
                                <td>
                                <a href="<?php echo e(route('user_profiles.download_invoice', $profile->id)); ?>"
                                       class="btn btn-info btn-sm inline-flex items-center">
                                        <img src="<?php echo e(asset('assets/images/pdf.svg')); ?>" alt="Invoice PDF"
                                             style="width:20px; height:20px; margin-right:5px;">
                                       
                                    </a>
                                </td>
                                <td><?php echo e($profile->created_at->format('d-m-Y')); ?></td>
                                <td class="float-right">
                                    <ul class="flex items-center gap-2">
                                        <li style="display: inline-block; vertical-align: top;">
                                            <?php if (isset($component)) { $__componentOriginal8417baeedcb6c131165d53e37e61cc07 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8417baeedcb6c131165d53e37e61cc07 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.edit-button','data' => ['link' =>  route('user_profiles.edit', $profile->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('edit-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute( route('user_profiles.edit', $profile->id))]); ?>
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
                                        <li style="display: inline-block; vertical-align: top;">
                                            <?php if (isset($component)) { $__componentOriginalec2502b834f860c8e30d229aa8f280e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec2502b834f860c8e30d229aa8f280e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.delete-button','data' => ['link' =>  route('user_profiles.destroy', $profile->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('delete-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute( route('user_profiles.destroy', $profile->id))]); ?>
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
                    <?php echo e($profiles->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                // highlightjs
                codeArr: [],
                toggleCode(name) {
                    if (this.codeArr.includes(name)) {
                        this.codeArr = this.codeArr.filter((d) => d != name);
                    } else {
                        this.codeArr.push(name);
                        setTimeout(() => {
                            document.querySelectorAll('pre.code').forEach(el => {
                                hljs.highlightElement(el);
                            });
                        });
                    }
                }
            }));
        });
    </script>
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/admin/user_profiles/index.blade.php ENDPATH**/ ?>