<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset='utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link rel="icon" type="image/svg" href="/assets/images/encore-logo-icon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    
    <link rel="stylesheet" href="<?php echo e(Vite::asset('resources/css/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(Vite::asset('resources/css/highlight.min.css')); ?>">
    <link rel='stylesheet' type='text/css' href="<?php echo e(Vite::asset('resources/css/nice-select2.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(Vite::asset('resources/css/quill.snow.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(Vite::asset('resources/css/swiper-bundle.min.css')); ?>">


    <script src="/assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="/assets/js/popper.min.js"></script>
    <script defer src="/assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/js/quill.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>

<body x-data="main" class="antialiased relative font-nunito text-sm font-normal overflow-x-hidden"
    :class="[$store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout, $store.app
        .rtlClass
    ]">

    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 bg-[black]/60 z-50 lg:hidden" :class="{ 'hidden': !$store.app.sidebar }"
        @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div
        class="screen_loader fixed inset-0 bg-[#fafafa] dark:bg-[#060818] z-[60] grid place-content-center animate__animated">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path
                d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s"
                    repeatCount="indefinite" />
            </path>
            <path
                d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s"
                    repeatCount="indefinite" />
            </path>
        </svg>
    </div>

    <div class="fixed bottom-6 ltr:right-6 rtl:left-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button"
                class="btn btn-outline-primary rounded-full p-2 animate-pulse bg-[#fafafa] dark:bg-[#060818] dark:hover:bg-primary"
                @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                        fill="currentColor" />
                    <path
                        d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                        fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("scrollToTop", () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction();
                    };
                },

                scrollFunction() {
                    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                        this.showTopButton = true;
                    } else {
                        this.showTopButton = false;
                    }
                },

                goToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                },
            }));
        });
    </script>

    <!-- <?php if (isset($component)) { $__componentOriginal4532e835e6ce50c8f5b5a9c3752b0135 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4532e835e6ce50c8f5b5a9c3752b0135 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.theme-customiser','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.theme-customiser'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4532e835e6ce50c8f5b5a9c3752b0135)): ?>
<?php $attributes = $__attributesOriginal4532e835e6ce50c8f5b5a9c3752b0135; ?>
<?php unset($__attributesOriginal4532e835e6ce50c8f5b5a9c3752b0135); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4532e835e6ce50c8f5b5a9c3752b0135)): ?>
<?php $component = $__componentOriginal4532e835e6ce50c8f5b5a9c3752b0135; ?>
<?php unset($__componentOriginal4532e835e6ce50c8f5b5a9c3752b0135); ?>
<?php endif; ?> -->

    <div class="main-container text-black dark:text-white-dark min-h-screen" :class="[$store.app.navbar]">

        <?php if (isset($component)) { $__componentOriginalb452accb78b4116e5d057094b9f3361b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb452accb78b4116e5d057094b9f3361b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb452accb78b4116e5d057094b9f3361b)): ?>
<?php $attributes = $__attributesOriginalb452accb78b4116e5d057094b9f3361b; ?>
<?php unset($__attributesOriginalb452accb78b4116e5d057094b9f3361b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb452accb78b4116e5d057094b9f3361b)): ?>
<?php $component = $__componentOriginalb452accb78b4116e5d057094b9f3361b; ?>
<?php unset($__componentOriginalb452accb78b4116e5d057094b9f3361b); ?>
<?php endif; ?>

        <div class="main-content">
            <?php if (isset($component)) { $__componentOriginald28a8bb735c743494aab3aa3bad09829 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald28a8bb735c743494aab3aa3bad09829 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald28a8bb735c743494aab3aa3bad09829)): ?>
<?php $attributes = $__attributesOriginald28a8bb735c743494aab3aa3bad09829; ?>
<?php unset($__attributesOriginald28a8bb735c743494aab3aa3bad09829); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald28a8bb735c743494aab3aa3bad09829)): ?>
<?php $component = $__componentOriginald28a8bb735c743494aab3aa3bad09829; ?>
<?php unset($__componentOriginald28a8bb735c743494aab3aa3bad09829); ?>
<?php endif; ?>
            <?php if(Session::has('success')): ?>
                <?php if (isset($component)) { $__componentOriginale9c2432d19d364df9d8417369e9d156e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9c2432d19d364df9d8417369e9d156e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.alert','data' => ['success' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['success' => true]); ?> <?php echo e(session('success')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9c2432d19d364df9d8417369e9d156e)): ?>
<?php $attributes = $__attributesOriginale9c2432d19d364df9d8417369e9d156e; ?>
<?php unset($__attributesOriginale9c2432d19d364df9d8417369e9d156e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9c2432d19d364df9d8417369e9d156e)): ?>
<?php $component = $__componentOriginale9c2432d19d364df9d8417369e9d156e; ?>
<?php unset($__componentOriginale9c2432d19d364df9d8417369e9d156e); ?>
<?php endif; ?> 
            <?php elseif(Session::has('error')): ?>
                <?php if (isset($component)) { $__componentOriginale9c2432d19d364df9d8417369e9d156e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9c2432d19d364df9d8417369e9d156e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo e(session('error')); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9c2432d19d364df9d8417369e9d156e)): ?>
<?php $attributes = $__attributesOriginale9c2432d19d364df9d8417369e9d156e; ?>
<?php unset($__attributesOriginale9c2432d19d364df9d8417369e9d156e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9c2432d19d364df9d8417369e9d156e)): ?>
<?php $component = $__componentOriginale9c2432d19d364df9d8417369e9d156e; ?>
<?php unset($__componentOriginale9c2432d19d364df9d8417369e9d156e); ?>
<?php endif; ?> 
            <?php endif; ?>

            <div class="p-6 animate__animated" :class="[$store.app.animation]">
                <?php echo e($slot); ?>


                <?php if (isset($component)) { $__componentOriginalc7767d3a8a9b46033c64e207f06d76b6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7767d3a8a9b46033c64e207f06d76b6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.common.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('common.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7767d3a8a9b46033c64e207f06d76b6)): ?>
<?php $attributes = $__attributesOriginalc7767d3a8a9b46033c64e207f06d76b6; ?>
<?php unset($__attributesOriginalc7767d3a8a9b46033c64e207f06d76b6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7767d3a8a9b46033c64e207f06d76b6)): ?>
<?php $component = $__componentOriginalc7767d3a8a9b46033c64e207f06d76b6; ?>
<?php unset($__componentOriginalc7767d3a8a9b46033c64e207f06d76b6); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
    <script src="/assets/js/alpine-collaspe.min.js"></script>
    <script src="/assets/js/alpine-persist.min.js"></script>
    <script defer src="/assets/js/alpine-ui.min.js"></script>
    <script defer src="/assets/js/alpine-focus.min.js"></script>
    <script defer src="/assets/js/alpine.min.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/flatpickr.js"></script>
    <script src="/assets/js/nice-select2.js"></script>
    <script src="/assets/js/highlight.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/simple-datatables.js"></script>

</body>

</html>
<?php /**PATH D:\dir\matrimony\resources\views/components/layout/admin.blade.php ENDPATH**/ ?>