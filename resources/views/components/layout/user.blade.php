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
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;500;600&family=Petit+Formal+Script&display=swap" rel="stylesheet">

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
    }

    /* Adjust booking link hover for touch devices if needed */
    .booking-link:hover {
      color: #f24e4e;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4), -2px -2px 8px rgba(0, 0, 0, 0.4);
    }
    
    /* Navbar animation for scrolling */
    .navbar {
      transition: all 0.3s ease;
    }
    
    /* 3D Button Styling */
    .btn-primary {
      background: linear-gradient(to bottom, #f27272, #e63946);
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
      background: linear-gradient(to bottom, #f15b5b, #d62c39);
    }
    
    .btn-primary:active {
      transform: translateY(1px);
      box-shadow: 0 3px 4px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.08);
    }
    
    /* Add some spacing to body to account for fixed navbar */
    body {
      padding-top: 80px;
    }
  </style>
  <style>
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
        color: #e63946; /* Theme color */
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
        background-color: #C95B63; /* Fallback background */
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
        background: linear-gradient(180deg, #FFD1D1 0%, #E06C75 100%); /* Gradient from memory */
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
        background-color: #C95B63; /* Darker red for active/hover */
        color: #fff;
    }
    .mobile-sidebar-primary-nav a:last-child {
        margin-bottom: 0;
    }

    .mobile-sidebar-secondary-nav {
        flex-grow: 1; /* Takes remaining width */
        padding: 15px 10px 15px 15px; /* T, R, B, L */
        background-color: #fff;
        overflow-y: auto; /* Enable scrolling for secondary nav items */
    }

    .mobile-sidebar-secondary-nav .profile-sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .mobile-sidebar-secondary-nav .profile-sidebar-item a {
        display: flex;
        align-items: center;
        padding: 10px 0; /* Reduced vertical padding */
        text-decoration: none;
        font-size: 0.9rem;
        color: #333;
        transition: color 0.2s ease, background-color 0.2s ease;
        margin-bottom: 10px;
        border-radius: 4px;
    }

    .mobile-sidebar-secondary-nav .profile-sidebar-item a i {
        margin-right: 12px;
        font-size: 1rem;
        width: 20px;
        text-align: center;
        color: #555;
    }

    .mobile-sidebar-secondary-nav .profile-sidebar-item a:hover {
        color: #e63946;
    }
    .mobile-sidebar-secondary-nav .profile-sidebar-item.active a {
         color: #e63946;
         font-weight: 500;
    }

    .mobile-sidebar-footer {
        display: flex;
        justify-content: space-between; /* Pushes items to ends */
        align-items: center;
        padding: 10px 15px;
        border-top: 1px solid #e0e0e0;
        background-color: #f8f9fa; /* Light footer background */
        flex-shrink: 0; /* Prevent footer from shrinking */
        height: 50px; /* Fixed height for footer */
    }

    .mobile-sidebar-footer .btn-icon-style {
        background: none;
        border: none;
        color: #555; /* Dark grey icon */
        font-size: 1.4rem;
        cursor: pointer;
        padding: 5px;
        line-height: 1; /* Ensure icon is vertically centered if text were present */
    }
    .mobile-sidebar-footer .btn-icon-style:hover {
        color: #e63946; /* Theme color on hover */
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
  </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navBar" id="weddingHome">
  <!-- Navbar start -->
  <div class="container-fluid fixed-top px-4 py-3">
    <div class="container">
      <nav class="navbar navbar-light navbar-expand-lg py-1 px-3 rounded-pill shadow-sm" id="navBar" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); max-height: 65px;">
        <a href="#" class="navbar-brand">
          <img src="{{ asset('assets/user/img/logo.png') }}" class="img-fluid" style="height: 38px;">
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
                <a href="{{route('register')}}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Register</a>
                <a href="{{route('login')}}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">Login</a>
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
    <div id="carouselId" class="carousel slide myslider" data-bs-ride="carousel">
      <div class="carousel-inner myslider" role="listbox">
        <div class="carousel-item active">
          <img src="{{ asset('assets/images/banner01.jpeg') }}" class="img-fluid w-100" alt="Image">
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
          <img src="{{ asset('assets/images/banner02.jpeg') }}" class="img-fluid w-100" alt="Image">
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
<!-- Mobile Sidebar - New Design -->
<div id="mobileSidebar" class="mobile-sidebar d-md-none">
    <!-- Sidebar Header -->
    <div class="mobile-sidebar-header">
        <a href="javascript:void(0)" class="back-btn" onclick="toggleMobileSidebar()" aria-label="Close sidebar">
            <i class="fas fa-arrow-left"></i>
        </a>
        @auth
        <div class="user-info-details">
            <span class="user-name">{{ Str::limit(Auth::user()->name, 15) }}</span>
            <span class="user-followers">{{ Str::limit(Auth::user()->email, 20) }}</span>
        </div>
        <img src="{{ Auth::user()->img_3 ?? Auth::user()->img_2 ?? Auth::user()->img_1 ?? Auth::user()->profile_photo_url ?? asset('assets/user/img/default-avatar.png') }}"
             alt="User Profile"
             class="profile-pic"
             id="userProfilePic"
             onerror="this.style.display='none'; document.getElementById('userProfileIconFallback').style.display='flex';"
             />
        <span id="userProfileIconFallback" style="display:none; width: 40px; height: 40px; border-radius: 50%; margin-left: 10px; background-color: #C95B63; color: white; align-items: center; justify-content: center; font-size: 24px; font-weight: bold;" class="profile-pic">
            @if(Auth::user() && Auth::user()->name)
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            @else
                <i class="fas fa-user"></i>
            @endif
        </span>
        @else
        <div class="user-info-details">
            <span class="user-name">Guest User</span>
            <span class="user-followers">Welcome!</span>
        </div>
        <span style="width: 40px; height: 40px; border-radius: 50%; background-color: #e9ecef; color: #495057; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;" class="profile-pic"><i class="fas fa-user-circle"></i></span>
        @endauth
    </div>

    <!-- Sidebar Content -->
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

        <!-- Secondary Navigation (Text Menu from user.blade.php) -->
        <div class="mobile-sidebar-secondary-nav">
            @auth
            <ul class="profile-sidebar-nav" id="menu-dashboard">
                <li class="profile-sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-home" style="margin-right: 8px;"></i> Home
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('search.create') ? 'active' : '' }}">
                    <a href="{{ route('search.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-search" style="margin-right: 8px;"></i> Search
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('view_profile.create') ? 'active' : '' }}">
                    <a href="{{ route('view_profile.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-eye" style="margin-right: 8px;"></i> View&nbsp;Profile
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('basic_details.index') ? 'active' : '' }}">
                    <a href="{{ route('basic_details.index') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-user" style="margin-right: 8px;"></i> Basic&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('religious_details.create') ? 'active' : '' }}">
                    <a href="{{ route('religious_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-pray" style="margin-right: 8px;"></i> Religious&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('family_details.create') ? 'active' : '' }}">
                    <a href="{{ route('family_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-users" style="margin-right: 8px;"></i> Family&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('astronomy_details.create') ? 'active' : '' }}">
                    <a href="{{ route('astronomy_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-star" style="margin-right: 8px;"></i> Astronomy&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('educational_details.create') ? 'active' : '' }}">
                    <a href="{{ route('educational_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-graduation-cap" style="margin-right: 8px;"></i> Educational&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('occupation_details.create') ? 'active' : '' }}">
                    <a href="{{ route('occupation_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-briefcase" style="margin-right: 8px;"></i> Occupational&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('contact_details.create') ? 'active' : '' }}">
                    <a href="{{ route('contact_details.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-address-book" style="margin-right: 8px;"></i> Contact&nbsp;Details
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('life_partner.create') ? 'active' : '' }}">
                    <a href="{{ route('life_partner.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-heart" style="margin-right: 8px;"></i> About&nbsp;Life&nbsp;Partner
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_interested') ? 'active' : '' }}">
                    <a href="{{ route('profiles.view_interested') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-thumbs-up" style="margin-right: 8px;"></i> Interested
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('profiles.view_favorite') ? 'active' : '' }}">
                    <a href="{{ route('profiles.view_favorite') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-bookmark" style="margin-right: 8px;"></i> Favorites
                    </a>
                </li>
                <li class="profile-sidebar-item {{ request()->routeIs('user_packages.create') ? 'active' : '' }}">
                    <a href="{{ route('user_packages.create') }}" style="display: flex; align-items: center;">
                        <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i> Buy&nbsp;Packages
                    </a>
                </li>
            </ul>
            @else
                <div class="menu-section p-3">
                    <a href="{{ route('login') }}" class="btn btn-primary d-block mb-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary d-block">Register</a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Sidebar Footer -->
    @auth
    <div class="mobile-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" id="mobileSidebarLogoutForm" style="display: inline;">
            @csrf
            <button type="button" onclick="confirmMobileSidebarLogout()" class="btn-logout-icon" aria-label="Logout" title="Logout">
                <i class="fas fa-power-off"></i>
            </button>
        </form>
        <span class="app-version">App Version - V2.10</span>
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
