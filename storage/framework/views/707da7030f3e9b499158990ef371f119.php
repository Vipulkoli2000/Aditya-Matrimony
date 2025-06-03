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

    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Account Settings</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Settings</h5>
            </div>
            <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Recent Orders</h5>
                </div>
                <form class="space-y-5" action="<?php echo e(route('profile.update', ['user' => $user->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'name','value' => ''.e(old('name', $user->name)).'','placeholder' => 'Enter Full Name','label' => __('User Name'),'require' => true,'messages' => $errors->get('name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','value' => ''.e(old('name', $user->name)).'','placeholder' => 'Enter Full Name','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('User Name')),'require' => true,'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('name'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>                     
                        <?php if (isset($component)) { $__componentOriginale22b24799ec770a20a01d9a9c499fae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale22b24799ec770a20a01d9a9c499fae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.combo-input','data' => ['name' => 'email','type' => 'email','email' => true,'value' => ''.e(old('email', $user->email)).'','label' => __('Email'),'messages' => $errors->get('email')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('combo-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'email','type' => 'email','email' => true,'value' => ''.e(old('email', $user->email)).'','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Email')),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale22b24799ec770a20a01d9a9c499fae0)): ?>
<?php $attributes = $__attributesOriginale22b24799ec770a20a01d9a9c499fae0; ?>
<?php unset($__attributesOriginale22b24799ec770a20a01d9a9c499fae0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale22b24799ec770a20a01d9a9c499fae0)): ?>
<?php $component = $__componentOriginale22b24799ec770a20a01d9a9c499fae0; ?>
<?php unset($__componentOriginale22b24799ec770a20a01d9a9c499fae0); ?>
<?php endif; ?>  
                    </div>
                    <div class="flex justify-end mt-4">
                    <?php if (isset($component)) { $__componentOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('success-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php echo e(__('Submit')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d)): ?>
<?php $attributes = $__attributesOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d; ?>
<?php unset($__attributesOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d)): ?>
<?php $component = $__componentOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d; ?>
<?php unset($__componentOriginal9b9c6dcc4d46c2c3b6a9c6dfef332f1d); ?>
<?php endif; ?>                    
                    &nbsp;&nbsp;
                    
                        <?php if (isset($component)) { $__componentOriginal1bf589f1183d1ef61b17c0b312d34a0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bf589f1183d1ef61b17c0b312d34a0d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cancel-button','data' => ['link' => url('/dashboards')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cancel-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['link' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/dashboards'))]); ?>
                        <?php echo e(__('Cancel')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bf589f1183d1ef61b17c0b312d34a0d)): ?>
<?php $attributes = $__attributesOriginal1bf589f1183d1ef61b17c0b312d34a0d; ?>
<?php unset($__attributesOriginal1bf589f1183d1ef61b17c0b312d34a0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bf589f1183d1ef61b17c0b312d34a0d)): ?>
<?php $component = $__componentOriginal1bf589f1183d1ef61b17c0b312d34a0d; ?>
<?php unset($__componentOriginal1bf589f1183d1ef61b17c0b312d34a0d); ?>
<?php endif; ?>
                </div>
                    
                </form>
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>