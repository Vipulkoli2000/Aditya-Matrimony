<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Aditya Matrimony</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ asset('assets/user/img/favicon.png') }}">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('assets/user/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/user/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Include SweetAlert2 CSS and JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Template Stylesheet -->
  <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet">

  <style>
    /* Custom responsive styles */
    @media (max-width: 768px) {
      /* Adjust navbar logo size on small screens */
      .navbar-brand img {
        height: 35px;
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
      
      /* Responsive floating navbar */
      .container-fluid.fixed-top {
        padding: 0.5rem 0.5rem !important;
      }
      
      .navbar {
        border-radius: 10px !important;
      }
      
      /* Adjust carousel and advertisement heights on mobile */
      .carousel-header .carousel {
        height: 300px; /* Fixed height for mobile */
      }
      
      .advertisement-container {
        height: 25.05vh; /* Increased by 15% from 21.78vh */
        width: 100%; /* Full width on mobile */
      }
    }
    
    /* Tablet specific adjustments */
    @media (min-width: 769px) and (max-width: 1024px) {
      .carousel-header .carousel,
      .carousel-header .carousel-item {
        min-height: 39.6vh; /* Increased by 10% from 36vh */
      }
      
      .advertisement-container {
        height: 30.06vh; /* Increased by 15% from 26.14vh */
        width: 100%; /* Full width on tablet */
      }
    }

    /* Adjust booking link hover for touch devices if needed */
    .booking-link:hover {
      color: #007bff; /* Blue Theme */
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4), -2px -2px 8px rgba(0, 0, 0, 0.4);
    }
    
    /* Navbar animation for scrolling */
    .navbar {
      transition: all 0.3s ease;
    }
    
    /* 3D Button Styling */
    .btn-primary {
      background: linear-gradient(to bottom, #269bff, #007bff); /* Blue Theme */
      border: none;
      border-radius: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
      transform: translateY(0);
      transition: all 0.2s ease;
      font-weight: 500;
      padding: 0.375rem 1.2rem;
      height: 36px;
      line-height: 1.5;
    }
    
    /* Button size standardization */
    .btn-sm.btn-primary {
      height: 32px;
      font-size: 0.875rem;
      padding: 0.25rem 0.75rem;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
      background: linear-gradient(to bottom, #3da9fc, #0069d9); /* Blue Theme Hover */
    }
    
    .btn-primary:active {
      transform: translateY(1px);
      box-shadow: 0 3px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.08);
    }
    
    /* Add some spacing to body to account for fixed navbar */
    body {
      padding-top: 80px;
    }

    /* Carousel Professional Enhancements */
    .carousel-header .carousel {
      height: 700px !important; /* Adjusted to match total advertisement height (295+400+gap) */
      overflow: hidden;
      border-radius: 10px;
    }
    /* Target specific carousel with higher specificity */
    #carouselId.myslider {
      height: 700px !important;
      max-height: 700px !important;
    }
    .carousel-header .myslider,
    #carouselId .carousel-inner.myslider {
      height: 700px !important;
    }
    .carousel-header .carousel-item {
      height: 100%;
      position: relative;
    }
    .carousel-header .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensure image covers area without distortion */
      object-position: center; /* Center the image */
    }
    .carousel-header .carousel-caption {
      background: rgba(0, 0, 0, 0.35); /* Subtle dark overlay */
      padding: 10px;
      border-radius: 10px;
    }
    /* Adjust text sizes for 700px height carousel */
    .carousel-header .carousel-caption h1,
    .carousel-header .carousel-caption h2 {
      font-size: 4rem !important;
    }
    .carousel-header .carousel-caption .display-1 {
      font-size: 4.5rem !important;
    }
    .carousel-header .carousel-caption .h4 {
      font-size: 1.5rem !important;
    }
    .carousel-header .carousel-caption p {
      font-size: 1.25rem !important;
      margin-bottom: 0.75rem !important;
    }
    .carousel-header .carousel-caption {
      padding: 25px;
    }
    .carousel-header .carousel-indicators [data-bs-target] {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background-color: #ffffff;
      opacity: 0.8;
    }
    .carousel-header .carousel-indicators .active {
      background-color: #C95B63; /* Theme accent */
      opacity: 1;
    }

    /* Mobile Sidebar Styles - New Design */
    .mobile-sidebar {
        height: 100%;
        width: 300px; /* Fixed width for the sidebar */
        position: fixed;
        z-index: 1050; /* Ensure sidebar is above overlay and other content */
        top: 0;
        left: -300px; /* Start off-screen */
        background-color: #fff;
        overflow: hidden; /* Prevents scrollbars on the container itself */
        transition: left 0.3s ease-in-out;
        box-shadow: 2px 0 10px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
    }

    .mobile-sidebar.open {
        left: 0; /* Slide in */
    }

    .mobile-sidebar-header {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        flex-shrink: 0; /* Prevent header from shrinking */
        background-color: #fff;
    }

    .mobile-sidebar-header .back-btn {
        font-size: 20px;
        color: #333;
        margin-right: 15px;
        text-decoration: none;
        padding: 5px; /* Clickable area */
    }
    .mobile-sidebar-header .back-btn:hover {
        color: #007bff; /* Blue Theme */
    }

    .mobile-sidebar-header .user-info-details {
        flex-grow: 1; /* Allow text to take available space */
        overflow: hidden; /* Prevent long text from breaking layout */
    }

    .mobile-sidebar-header .user-name {
        display: block;
        font-weight: 600;
        font-size: 1rem;
        color: #212529;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mobile-sidebar-header .user-followers {
        font-size: 0.75rem;
        color: #6c757d;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mobile-sidebar-header .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 10px;
        flex-shrink: 0;
    }
    .mobile-sidebar-header #userProfileIconFallback {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-left: 10px;
        background-color: #007bff; /* Blue Theme */
        color: white;
        display: flex; /* Use flex to center icon */
        align-items: center;
        justify-content: center;
        font-size: 1.25rem; /* Adjust icon size */
        flex-shrink: 0;
    }

    .mobile-sidebar-content {
        display: flex; /* Key for two-column layout */
        flex-grow: 1; /* Allow content to fill available vertical space */
        overflow-y: auto; /* Enable scrolling for the entire content area if needed */
        overflow-x: hidden;
    }

    .mobile-sidebar-primary-nav {
        width: 70px; /* Width of the icon-only primary navigation */
        padding: 20px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: linear-gradient(to right, #60B5FF, #007BFF);
        flex-shrink: 0;
        overflow-y: auto; /* Scroll if many icons */
    }

    .mobile-sidebar-primary-nav a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 44px; /* Clickable area */
        height: 44px; /* Clickable area */
        color: #ffffff; /* White icon color */
        font-size: 1.3rem;
        margin-bottom: 25px;
        border-radius: 50%; /* Circular background for active/hover */
        text-decoration: none;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .mobile-sidebar-primary-nav a.active-primary-nav-item,
    .mobile-sidebar-primary-nav a:hover {
        background-color: #007bff; /* Blue Theme */
        color: #fff;
    }
    .mobile-sidebar-primary-nav a:last-child {
        margin-bottom: 0;
    }

    .mobile-sidebar-secondary-nav {
            flex-grow: 1;
            padding: 15px 10px 15px 15px; /* Top, Right, Bottom, Left */
            background-color: #fff;
            margin-right: 0; /* Explicitly remove any right margin */
        }

        .mobile-sidebar-secondary-nav .menu-section a {
            display: flex;
            align-items: center;
            padding: 10px 0; /* Reduced vertical padding */
            text-decoration: none;
            font-size: 0.9rem; /* Slightly smaller text */
            color: #333;
            transition: color 0.2s ease, background-color 0.2s ease;
            margin-bottom: 10px; /* Spacing between items */
            border-radius: 4px;
        }

        .mobile-sidebar-secondary-nav .menu-section a i {
            margin-right: 12px;
            font-size: 1rem; /* Icon size in menu */
            width: 20px;
            text-align: center;
            color: #555;
        }

        .mobile-sidebar-secondary-nav .menu-section a:hover {
            color: #007bff; /* Blue Theme */
            /* background-color: #f8f9fa; */ /* Optional: light bg on hover */
        }
        .mobile-sidebar-secondary-nav .menu-section a.active {
             color: #007bff; /* Blue Theme */
             font-weight: 500;
        }

        .mobile-sidebar-secondary-nav .menu-section a .badge {
            margin-left: auto;
            background-color: #17a2b8; /* Info blue for badge */
            color: white;
            font-size: 0.7rem;
            padding: 3px 6px;
            border-radius: 10px; /* Pill shape */
            line-height: 1;
        }
    .mobile-sidebar-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-top: 1px solid #e0e0e0;
            background-color: #f8f9fa; /* Light footer background */
            flex-shrink: 0;
            height: 50px;
        }

        .mobile-sidebar-footer .btn-logout-icon {
            background: none;
            border: none;
            color: #007bff; /* Blue Theme */
            font-size: 1.4rem;
            cursor: pointer;
            padding: 5px;
        }

        .mobile-sidebar-footer .btn-logout-icon:hover {
            color: #0056b3; /* Darker Blue Theme */
        }

        .mobile-sidebar-footer .app-version {
            font-size: 0.75rem;
            color: #6c757d;
        }

    /* Overlay for when the sidebar is open */
    .sidebar-overlay {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 1049; /* Below sidebar (1050) but above other content */
        opacity: 0;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out; /* Added visibility transition */
        visibility: hidden; /* Ensure it's not interactive when hidden */
    }

    .sidebar-overlay.show {
        display: block; /* Or 'flex', 'grid' depending on needs, but 'block' is fine */
        opacity: 1;
        visibility: visible;
    }

    /* SweetAlert2 Customizations for smaller screens */
    .swal2-popup.swal2-sm {
        font-size: 0.8rem;
        width: auto !important;
        max-width: 90%;
    }
    .swal2-popup.swal2-sm .swal2-title {
        font-size: 1.1rem;
    }
    .swal2-popup.swal2-sm .swal2-content,
    .swal2-popup.swal2-sm .swal2-html-container {
        font-size: 0.9rem;
    }
    .swal2-popup.swal2-sm .swal2-actions {
        font-size: 0.8rem;
    }
    
    /* Advertisement Container Styles */
    .advertisement-container {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 295px; /* Default height for advertisements */
        width: 100%; /* Responsive width */
        max-width: 100%; /* Full width of container */
        background-color: #f8f9fa; /* Light background */
    }
    /* Specific size for advertisement carousel (second ad) */
    #advertisementCarouselId.advertisement-container {
        height: 400px !important; /* Fixed height 400px */
        width: 100% !important; /* Full width instead of fixed 800px */
        max-width: 100%; /* Responsive on smaller screens */
    }
    .advertisement-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    
    .advertisement-container img {
        transition: transform 0.3s ease;
        width: 100%;
        height: 100%;
        object-fit: contain !important; /* Ensure full content is visible */
    }
    
    .advertisement-container:hover img {
        transform: scale(1.05);
    }
    
    .advertisement-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 123, 255, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }
    
    .advertisement-container:hover::before {
        opacity: 1;
    }
    
    /* Mobile Advertisement Popup Styles */
    .mobile-ad-popup {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 2000;
        animation: fadeIn 0.3s ease-in-out;
    }
    
    .mobile-ad-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
    }
    
    .mobile-ad-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        max-width: 400px;
        max-height: 80vh;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: popupScale 0.3s ease-out;
    }
    
    .mobile-ad-close {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 35px;
        height: 35px;
        border: none;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s ease;
    }
    
    .mobile-ad-close:hover {
        background: rgba(255, 0, 0, 0.8);
        transform: scale(1.1);
    }
    
    .mobile-ad-carousel {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
    }
    
    .mobile-ad-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .mobile-ad-slide.active {
        opacity: 1;
    }
    
    .mobile-ad-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #f8f9fa;
    }
    
    .mobile-ad-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        border: none;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.2s ease;
        z-index: 5;
    }
    
    .mobile-ad-nav:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: translateY(-50%) scale(1.1);
    }
    
    .mobile-ad-prev {
        left: 10px;
    }
    
    .mobile-ad-next {
        right: 10px;
    }
    
    .mobile-ad-indicators {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 5;
    }
    
    .mobile-ad-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .mobile-ad-indicator.active {
        background: #007bff;
        transform: scale(1.2);
    }
    
    .mobile-ad-indicator:hover {
        background: rgba(255, 255, 255, 0.8);
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes popupScale {
        from { 
            transform: translate(-50%, -50%) scale(0.5);
            opacity: 0;
        }
        to { 
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }
    }
    
    /* Advertisement carousel specific styles */
    #advertisementCarouselId {
        position: relative;
    }
    #advertisementCarouselId .carousel-inner {
        height: 100%;
    }
    #advertisementCarouselId .carousel-item {
        height: 100%;
        background-color: #f8f9fa;
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 10px;
    }
    #advertisementCarouselId .carousel-item > div {
        width: 100%;
        height: auto;
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }
    #advertisementCarouselId .carousel-item img {
        max-width: 100% !important;
        max-height: 390px !important;
        width: auto !important;
        height: auto !important;
        object-fit: contain !important;
        display: block !important;
    }
    /* Advertisement carousel controls positioning */
    #advertisementCarouselId .carousel-control-prev,
    #advertisementCarouselId .carousel-control-next {
        width: 15%;
        opacity: 0.8;
    }
    #advertisementCarouselId .carousel-indicators {
        bottom: 10px;
        margin-bottom: 0;
    }
    #advertisementCarouselId .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ffffff;
        opacity: 0.5;
        border: 1px solid #007bff;
    }
    #advertisementCarouselId .carousel-indicators .active {
        background-color: #007bff;
        opacity: 1;
    }
    
    /* Hide mobile popup on desktop */
    @media (min-width: 992px) {
        .mobile-ad-popup {
            display: none !important;
        }
    }
    
    /* Force carousel height - highest priority */
    #carouselId {
        height: 700px !important;
        max-height: 700px !important;
    }
    div#carouselId.carousel.slide.carousel-fade.myslider {
        height: 700px !important;
    }
  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navBar" id="weddingHome">
  <!-- Navbar start -->
  <div class="container-fluid fixed-top px-4 py-3">
    <div class="container">
    <nav class="navbar navbar-light navbar-expand-xl py-1 px-3 rounded-pill shadow-sm d-flex justify-content-between align-items-center" id="navBar" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); max-height: 65px;">
    <a href="#" class="navbar-brand">
          <img src="{{ asset('assets/user/img/logo1.png') }}" class="img-fluid logo-img"> <!-- Adjust height as needed -->
        </a>
        <!-- Hamburger for mobile sidebar -->
        <button class="navbar-toggler d-lg-none" type="button" onclick="toggleMobileSidebar()" aria-label="Toggle mobile sidebar">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse py-0" id="navbarCollapse">
            <div class="navbar-nav mx-auto border-top">
                <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="/about" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('basic_details.index') }}" class="nav-item nav-link {{ request()->routeIs('basic_details.index') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('wedding.resources') }}" class="nav-item nav-link {{ Request::is('wedding-resources') ? 'active' : '' }}">Wedding Resources</a>
                <a href="{{ route('contact_us') }}" class="nav-item nav-link {{ Request::is('contact-us') ? 'active' : '' }}">Contact Us</a>
            </div>
            @auth
            <div class="d-flex align-items-center flex-nowrap">

                <a href="{{ route('profiles.update_password') }}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">
                    Update Password
                </a>
 
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
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
            
            
            @else
            <div class="d-flex align-items-center flex-nowrap">
                <a href="{{route('login')}}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Login</a>
                <a href="{{route('register')}}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Register</a>
            </div>
            @endauth
        </div>
        </nav>
      </div>
    </div>
  </div>
  <!-- Navbar End -->

  <!-- Carousel Start -->
  <div class="container-fluid carousel-header px-0 myslider">
    <div class="row g-0">
      <!-- Left: Carousel (2/3 width on lg+) -->
      <div class="col-lg-8 col-12">
        <div id="carouselId" class="carousel slide carousel-fade myslider shadow rounded" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>
          <div class="carousel-inner myslider" role="listbox">
            <div class="carousel-item myslider active">
              <img src="{{ asset('assets/images/banner01.jpeg') }}" class="img-fluid w-100" alt="Image">
              <div class="carousel-caption myslider">
                <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
                  <div class="d-inline-block p-2 mb-3" style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Welcome To</p>
                  </div>
                  <h1 class="display-1 text-capitalize text-white mb-3">Aditya <em class="fa fa-heart text-primary">&nbsp;</em>Matrimonial</h1>
                </div>
              </div>
            </div>
            <div class="carousel-item myslider">
              <img src="{{ asset('assets/images/banner02.jpeg') }}" class="img-fluid w-100" alt="Image">
              <div class="carousel-caption myslider">
                <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
                  <div class="d-inline-block p-2 mb-3" style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Welcome To</p>
                  </div>
                  <h2 class="display-1 text-capitalize text-white mb-3">Aditya Matrimony</h2>
                  <div class="d-inline-block p-2 mb-3" style="border-top: 3px double rgb(212, 100, 100); border-bottom: 3px double rgb(212, 100, 100); border-left: none; border-right: none;">
                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 1px; font-size: 19px;">Dear Members, please take a moment to update your profile.<br>If you need any assistance, feel free to contact the office.</p>
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

      <!-- Right: Advertisement carousel (hidden on small screens) -->
      <div class="col-lg-4 d-none d-lg-flex flex-column justify-content-start" style="gap: 0;">
        <!-- Advertisement 1 -->
        <div class="advertisement-container">
          @if($advertisement->advertisement_1)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->advertisement_1 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Advertisement 1" class="img-fluid w-100 h-100 border border-2 rounded" style="object-fit: contain; cursor: pointer; background-color: #f8f9fa;">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/ad-1.jpeg') }}" alt="Advertisement 1" class="img-fluid w-100 h-100 border border-2 rounded" style="object-fit: contain; cursor: pointer; background-color: #f8f9fa;">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/ad-1.jpeg') }}" alt="Advertisement 1" class="img-fluid w-100 h-100 border border-2 rounded" style="object-fit: contain; cursor: pointer; background-color: #f8f9fa;">
          @endif
        </div>
        
