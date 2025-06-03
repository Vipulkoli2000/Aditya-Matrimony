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
								<p>
									Aditya Matrimony, Mahtama Phule Road<br />
									Dombivli (West), Maharashtra 421202
								</p>
								<p>
								  <a href="tel://+919619441953" class="btn-link">
									<em class="fas fa-phone text-secondary me-2"></em>+91 9619441953
								  </a>
								  <a href="mailto://info@marathavivahmandaldombivli.com" class="btn-link mb-3">
									<em class="fas fa-envelope text-secondary me-2"></em>info@marathavivahmandaldombivli.com
								  </a>
								</p>
								<div class="ratio ratio-16x9 mx-auto" style="max-width: 100%;">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.3576948151513!2d73.08635869999999!3d19.223236699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7be1e49e1cd0b%3A0x4665e488ad316e80!2sMaratha%20Mandir%20Hall!5e0!3m2!1sen!2sin!4v1739423879005!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								</div>

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
<?php /**PATH D:\dir\matrimony\resources\views/default/view/pages/contact_us.blade.php ENDPATH**/ ?>