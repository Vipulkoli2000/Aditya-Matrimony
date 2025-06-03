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
    
    <div>
    <div class="" id="weddingAbout">
        <div class="position-absolute" style="top: px; right: 0;">
            <img src="<?php echo e(asset('assets/images/tamp-bg-1.png')); ?>" alt="Aditya Matrimony, Dombivili" class="hands">
        </div>
        <div class="position-absolute" style="top: px; left: 0; transform: rotate(150deg);">
            <img src="<?php echo e(asset('assets/images/tamp-bg-1.png')); ?>" alt="Aditya Matrimony, Dombivili" class="hands">
        </div>
        <div class="container position-relative py-5">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="mx-auto  mb-3 wow fadeInUp" data-wow-delay="0.1s" >
                                <h2 class="display-1 text-primary" style="margin-left: 40px; margin-top: 40px;">Contact Us</h2>
                            </div>
                            <div class="d-flex">
                                <div class="my-auto">  
                                                                     
								<!-- Registration Office -->
								<div class="card mb-3 shadow-lg" style="border: none; transform: perspective(1000px) rotateX(1deg); transition: all 0.3s ease;">
								    <div class="card-body bg-light">
								        <p>
								            <strong>Registration Office:</strong><br>
								            A-3, Shalaka Chs, Manpada Road, Bank Of baroda Lane, Dombivli (E) 421201
								        </p>
								    </div>
								</div>
								<!-- Sales Office -->
								<div class="card mb-3 shadow-lg" style="border: none; transform: perspective(1000px) rotateX(1deg); transition: all 0.3s ease;">
								    <div class="card-body bg-light">
								        <p>
								            <strong>Sales Office:</strong><br>
								            2nd Flr, Viswadeep Bldg No.2, Patkar road, Near Canara Bank, Dombivli (E) 421201
								        </p>
								    </div>
								</div>
								<p>
								  <a href="tel://+919619441953" class="btn-link">
									<em class="fas fa-phone text-secondary me-2"></em>+91 93207 17501
								  </a>
								 
								</p>
                                <p> <a href="mailto://info@adityamatrimony.com" class="btn-link mb-3">
									<em class="fas fa-envelope text-secondary me-2"></em>info@adityamatrimony.com
								  </a>
                                </p>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="col-lg-5 wow fadeInUp order-first order-md-last" data-wow-delay="0.3s">
                            <img src="<?php echo e(asset('assets/images/aboutbanner.jpg')); ?>" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 400px; height: 400px;">
                        </div>
                        
                       
                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    

    

    
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
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/pages/contact_us.blade.php ENDPATH**/ ?>