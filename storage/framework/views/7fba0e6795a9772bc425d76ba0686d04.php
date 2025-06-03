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
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Personal Information Panel</title>
        <style>
            /* Card styling for 3D effect */
            .card {
                border: 1px solid #ddd;
                border-radius: 8px;
                transition: transform 0.2s, box-shadow 0.2s;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            }
            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            }
            .card-body {
                text-align: center; /* Center align text inside the card */
            }
            .view-profile {
                color: blue;
                font-weight: bold;
                cursor: pointer;
                display: inline-block;
            }
            /* Sidebar styles */
            .sidebar {
                width: 300px;
                position: sticky;
                top: 0;
                height: 100vh;
                background-color: #f5f5f5;
                padding: 15px;
                border-left: 1px solid #ddd;
            }
            /* Image styles */
            .profile-image {
                width: 80%;
                height: auto;
                margin: 10px auto;
                display: block;
                border-radius: 8px;
            }
            .no-profile-photo {
                width: 80%;
                height: 150px;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #888;
                font-weight: bold;
                margin: 10px auto;
                border-radius: 8px;
            }
            button.btn {
                background-color: #ff0000; /* Rose Red color */
                color: white !important;
                border: none;
            }
            /* Flex container wrapping main content and sidebar */
            .content-wrapper {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
            }
            /* Center the main content column with a max width */
            .main-content {
                flex: 1;
                max-width: 900px; /* Adjust width as needed */
                margin: 0 auto;
            }
            
            /* Mobile responsive styles */
            @media (max-width: 768px) {
                .content-wrapper {
                    flex-direction: column;
                }
                .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
                    border-left: none;
                    border-top: 1px solid #ddd;
                }
                .main-content {
                    width: 100%;
                    max-width: 100%;
                    margin: 0 auto;
                    padding: 0 15px;
                }
                .row.justify-content-center {
                    margin: 0 auto;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                .col-auto {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                }
                .card {
                    width: 100% !important;
                    max-width: 300px;
                    margin: 10px auto;
                }
            }
        </style>
    </head>
    <body>
        <div class="content-wrapper">
            <div class="main-content">
                <div class="container-fluid">
                    <?php if(session('error')): ?>
                        <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                    <h2 class="text-center">Favorites</h2>
                    <div class="panel">
                        <!-- Use "justify-content-center" and "col-auto" to center the cards -->
                        <div class="row g-3 justify-content-center">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-auto">
                                    <div class="card my-2" style="width: 18rem;">
                                        <?php if($user->img_1): ?>
                                            <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_1); ?>')">
                                                <template x-if="imageUrl">
                                                    <!-- Wrap the image in an anchor tag to open it in a new tab -->
                                                    <a :href="imageUrl" target="_blank">
                                                        <img class="profile-image" style="max-width: 100px;" :src="imageUrl" alt="Uploaded Image" />
                                                    </a>
                                                </template>
                                                <template x-if="!imageUrl">
                                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                                </template>
                                            </div>
                                        <?php else: ?>
                                            <div class="no-profile-photo">No Profile Photo Displayed</div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h5>
                                            <p class="card-text"><?php echo e(\Carbon\Carbon::parse($user->date_of_birth)->age); ?> years</p>
                                            <p class="card-text"><?php echo e($user->bio); ?></p>
                                            <a href="<?php echo e(route('user.show_profile', $user->id)); ?>" class="view-profile">View Profile</a>
                                            <form action="<?php echo e(route('profiles.remove_favorite')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="favorite_id" value="<?php echo e($user->id); ?>">
                                                <input type="hidden" name="fav_page" value="fav_page">
                                                <button class="btn text-white btn-primary" type="submit">Remove from Favorites</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
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
        </div>
    </body>
    </html>

    <!-- Image display script -->
    <script>
        function imageLoader() {
            return {
                imageUrl: null,
                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null;
                    }
                }
            };
        }
    </script>

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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/profile/view_favorites/index.blade.php ENDPATH**/ ?>