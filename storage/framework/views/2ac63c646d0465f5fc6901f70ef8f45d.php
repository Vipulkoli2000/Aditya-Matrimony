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
    <!-- Mobile Responsive CSS -->
    <style>
      @media (max-width: 767px) {
        /* Adjust heading and text margins and font sizes */
        #weddingAbout h2.display-1.text-primary {
          margin-left: 15px !important;
          margin-top: 15px !important;
          font-size: 2.5rem !important;
        }
        #weddingAbout h1 {
          font-size: 1.5rem !important;
          margin-left: 15px !important;
        }
        #weddingAbout p1,
        #weddingAbout p2 {
          margin-left: 15px !important;
          font-size: 1rem !important;
        }
        
        /* Make images responsive */
        .about-image {
          width: 100% !important;
          height: auto !important;
        }
        
        /* Adjust story timeline layout: stack columns vertically */
        .story-timeline .row {
          flex-direction: column !important;
        }
        .story-timeline .col-md-6 {
          flex: 0 0 100% !important;
          max-width: 100% !important;
          border: none !important;
          padding: 15px !important;
        }
        
        /* Adjust padding in the secondary background boxes */
        .bg-secondary.p-4 {
          padding: 15px !important;
        }
      }
    </style>
  
    <div>
      <div class="" id="weddingAbout">
        <div class="container position-relative py-5">
          <div class="row">
            <div class="col-lg-12">
              <div class="row g-4 align-items-center">
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                  <div class="mx-auto mb-3 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="display-1 text-primary" style="margin-left: 35px; margin-top: 35px;">About Us</h2>
                  </div>
                  <div class="d-flex">
                    <div class="my-auto">
                      <b>
                        <h1 style="font-weight: bold; font-size: 20px;">Welcome to Aditya Matrimony !!!</h1>
                      </b>
                      <p1 style="color: black; margin-left: 30px;">
                        Aditya Matrimony is an exclusive matrimony portal catering to special matrimonial needs of all community across the globe. The portal offers several benefits to its members, pleasure of searching of ultimate life partner from across the globe at the click of mouse.
                      </p1>
                      <br><br>
                      <p2 style="color: black; margin-left: 30px;">
                        Everybody wants to find the right partner, so we have started this project so that you can get the most suitable, good and easy information from all over the world. We are committed to providing the most appropriate and quality service possible
                        <br><br>
                        We committed to the safety and security and do all we can to protect members privacy
                       
                        If you expect something more convenient for us, we will always try to improve it by considering the right one.
                        <br><br>
                        We promise you to provide this service everywhere
                      </p2>
                    </div>
                  </div>
                  <!-- <a class="btn btn-primary btn-primary-outline-0 py-3 px-5 mt-4" href="#">Know More</a> -->
                </div>
                <div class="col-lg-5 wow fadeInUp order-first order-md-last" data-wow-delay="0.3s">
                  <img src="<?php echo e(asset('assets/images/aboutbanner.jpg')); ?>" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 400px; height: 400px;">
                </div>
              </div>
              <!-- <?php echo @@$about1->description; ?> -->
            </div>
          </div>
        </div>
      </div>
      <!-- about end -->
      <!-- story start -->
      <div class="container-fluid story position-relative py-5" id="weddingStory">
        <div class="container position-relative py-5">
          <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="display-4">Success Stories</h2>
          </div>
          <div class="story-timeline">
            <div class="row wow fadeInUp" data-wow-delay="0.2s">
              <div class="col-md-6 text-end border-0 border-top border-end border-secondary p-4">
                <div class="d-inline-flex align-items-center h-100">
                  <img src="<?php echo e(asset('assets/images/KundaliMatching.jpeg')); ?>" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 300px; height: 300px;">
                </div>
              </div>
              <div class="col-md-6 border-start border-top border-secondary p-4 pe-0">
                <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                  <h3 class="h4 mb-2 text-white" style="font-weight: bold;">What we do</h3>
                  <!-- <p class=" text-light mb-2" >01 Jan 2020</p> -->
                  <p style="text-size: 100px">
                    <span style="color: black; font-weight: bold;">Matrimonial Services:</span> We offer a trusted platform where individuals and families can register, create detailed profiles, and find matches based on specific criteria, including caste, education, profession, and more.
                  </p>
                  <p style="text-size:100px">
                    <span style="color: black; font-weight: bold;">Event Organizing: </span>From marriage events to community gatherings, we organize regular meet-ups and matrimonial events where families can connect in person, fostering a sense of trust and mutual respect.
                  </p>
                </div>
              </div>
            </div>
            <div class="row flex-column-reverse flex-md-row wow fadeInUp" data-wow-delay="0.3s">
              <div class="col-md-6 text-end border-end border-top border-secondary p-4 ps-0">
                <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                  <h3 class="h4 mb-2 text-white" style="font-weight: bold;">Our Values</h3>
                  <!-- <p class=" text-light mb-2" >01 Jan 2020</p> -->
                  <p>
                    <span style="color: black; font-weight: bold;">Integrity & Trust:</span> We are committed to providing transparent and trustworthy services, ensuring that every member is treated with the utmost respect and privacy.
                  </p>
                  <p>
                    <span style="color: black; font-weight: bold;">Cultural Preservation:</span> At Aditya Matrimony, we believe in upholding the rich traditions and values of the community, ensuring that matrimonial decisions reflect both modern aspirations and ancestral values.
                  </p>
                  <p>
                    <span style="color: black; font-weight: bold;">Community Connection:</span> We foster a close-knit network where families can meet like-minded individuals who share common values, culture, and goals.
                  </p>
                </div>
              </div>
              <div class="col-md-6 border-start border-top border-secondary p-4">
                <div class="d-inline-flex align-items-center h-100">
                  <div class="d-inline-flex align-items-center h-100">
                    <img src="<?php echo e(asset('assets/images/OurValues.jpeg')); ?>" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 300px; height: 300px;">
                  </div>
                </div>
              </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.4s">
              <div class="col-md-6 text-end border-end border-top border-secondary p-4 ps-0">
                <div class="d-inline-flex align-items-center h-100">
                  <img src="<?php echo e(asset('assets/images/whychooseus.jpeg')); ?>" alt="Aditya Matrimony, Dombivili" class="about-image" style="width: 300px; height: 300px;">
                </div>
              </div>
              <div class="col-md-6 border-start border-top border-secondary p-4 pe-0">
                <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4">
                  <h3 class="h4 mb-2 text-white" style="font-weight: bold;">Why Choose Us?</h3>
                  <!-- <p class=" text-light mb-2" >01 Jan 2020</p> -->
                  <p>
                    <span style="color: black; font-weight: bold;">Personalized Matchmaking:</span> Unlike other platforms, we focus on understanding your unique preferences and family values, ensuring we find the most compatible partners for you.
                  </p>
                  <p>
                    <span style="color: black; font-weight: bold;">Confidentiality:</span> We prioritize the privacy of your personal information, ensuring that all profiles are handled with confidentiality and respect.
                  </p>
                  <p>
                    <span style="color: black; font-weight: bold;">Proven Success:</span> Over the years, Aditya Matrimony has helped many families successfully find life partners, making us a trusted name in the community.
                  </p>
                </div>
              </div>
            </div>
            <!-- Removed unused row -->
          </div>
        </div>
      </div>
      <!-- story end -->
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
  <?php /**PATH D:\dir\Aditya Matrimony\resources\views/default/view/pages/about_us.blade.php ENDPATH**/ ?>