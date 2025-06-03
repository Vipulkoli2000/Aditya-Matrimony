<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['disabled' => false, 'email' => false,  'label', 'require' => false, 'messages']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['disabled' => false, 'email' => false,  'label', 'require' => false, 'messages']); ?>
<?php foreach (array_filter((['disabled' => false, 'email' => false,  'label', 'require' => false, 'messages']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>
    <label>
        <?php echo e($label); ?>: 
        <?php if($require): ?>
        <span style="color: red">*</span>
        <?php endif; ?>
    </label>

    <div class="flex">
        <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]"><?php echo $email ? '@' : '&#8377;'; ?></div>
        <input <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo $attributes->merge(['class' => 'form-input ltr:rounded-l-none rtl:rounded-r-none']); ?> />
    </div>

    <?php if($messages): ?>
        <ul <?php echo e($attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2'])); ?>>
            <?php $__currentLoopData = (array) $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($message); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>

<?php /**PATH D:\dir\Aditya Matrimony\resources\views/components/combo-input.blade.php ENDPATH**/ ?>