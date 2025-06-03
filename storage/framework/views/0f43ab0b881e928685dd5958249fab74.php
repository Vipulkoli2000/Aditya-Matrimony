<?php if (isset($component)) { $__componentOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout.user','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout.user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        .card {
            transition: transform 0.2s, box-shadow 0.2s; /* Smooth transition */
            margin-right: 15px; /* Add margin between cards */
        }
    
        .card:hover {
            transform: translateY(-5px); /* Lift effect */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
    
        .profile-image {
            width: 80%; /* Set a smaller width */
            height: auto; /* Maintain aspect ratio */
            margin: 10px auto; /* Center the image */
            display: block; /* Make it a block element for centering */
            border-radius: 8px; /* Optional: add rounded corners */
        }
    
        .no-profile-photo {
            width: 80%; /* Match the width of the profile image */
            height: 387px; /* Set a fixed height for the placeholder */
            background-color: #f0f0f0; /* Light gray background */
            display: flex;
            align-items: center; /* Vertically center the content */
            justify-content: center; /* Horizontally center the content */
            color: #888; /* Gray color for text */
            font-weight: bold;
            margin: 10px auto; /* Center the placeholder */
            border-radius: 8px; /* Optional: add rounded corners */
            text-align: center; /* Ensure text is centered inside the div */
            line-height: 1.5; /* Control the line height for better text visibility */
        }
    
        .view-profile {
            color: #007bff; /* Bootstrap primary color */
            text-decoration: underline; /* Underline the text */
            cursor: pointer; /* Change cursor to pointer */
        }
    
        /* Wrapper for both profiles and the scroll buttons */
        .profile-wrapper {
            position: relative;
            width: 100%;
        }
    
        /* Scrollable container for profiles */
        .profile-scroll-container {
            display: flex;
            overflow-x: auto; /* Enable horizontal scrolling */
            padding: 10px 0; /* Add padding for better spacing */
            position: relative; /* Make the container relative to position arrows */
            -ms-overflow-style: none; /* Disable scrollbar for IE */
            scrollbar-width: none; /* Hide scrollbar for Firefox */
        }
    
        /* Hide scrollbar for Webkit browsers (Chrome, Safari) */
        .profile-scroll-container::-webkit-scrollbar {
            display: none;
        }
    
        /* Styling for the left and right arrows */
        .scroll-arrow {
            position: absolute;  /* Absolute positioning within the wrapper */
            top: 50%;            /* Center vertically */
            transform: translateY(-50%); /* Adjust for perfect centering */
            background-color: transparent;  /* Transparent background */
            color: black;        /* Arrow color */
            border: none;
            font-size: 24px;      /* Increase font size for visibility */
            cursor: pointer;
            padding: 5px;
            z-index: 10;          /* Ensure it's above other elements */
        }
    
        .scroll-left {
            left: 10px;  /* Position left arrow to the left of the container */
        }
    
        .scroll-right {
            right: 10px; /* Position right arrow to the right of the container */
        }
    
        /* Responsive Styles for Mobile View */
        @media (max-width: 768px) {
            /* Make profile images and placeholders full width */
            .profile-image,
            .no-profile-photo {
                width: 100%;
            }
            /* Slightly reduce card margin */
            .card {
                margin-right: 10px;
            }
            /* Override inline styles for the About Us image */
            #weddingAbout img {
                width: 100% !important;
                height: auto !important;
            }
            /* Adjust heading size for better mobile display */
            .display-1 {
                font-size: 2.5rem;
            }
            /* Slightly adjust scroll arrow size */
            .scroll-arrow {
                font-size: 20px;
                padding: 5px;
            }
        }
    </style>
    
    

     
        
        <div class="container-fluid position-relative " id="weddingAbout">


       



                
            <div class="container position-relative py-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row g-4 align-items-center">
                       
                            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="mx-auto  mb-3 wow fadeInUp" data-wow-delay="0.1s" >
                                    <h2 class="display-1 text-primary mb-0">About Us</h2>
                                </div>
                                <div class="d-flex">
                                    <div class="my-auto">
                                       <p class="text-justify">Welcome to Aditya Matrimony !!!

                                        Aditya Matrimony is a community-driven organization dedicated to facilitating successful matrimonial alliances within the community. Established with the vision to preserve cultural heritage and strengthen bonds, we aim to provide a reliable and respectful platform for individuals and families looking for compatible life partners.
                                       </p>
                                      
                                        </div>
                                </div>
                                <a class="btn btn-primary btn-primary-outline-0 py-3 px-5 mt-4" href="/about">Know More</a>
                            </div>
                            <div class="col-lg-5 wow fadeInUp order-first order-md-last" data-wow-delay="0.3s">
                                <img src="<?php echo e(asset('assets/images/aboutbanner.jpg')); ?>" 
                                alt="Aditya Matrimony, Dombivili" 
                                style="width: 400px; height: 400px; object-fit: cover;">
                                                        </div>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
         
        
        <?php if(session('error')): ?>
        <div class="alert mt-2 alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>
        <div>
        <h2 class="text-center">Bride Profiles</h2>
        <div class="profile-wrapper">
            <!-- Left Arrow -->
            <button class="scroll-arrow scroll-left" onclick="scrollContainer('bride-profiles', -1)">❮</button>
            <div class="profile-scroll-container" id="bride-profiles">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->role == 'bride'): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <?php if($user->img_1): ?>
                                    <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_1); ?>')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Uploaded Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            
                                        </template>
                                    </div>
                                <?php else: ?>
                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                <?php endif; ?>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo e($user->first_name); ?> </h5>
                                    <p class="card-text"><?php echo e(\Carbon\Carbon::parse($user->date_of_birth)->age); ?> years</p>
                                     <p class="card-text"><?php echo e($user->bio); ?></p>
                                    <span class="view-profile" onclick="location.href='<?php echo e(route('user.show_profile', $user->id)); ?>'">View Profile</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- Right Arrow -->
            <button class="scroll-arrow scroll-right" onclick="scrollContainer('bride-profiles', 1)">❯</button>
        </div>

        <h2 class="text-center">Groom Profiles</h2>
        <div class="profile-wrapper">
            <!-- Left Arrow -->
            <button class="scroll-arrow scroll-left" onclick="scrollContainer('groom-profiles', -1)">❮</button>
            <div class="profile-scroll-container" id="groom-profiles">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->role == 'groom'): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <?php if($user->img_1): ?>
                                    <div x-data="imageLoader()" x-init="fetchImage('<?php echo e($user->img_1); ?>')">
                                        <template x-if="imageUrl">
                                            <img class="profile-image" :src="imageUrl" alt="Uploaded Image" />
                                        </template>
                                        <template x-if="!imageUrl">
                                            
                                        </template>
                                    </div>
                                <?php else: ?>
                                    <div class="no-profile-photo">No Profile Photo Displayed</div>
                                <?php endif; ?>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo e($user->first_name); ?> </h5>
                                    <p class="card-text"><?php echo e(\Carbon\Carbon::parse($user->date_of_birth)->age); ?> years</p>
                                     <p class="card-text"><?php echo e($user->bio); ?></p>
                                    <span class="view-profile" onclick="location.href='<?php echo e(route('user.show_profile', $user->id)); ?>'">View Profile</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- Right Arrow -->
            <button class="scroll-arrow scroll-right" onclick="scrollContainer('groom-profiles', 1)">❯</button>
        </div>
    </div>
    </div>

    <script>
        // Function to handle the scrolling behavior
        function scrollContainer(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = 300; // Amount to scroll (adjust as needed)

            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        // Image Loader (Your original code)
        function imageLoader() {
            return {
                imageUrl: null,

                async fetchImage(filename) {
                    try {
                        const response = await fetch(`/api/images/${filename}`);
                        if (!response.ok) throw new Error('Image not found');
                        
                        // Create a blob URL for the image
                        const blob = await response.blob();
                        this.imageUrl = URL.createObjectURL(blob);
                    } catch (error) {
                        console.error('Error fetching image:', error);
                        this.imageUrl = null; // Handle error case
                    }
                }
            };
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5)): ?>
<?php $attributes = $__attributesOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5; ?>
<?php unset($__attributesOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5)): ?>
<?php $component = $__componentOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5; ?>
<?php unset($__componentOriginald0e6a5f122f7d1f17c3b7c09c6c38ef5); ?>
<?php endif; ?>
<?php /**PATH D:\dir\matrimony\resources\views/dashboard.blade.php ENDPATH**/ ?>