<!-- Advertisement Carousel -->
        <div id="advertisementCarouselId" class="carousel slide carousel-fade shadow rounded advertisement-container" data-bs-ride="carousel" style="margin-top: -5px;">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#advertisementCarouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#advertisementCarouselId" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#advertisementCarouselId" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#advertisementCarouselId" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              @if($advertisement->carousel_1)
                <img src="/api/images/{{ $advertisement->carousel_1 }}" class="img-fluid w-100" alt="Carousel Image 1">
              @else
                <img src="{{ asset('assets/images/carousel-1.jpeg') }}" class="img-fluid w-100" alt="Carousel Image 1">
              @endif
            </div>
            <div class="carousel-item">
              @if($advertisement->carousel_2)
                <img src="/api/images/{{ $advertisement->carousel_2 }}" class="img-fluid w-100" alt="Carousel Image 2">
              @else
                <img src="{{ asset('assets/images/carousel-2.jpeg') }}" class="img-fluid w-100" alt="Carousel Image 2">
              @endif
            </div>
            <div class="carousel-item">
              @if($advertisement->carousel_3)
                <img src="/api/images/{{ $advertisement->carousel_3 }}" class="img-fluid w-100" alt="Carousel Image 3">
              @else
                <img src="{{ asset('assets/images/carousel-3.jpeg') }}" class="img-fluid w-100" alt="Carousel Image 3">
              @endif
            </div>
            <div class="carousel-item">
              @if($advertisement->carousel_4)
                <img src="/api/images/{{ $advertisement->carousel_4 }}" class="img-fluid w-100" alt="Carousel Image 4">
              @else
                <img src="{{ asset('assets/images/carousel-4.jpeg') }}" class="img-fluid w-100" alt="Carousel Image 4">
              @endif
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#advertisementCarouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#advertisementCarouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    
  </div>
  <!-- Carousel End -->

  <!-- Mobile Advertisement Popup (only visible on mobile) -->
  <div id="mobileAdPopup" class="mobile-ad-popup d-lg-none" style="display: none;">
    <div class="mobile-ad-overlay" onclick="closeMobileAdPopup()"></div>
    <div class="mobile-ad-content">
      <button class="mobile-ad-close" onclick="closeMobileAdPopup()" aria-label="Close Advertisement">
        <i class="fas fa-times"></i>
      </button>
      <div class="mobile-ad-carousel" id="mobileAdCarousel">
        <!-- Advertisement 1 -->
        <div class="mobile-ad-slide active">
          @if($advertisement->advertisement_1)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->advertisement_1 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Advertisement 1" class="mobile-ad-image">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/ad-1.jpeg') }}" alt="Advertisement 1" class="mobile-ad-image">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/ad-1.jpeg') }}" alt="Advertisement 1" class="mobile-ad-image">
          @endif
        </div>
        
        <!-- Carousel Image 1 -->
        <div class="mobile-ad-slide">
          @if($advertisement->carousel_1)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->carousel_1 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Carousel Image 1" class="mobile-ad-image">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/carousel-1.jpeg') }}" alt="Carousel Image 1" class="mobile-ad-image">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/carousel-1.jpeg') }}" alt="Carousel Image 1" class="mobile-ad-image">
          @endif
        </div>
        
        <!-- Carousel Image 2 -->
        <div class="mobile-ad-slide">
          @if($advertisement->carousel_2)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->carousel_2 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Carousel Image 2" class="mobile-ad-image">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/carousel-2.jpeg') }}" alt="Carousel Image 2" class="mobile-ad-image">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/carousel-2.jpeg') }}" alt="Carousel Image 2" class="mobile-ad-image">
          @endif
        </div>
        
        <!-- Carousel Image 3 -->
        <div class="mobile-ad-slide">
          @if($advertisement->carousel_3)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->carousel_3 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Carousel Image 3" class="mobile-ad-image">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/carousel-3.jpeg') }}" alt="Carousel Image 3" class="mobile-ad-image">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/carousel-3.jpeg') }}" alt="Carousel Image 3" class="mobile-ad-image">
          @endif
        </div>
        
        <!-- Carousel Image 4 -->
        <div class="mobile-ad-slide">
          @if($advertisement->carousel_4)
            <div x-data="imageLoader()" x-init="fetchImage('{{ $advertisement->carousel_4 }}')">
              <template x-if="imageUrl">
                <img :src="imageUrl" alt="Carousel Image 4" class="mobile-ad-image">
              </template>
              <template x-if="!imageUrl">
                <img src="{{ asset('assets/images/carousel-4.jpeg') }}" alt="Carousel Image 4" class="mobile-ad-image">
              </template>
            </div>
          @else
            <img src="{{ asset('assets/images/carousel-4.jpeg') }}" alt="Carousel Image 4" class="mobile-ad-image">
          @endif
        </div>
      </div>
      
      <!-- Navigation arrows -->
      <button class="mobile-ad-nav mobile-ad-prev" onclick="changeMobileAdSlide(-1)" aria-label="Previous Ad">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="mobile-ad-nav mobile-ad-next" onclick="changeMobileAdSlide(1)" aria-label="Next Ad">
        <i class="fas fa-chevron-right"></i>
      </button>
      
      <!-- Indicators -->
      <div class="mobile-ad-indicators">
        <span class="mobile-ad-indicator active" onclick="currentMobileAdSlide(1)"></span>
        <span class="mobile-ad-indicator" onclick="currentMobileAdSlide(2)"></span>
        <span class="mobile-ad-indicator" onclick="currentMobileAdSlide(3)"></span>
        <span class="mobile-ad-indicator" onclick="currentMobileAdSlide(4)"></span>
        <span class="mobile-ad-indicator" onclick="currentMobileAdSlide(5)"></span>
      </div>
    </div>
  </div>

  <div class="container my-4">
  
