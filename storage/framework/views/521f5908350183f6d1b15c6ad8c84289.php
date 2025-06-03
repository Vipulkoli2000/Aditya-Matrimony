<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Aditya Matrimony</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <link rel="icon" href="<?php echo e(asset('assets/user/img/favicon.png')); ?>">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;500;600&family=Petit+Formal+Script&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets/user/lib/animate/animate.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('assets/user/lib/lightbox/css/lightbox.min.css')); ?>" rel="stylesheet">

  <!-- Include SweetAlert2 CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?php echo e(asset('assets/user/css/bootstrap.min.css')); ?>" rel="stylesheet">
  <!-- Template Stylesheet -->
  <link href="<?php echo e(asset('assets/user/css/style.css')); ?>" rel="stylesheet">

  <style>
    /* Custom responsive styles */
    @media (max-width: 768px) {
      /* Adjust navbar logo size on small screens */
      .navbar-brand img {
        height: 50px;
      }

      /* Scale down carousel captions */
      .carousel-caption h1,
      .carousel-caption h2 {
        font-size: 2rem;
      }
      .carousel-caption p {
        font-size: 1rem;
      }

      /* Center footer text on smaller devices */
      .footer .col-lg-3,
      .footer .col-lg-6 {
        text-align: center !important;
      }
      .footer .col-lg-3 {
        margin-bottom: 20px;
      }
    }

    /* Adjust booking link hover for touch devices if needed */
    .booking-link:hover {
      color: #f24e4e;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4), -2px -2px 8px rgba(0, 0, 0, 0.4);
    }
  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navBar" id="weddingHome">
  <!-- Navbar start -->
  <div class="container-fluid sticky-top px-0">
    <div class="container-fluid">
      <div class="container px-0">
        <nav class="navbar navbar-light navbar-expand-xl py-2" id="navBar">
          <a href="#" class="navbar-brand">
            <img src="<?php echo e(asset('assets/user/img/logo.png')); ?>" class="img-fluid" style="height: 60px;">
          </a>
          <button class="navbar-toggler py-1 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-primary"></span>
          </button>
          <div class="collapse navbar-collapse py-2" id="navbarCollapse">
            <div class="navbar-nav mx-auto border-top">
              <a href="/" class="nav-item nav-link active">Home</a>
              <a href="/about" class="nav-item nav-link">About Us</a>
              <a href="<?php echo e(route('basic_details.index')); ?>" class="nav-item nav-link">Profile</a>
              <a href="<?php echo e(route('contact_us')); ?>" class="nav-item nav-link <?php echo e(Request::is('contact-us') ? 'active' : ''); ?>">Contact Us</a>
            </div>
            <?php if(auth()->guard()->check()): ?>
            <div class="d-flex align-items-center flex-nowrap">
              <a href="<?php echo e(route('profiles.update_password')); ?>" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">
                Update Password
              </a>
              <form action="<?php echo e(route('logout')); ?>" method="POST" id="logout-form">
                <?php echo csrf_field(); ?>
                <button type="button" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white" onclick="confirmLogout()">Logout</button>
              </form>
            </div>

            <script>
              function confirmLogout() {
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You will be logged out!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, logout!',
                  cancelButtonText: 'No, cancel!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                  }
                });
              }
            </script>

            <?php else: ?>
            <div class="d-flex align-items-center flex-nowrap">
              <a href="<?php echo e(route('register')); ?>" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Register</a>
              <a href="<?php echo e(route('login')); ?>" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Login</a>
            </div>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid carousel-header px-0 myslider">
    <div id="carouselId" class="carousel slide myslider" data-bs-ride="carousel">
      <div class="carousel-inner myslider" role="listbox">
        <div class="carousel-item active">
          <img src="<?php echo e(asset('assets/images/banner01.jpeg')); ?>" class="img-fluid w-100" alt="Image">
          <div class="carousel-caption myslider">
            <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
              <div class="d-inline-block p-2 mb-3" 
              style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
           <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Welcome To</p>
         </div>
         
              <h1 class="display-1 text-capitalize text-white mb-3">Aditya <em class="fa fa-heart text-primary">&nbsp;</em>Matrimonial</h1>
              <div class="d-inline-block p-2 mb-3" 
              style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
           <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 1px; font-size: 19px;">
             Dear Members, please take a moment to update your profile.<br>
             If you need any assistance, feel free to contact the office.
           </p>
         </div>
         
            </div>
          </div>
        </div>
        <div class="carousel-item myslider">
          <img src="<?php echo e(asset('assets/images/banner02.jpeg')); ?>" class="img-fluid w-100" alt="Image">
          <div class="carousel-caption myslider">
            <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
              <div class="d-inline-block p-2 mb-3" 
              style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
           <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Welcome To</p>
         </div>
              <h2 class="display-1 text-capitalize text-white mb-3">Aditya Matrimony</h2>
             <div class="d-inline-block p-2 mb-3" 
     style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
  <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 1px; font-size: 19px;">
    Dear Members, please take a moment to update your profile.<br>
    If you need any assistance, feel free to contact the office.
  </p>
