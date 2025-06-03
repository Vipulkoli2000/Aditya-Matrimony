<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['link', 'text'=>'Cancel']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['link', 'text'=>'Cancel']); ?>
<?php foreach (array_filter((['link', 'text'=>'Cancel']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="lead" style="display:inline-block;">
    <a href="<?php echo e($link); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel?')">
        <?php echo e($text); ?>

    </a>
</div><?php /**PATH D:\dir\Aditya Matrimony\resources\views/components/cancel-button.blade.php ENDPATH**/ ?>