<!-- Mobile Sidebar - New Design -->
<div id="mobileSidebar" class="mobile-sidebar">
    <!-- Sidebar Header -->
    <style>
        /* Create a fixed-size placeholder for the logo to stabilize the layout */
        .navbar-brand {
            position: relative;
            width: 110px;
            height: 65px; /* Match navbar height to prevent layout shifts */
        }

        /* Position the logo absolutely and center it within the placeholder */
        .logo-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-height: 100%;
            max-width: 100%;
            height: auto;
            width: auto;
            object-fit: contain;
        }

        /* Adjust placeholder and logo for larger screens */
        @media (min-width: 992px) {
            .navbar-brand {
                 width: 100px;
            }
            .logo-img {
                height: 60px !important;
                width: 99px !important;
            }
        }
    </style>
    <div class="mobile-sidebar-header">
        <a href="javascript:void(0)" class="back-btn" onclick="toggleMobileSidebar()" aria-label="Close sidebar">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="user-info-details">
            <span class="user-name">{{ Auth::user()->name ?? 'Guest User' }}</span>
            <span class="user-followers">{{-- 5.2M Followers --}} {{ Auth::user()->email ?? 'Welcome!!'}}</span>
        </div>
        <span id="userProfileIconFallback" style="display:none; width: 40px; height: 40px; border-radius: 50%; margin-left: 10px; background-color: #C95B63; color: white; align-items: center; justify-content: center; font-size: 24px;">
            <i class="fas fa-user-circle"></i>
        </span>
    </div>

    <!-- Sidebar Content (Primary Nav + Secondary Nav) -->
    <div class="mobile-sidebar-content">
        <!-- Primary Navigation (Icon Column) -->
        <div class="mobile-sidebar-primary-nav">
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active-primary-nav-item' : '' }}" title="Home">
                <i class="fas fa-home"></i>
            </a>
            <a href="{{ url('/about') }}" class="{{ Request::is('about') ? 'active-primary-nav-item' : '' }}" title="About Us">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="{{ route('wedding.resources') }}" class="{{ Request::routeIs('wedding.resources') ? 'active-primary-nav-item' : '' }}" title="Wedding Resources">
                <i class="fas fa-map-marker-alt"></i>
            </a>
            <a href="{{ route('contact_us') }}" class="{{ Request::routeIs('contact_us') ? 'active-primary-nav-item' : '' }}" title="Contact Us">
                <i class="fas fa-envelope"></i>
            </a>
           
        </div>

        <!-- Secondary Navigation (Menu Items) -->
        <div class="mobile-sidebar-secondary-nav">
            @auth
            <ul class="profile-sidebar-nav" id="menu-dashboard" style="display: flex; flex-direction: column; gap: 20px; list-style: none; margin: 0; padding: 0;">
                <li class="profile-sidebar-item {{ request()->routeIs('search.create') ? 'active' : '' }}">
                    <a href="{{ route('search.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-search" style="color: black;"></i><span style="color: black;"> Search</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('view_profile.create') ? 'active' : '' }}">
                    <a href="{{ route('view_profile.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-eye" style="color: black;"></i><span style="color: black;"> View&nbsp;Profile</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('basic_details.index') ? 'active' : '' }}">
                    <a href="{{ route('basic_details.index') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-user" style="color: black;"></i><span style="color: black;"> Basic&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('religious_details.create') ? 'active' : '' }}">
                    <a href="{{ route('religious_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-pray" style="color: black;"></i><span style="color: black;"> Religious&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('family_details.create') ? 'active' : '' }}">
                    <a href="{{ route('family_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-users" style="color: black;"></i><span style="color: black;"> Family&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('astronomy_details.create') ? 'active' : '' }}">
                    <a href="{{ route('astronomy_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-star" style="color: black;"></i><span style="color: black;"> Astronomy&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('educational_details.create') ? 'active' : '' }}">
                    <a href="{{ route('educational_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-graduation-cap" style="color: black;"></i><span style="color: black;"> Educational&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('occupation_details.create') ? 'active' : '' }}">
                    <a href="{{ route('occupation_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-briefcase" style="color: black;"></i><span style="color: black;"> Occupational&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('contact_details.create') ? 'active' : '' }}">
                    <a href="{{ route('contact_details.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-address-book" style="color: black;"></i><span style="color: black;"> Contact&nbsp;Details</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('life_partner.create') ? 'active' : '' }}">
                    <a href="{{ route('life_partner.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-heart" style="color: black;"></i><span style="color: black;"> About&nbsp;Life&nbsp;Partner</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('user_packages.create') ? 'active' : '' }}">
                    <a href="{{ route('user_packages.create') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-shopping-cart" style="color: black;"></i><span style="color: black;"> Buy&nbsp;Packages</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_interested') ? 'active' : '' }}">
                    <a href="{{ route('profiles.view_interested') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-thumbs-up" style="color: black;"></i><span style="color: black;"> Interested</span>
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_favorite') ? 'active' : '' }}">
                    <a href="{{ route('profiles.view_favorite') }}" style="display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-bookmark" style="color: black;"></i><span style="color: black;"> Favorites</span>
                    </a>
                </li>
           
          </ul>
           
            @else
            <div class="menu-section p-3">
                    <a href="{{ route('login') }}" class="btn btn-primary d-block mb-2 text-white">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary d-block text-white">Register</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Sidebar Footer -->
    @auth
    <div class="mobile-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-logout-icon" aria-label="Logout">
                <i class="fas fa-power-off"></i>
            </button>
        </form>
        <a href="{{ route('profiles.update_password') }}" title="Update Password" aria-label="Update Password" class="btn-update-password-icon">
            <i class="fas fa-key"></i>
        </a>
    </div>
    @endauth