</div>

            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- Carousel End -->

  

  

  <div class="container my-4">
  <div style="width: full: 36rem; margin: 0 auto; padding: 1.5rem; background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); text-align: center; border: 1px solid #fecaca;">
  <h2 style="font-size: 1.875rem; font-weight: bold; color: #b91c1c;">Want to find your life partner?</h2>
  <p style="color: #dc2626; font-size: 1.125rem;">
    Join our community matrimony and start your journey to finding your soulmate by following these steps
  </p>

  <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap; margin: 0 auto;">
  <!-- Step 1 -->
  <div style="display: flex; align-items: center; gap: 0.5rem;">
    <div style="min-width: 40px; min-height: 40px; background-color: #b91c1c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">1</div>
    <div style="font-size: 1rem; font-weight: 600; color: #b91c1c;">Register</div>
  </div>

  <div style="font-size: 1.5rem; color: #b91c1c;">→</div>

  <!-- Step 2 -->
  <div style="display: flex; align-items: center; gap: 0.5rem;">
    <div style="min-width: 40px; min-height: 40px; background-color: #b91c1c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">2</div>
    <div style="font-size: 1rem; font-weight: 600; color: #b91c1c;">Login your account</div>
  </div>

  <div style="font-size: 1.5rem; color: #b91c1c;">→</div>

  <!-- Step 3 -->
  <div style="display: flex; align-items: center; gap: 0.5rem;">
    <div style="min-width: 40px; min-height: 40px; background-color: #b91c1c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">3</div>
    <div style="font-size: 1rem; font-weight: 600; color: #b91c1c;">Buy a package</div>
  </div>

  <div style="font-size: 1.5rem; color: #b91c1c;">→</div>

  <!-- Step 4 -->
  <div style="display: flex; align-items: center; gap: 0.5rem;">
    <div style="min-width: 40px; min-height: 40px; background-color: #b91c1c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">4</div>
    <div style="font-size: 1rem; font-weight: 600; color: #b91c1c;">Create a profile</div>
  </div>

  
  <div style="font-size: 1.5rem; color: #b91c1c;">→</div>



  <!-- Step 5 -->
  <div style="display: flex; align-items: center; gap: 0.5rem;">
    <div style="min-width: 40px; min-height: 40px; background-color: #b91c1c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">5</div>
    <div style="font-size: 1rem; font-weight: 600; color: #b91c1c;">Start Searching</div>
  </div>
</div>


</div>
    <div class="d-flex justify-content-evenly">
      <?php echo e($slot); ?>

    </div>
  </div>

  <!-- Footer Start -->
  <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5 justify-content-center">
        <div class="col-lg-3 text-lg-start text-center">
          <div class="footer-item d-flex flex-column">
            <h4 class="mb-4 text-white">Quick Links</h4>
            <a href="/" class="btn-link">Home</a>
            <a href="/terms-and-conditions" class="btn-link">Terms and Conditions</a>
            <a href="/privacy-policy" class="btn-link">Privacy Policy</a>
            <a href="/disclaimer" class="btn-link">Disclaimer</a>
          </div>
        </div>
        <div class="col-lg-6 text-center">
          <div class="footer-item">
            <h4 class="mb-4 text-white">Aditya Matrimony</h4>
            <p class="text-white">
              Aditya Matrimony is a community-driven platform dedicated to facilitating matrimonial alliances within the community, focusing on cultural heritage and tradition. We offer a personalized, respectful approach to matchmaking, helping individuals and families find compatible life partners.
            </p>
          </div>
        </div>
        <div class="col-lg-3 text-lg-end text-center">
            <div class="footer-item d-flex flex-column align-items-center">
              <h4 class="my-4 text-white">Contact Us</h4>
              <a href="/contact-us" class="booking-link">
                Admin & Hall Booking Office<br>
                Aditya Matrimony, Dombivli
              </a>
              <a href="tel:+919320717501" class="btn-link mb-3">
                <em class="fas fa-phone text-secondary me-2"></em>+91 9320717501
              </a>
              <!-- Responsive embed for Google Maps -->
              <div class="ratio ratio-16x9 mx-auto" style="max-width: 270px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.3576948151513!2d73.08635869999999!3d19.223236699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7be1e49e1cd0b%3A0x4665e488ad316e80!2sMaratha%20Mandir%20Hall!5e0!3m2!1sen!2sin!4v1739423879005!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
          
      </div>
    </div>
  </div>
  <!-- Footer End -->

  <!-- Copyright Start -->
  <div class="container-fluid copyright py-4">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-md-6 text-center text-md-start mb-md-0">
          <span class="text-light">Aditya Matrimony | Developed By <a href="https://sanmisha.com" target="_blank">Sanmisha Technologies</a></span>
        </div>
      </div>
    </div>
  </div>
  <!-- Copyright End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('assets/user/lib/wow/wow.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/lib/waypoints/waypoints.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/lib/lightbox/js/lightbox.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/user/lib/easing/easing.min.js')); ?>"></script>
  <!-- Template Javascript -->
  <script src="<?php echo e(asset('assets/user/js/main.js')); ?>"></script>
  <script src="/assets/js/alpine-collaspe.min.js"></script>
  <script src="/assets/js/alpine-persist.min.js"></script>
  <script defer src="/assets/js/alpine-ui.min.js"></script>
  <script defer src="/assets/js/alpine-focus.min.js"></script>
  <script defer src="/assets/js/alpine.min.js"></script>
  <script src="/assets/js/custom.js"></script>

  <style>
    /* Custom style for the SweetAlert2 popup */
    .red-swal-popup {
      background-color: #f24e4e !important;
      color: white !important;
    }
    .red-swal-popup .swal2-title,
    .red-swal-popup .swal2-html-container {
      color: white !important;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Check if the welcome popup has been shown in this tab
      if (!sessionStorage.getItem('welcomePopupShown')) {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Welcome to Aditya Matrimony',
          html: 'Dear Members,<br>Please take a moment to update your profile. If you need any assistance, feel free to contact the office.',
          showConfirmButton: true,
          timer: 10000,
          customClass: {
            popup: 'red-swal-popup'
          }
        });
        // Mark the popup as shown for this tab
        sessionStorage.setItem('welcomePopupShown', 'true');
      }
    });

    // URL overlay script (if the element is used)
    document.addEventListener("DOMContentLoaded", function () {
      const currentUrl = window.location.href;
      const urlPath = currentUrl.split('?')[0];
      const segments = urlPath.split('/');
      const lastSegment = segments[segments.length - 1];

      if (lastSegment === 'login') {
        document.getElementById('urlOverlay').innerText = 'Login';
      } else if (lastSegment === 'register') {
        document.getElementById('urlOverlay').innerText = 'Register';
      } else if (segments.length === 4 && segments[2] === 'profile' && !isNaN(lastSegment)) {
        document.getElementById('urlOverlay').innerText = 'Profile';
      } else {
        const capitalizedFirstSegment = segments[segments.length - 2].charAt(0).toUpperCase() + segments[segments.length - 2].slice(1);
        const formattedText = lastSegment.split('_').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        document.getElementById('urlOverlay').innerText = capitalizedFirstSegment + ' / ' + formattedText;
      }
    });
  </script>
</body>

</html>
<?php /**PATH D:\dir\Aditya Matrimony\resources\views/components/layout/user.blade.php ENDPATH**/ ?>