</div>
<div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleMobileSidebar()"></div>

    <div class="d-flex justify-content-evenly">
      {{ $slot }}
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
            <a href="/wedding-resource" class="btn-link">Wedding Resource</a>
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
                <br>
                Aditya Matrimony, Dombivli
              </a>
              <a href="tel:+919320717501" class="btn-link mb-3">
                <em class="fas fa-phone text-secondary me-2"></em>+91 9320717501
              </a>
             
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
  <script src="{{ asset('assets/user/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('assets/user/lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/user/lib/lightbox/js/lightbox.min.js') }}"></script>
  <script src="{{ asset('assets/user/lib/easing/easing.min.js') }}"></script>
  <!-- Template Javascript -->
  <script src="{{ asset('assets/user/js/main.js') }}"></script>
  <script src="/assets/js/alpine-collaspe.min.js"></script>
  <script src="/assets/js/alpine-persist.min.js"></script>
  <script defer src="/assets/js/alpine-ui.min.js"></script>
  <script defer src="/assets/js/alpine-focus.min.js"></script>
  <script defer src="/assets/js/alpine.min.js"></script>
  <script src="/assets/js/custom.js"></script>

  <!-- Alpine.js Image Loader Function -->
  <script>
    function imageLoader() {
        return {
            imageUrl: null,
            async fetchImage(filename) {
                console.log('Fetching image:', filename);
                try {
                    const url = `/api/images/${filename}`;
                    console.log('Request URL:', url);
                    const response = await fetch(url);
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        console.error('Response not ok:', response.status, response.statusText);
                        throw new Error(`Image not found: ${response.status}`);
                    }
                    const blob = await response.blob();
                    this.imageUrl = URL.createObjectURL(blob);
                    console.log('Image loaded successfully');
                } catch (error) {
                    console.error('Error fetching image:', error);
                    this.imageUrl = null;
                }
            }
        };
    }
  </script>

  <style>
    /* Custom style for the SweetAlert2 popup */
    .red-swal-popup {
      background-color: #007bff !important; /* Blue Theme */
      color: white !important;
    }
    .red-swal-popup .swal2-title,
    .red-swal-popup .swal2-html-container {
      color: white !important;
    }
  </style>

  <script>
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const isOpen = sidebar.classList.contains('open');

        if (isOpen) {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = ''; 
        } else {
            sidebar.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden'; 
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && document.getElementById('mobileSidebar').classList.contains('open')) {
            toggleMobileSidebar();
        }
    });

    @auth
    function confirmMobileSidebarLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            customClass: {
                popup: 'swal2-sm' // Ensure this class is defined if you want smaller modals
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('mobileSidebarLogoutForm').submit();
            }
        });
    }
    @endauth

    // Mobile Advertisement Popup Functions
    let currentMobileAdIndex = 0;
    
    function showMobileAdPopup() {
        const popup = document.getElementById('mobileAdPopup');
        if (popup && window.innerWidth < 992) { // Only show on mobile devices
            popup.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            
            // Auto-advance slides every 5 seconds
            if (window.mobileAdInterval) {
                clearInterval(window.mobileAdInterval);
            }
            window.mobileAdInterval = setInterval(() => {
                changeMobileAdSlide(1);
            }, 5000);
        }
    }
    
    function closeMobileAdPopup() {
        const popup = document.getElementById('mobileAdPopup');
        if (popup) {
            popup.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
            
            // Clear auto-advance interval
            if (window.mobileAdInterval) {
                clearInterval(window.mobileAdInterval);
            }
        }
    }
    
    function changeMobileAdSlide(direction) {
        const mobileAdSlides = document.querySelectorAll('.mobile-ad-slide');
        const mobileAdIndicators = document.querySelectorAll('.mobile-ad-indicator');
        
        if (mobileAdSlides.length === 0) return;
        
        // Remove active class from current slide and indicator
        mobileAdSlides[currentMobileAdIndex].classList.remove('active');
        mobileAdIndicators[currentMobileAdIndex].classList.remove('active');
        
        // Calculate new index
        currentMobileAdIndex += direction;
        
        // Wrap around if necessary
        if (currentMobileAdIndex >= mobileAdSlides.length) {
            currentMobileAdIndex = 0;
        } else if (currentMobileAdIndex < 0) {
            currentMobileAdIndex = mobileAdSlides.length - 1;
        }
        
        // Add active class to new slide and indicator
        mobileAdSlides[currentMobileAdIndex].classList.add('active');
        mobileAdIndicators[currentMobileAdIndex].classList.add('active');
    }
    
    function currentMobileAdSlide(index) {
        const mobileAdSlides = document.querySelectorAll('.mobile-ad-slide');
        const mobileAdIndicators = document.querySelectorAll('.mobile-ad-indicator');
        
        if (mobileAdSlides.length === 0) return;
        
        // Remove active class from current slide and indicator
        mobileAdSlides[currentMobileAdIndex].classList.remove('active');
        mobileAdIndicators[currentMobileAdIndex].classList.remove('active');
        
        // Set new index (convert to 0-based)
        currentMobileAdIndex = index - 1;
        
        // Add active class to new slide and indicator
        mobileAdSlides[currentMobileAdIndex].classList.add('active');
        mobileAdIndicators[currentMobileAdIndex].classList.add('active');
    }
    
    // Close popup when escape key is pressed
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMobileAdPopup();
        }
    });

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
      
      // Show mobile advertisement popup after welcome popup (only on mobile)
      setTimeout(() => {
        if (window.innerWidth < 992) {
          showMobileAdPopup();
        }
      }, 3000); // Show after 3 seconds
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
