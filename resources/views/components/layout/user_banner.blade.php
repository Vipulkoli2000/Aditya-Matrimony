<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Aditya Matrimony</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{asset('assets/user/img/favicon.png')}}">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="{{ asset('assets/user/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/user/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        {{-- <link href="lib/animate/animate.min.css" rel="stylesheet"> --}}
         {{-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> --}}
       
        <!-- Include SweetAlert2 CSS and JS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <!-- Customized Bootstrap Stylesheet -->
        {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        {{-- <link href="css/style.css" rel="stylesheet"> --}}
        <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet">

        <!-- Existing Inline Styles -->
        <style>
        .breadcrumb-container {
            position: relative;
            width: 100%;
        }
        
        .breadcrumb-overlay {
            position: absolute;
            top: 50%; /* Adjust the vertical position */
            left: 50%;
            transform: translate(-50%, -50%); /* Center the breadcrumb */
            color: white; /* Text color */
            z-index: 10; /* Ensure breadcrumb is above the image */
        }
        
        .breadcrumb {
            background-color: transparent; /* Make breadcrumb background transparent */
            margin-bottom: 0; /* Remove bottom margin */
            font-size: 14px; /* Adjust font size */
        }
        
        .breadcrumb a {
            color: white; /* Link color */
        }
        
        .breadcrumb .active {
            color: white; /* Active breadcrumb color */
        }

        .booking-link {
            color: white; /* Set the default text color to white */
            text-decoration: none; /* Remove underline */
            font-weight: bold; /* Optional: make text bold for a stronger impact */
            font-size: 16px; /* Adjust font size as needed */
            transition: color 0.3s ease, text-shadow 0.3s ease; /* Smooth transition for color and text-shadow */
        }

        .booking-link:hover {
            color: #007bff; /* Blue Theme */
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4), -2px -2px 8px rgba(0, 0, 0, 0.4); /* Create 3D shadow effect */
        }
        </style>

        <!-- Added Responsive CSS for Mobile -->
        <style>
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
        
        @media (max-width: 768px) {
            /* Adjust navbar logo size on small screens */
            .navbar-brand img {
                height: 35px;
            }
            /* Smaller breadcrumb text for smaller screens */
            .breadcrumb-overlay {
                font-size: 12px;
            }
            /* Make iframe responsive in footer */
            .footer-item iframe {
                width: 100% !important;
                height: auto !important;
            }
        }
        </style>
       
        <style>
        /* Mobile Sidebar Styles - New Design */
        .mobile-sidebar {
            height: 100%;
            width: 300px; /* Or your preferred width, e.g., 85vw */
            position: fixed;
            z-index: 1050;
            top: 0;
            left: -300px; /* Match width */
            background-color: #fff;
            overflow: hidden; /* Changed from overflow-x: hidden */
            transition: left 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
        }

        .mobile-sidebar.open {
            left: 0;
        }

        .mobile-sidebar-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
            flex-shrink: 0;
            background-color: #fff; /* Header background */
        }

        .mobile-sidebar-header .back-btn {
            font-size: 20px;
            color: #333;
            margin-right: 15px;
            text-decoration: none;
            padding: 5px;
        }
        .mobile-sidebar-header .back-btn:hover {
            color: #007bff;
        }

        .mobile-sidebar-header .user-info-details {
            flex-grow: 1;
        }

        .mobile-sidebar-header .user-name {
            display: block;
            font-weight: 600; /* Bold */
            font-size: 1rem; /* 16px */
            color: #212529;
        }

        .mobile-sidebar-header .user-followers {
            font-size: 0.75rem; /* 12px */
            color: #6c757d;
        }

        .mobile-sidebar-header .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
        }

        .mobile-sidebar-content {
            display: flex;
            flex-grow: 1;
            overflow-y: auto; /* Allow scrolling if content overflows */
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }

        .mobile-sidebar-primary-nav {
            width: 70px;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(180deg, #ADD8E6 0%, #6495ED 100%); /* Soft blue gradient */
            flex-shrink: 0;
        }

        .mobile-sidebar-primary-nav a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 44px;
            height: 44px;
            color: #ffffff; /* White icon color */
            font-size: 1.3rem;
            margin-bottom: 25px;
            border-radius: 50%;
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
        </style>
    </head>
    

    <body data-bs-spy="scroll" data-bs-target="#navBar" id="weddingHome" style="padding-top: 80px;">

        <!-- Navbar start -->
        <div class="container-fluid fixed-top px-4 py-3">
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-xl py-1 px-3 rounded-pill shadow-sm d-flex justify-content-between align-items-center" id="navBar" style="background-color: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); max-height: 65px;">
                    <a href="#" class="navbar-brand">
                    <img src="{{ asset('assets/user/img/logo.png') }}" class="img-fluid logo-img"> <!-- Adjust height as needed -->
                    </a>
                    <button class="navbar-toggler py-1 px-2" type="button" onclick="toggleMobileSidebar()">
                        <span class="fa fa-bars text-primary"></span>
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
        
       
        <style>

        .breadcrumb-container {
            position: relative;
            width: 100%;
        }
        
        .breadcrumb-overlay {
            position: absolute;
            top: 50%; /* Adjust the vertical position */
            left: 50%;
            transform: translate(-50%, -50%); /* Center the breadcrumb */
            color: white; /* Text color */
            z-index: 10; /* Ensure breadcrumb is above the image */
        }
        
        .breadcrumb {
            background-color: transparent; /* Make breadcrumb background transparent */
            margin-bottom: 0; /* Remove bottom margin */
            font-size: 14px; /* Adjust font size */
        }
        
        .breadcrumb a {
            color: white; /* Link color */
        }
        
        .breadcrumb .active {
            color: white; /* Active breadcrumb color */
        }

        .booking-link {
          color: white; /* Set the default text color to white */
          text-decoration: none; /* Remove underline */
          font-weight: bold; /* Optional: make text bold for a stronger impact */
          font-size: 16px; /* Adjust font size as needed */
          transition: color 0.3s ease, text-shadow 0.3s ease; /* Smooth transition for color and text-shadow */
        }

        .booking-link:hover {
          color: #007bff; /* Blue Theme */
          text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4), -2px -2px 8px rgba(0, 0, 0, 0.4); /* Create 3D shadow effect */
        }
        </style>

{{-- <div class="image-container" style="position: relative; display: inline-block; width: 100%;">
    <img src="{{asset('assets/images/mvm banner 04.jpeg')}}" class="img-fluid" alt="Image" style="height: 50px; width: 100%; object-fit: cover;">
    <div class="url-overlay" id="urlOverlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; padding: 10px; background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 14px; font-weight: bold;">
        <!-- URL will be dynamically injected here -->
    </div>
</div> --}}

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    const currentUrl = window.location.href;

    // Extract the path and check if there are query parameters
    const urlPath = currentUrl.split('?')[0];  // Split by '?' to ignore query parameters

    // Extract the path segments
    const segments = urlPath.split('/');
    const lastSegment = segments[segments.length - 1];

    // Check for the specific case of '/user/profile/9'
    if (segments.length === 4 && segments[2] === 'profile' && !isNaN(lastSegment)) {
        // If the URL is specifically '/user/profile/ID', only show 'Profile'
        document.getElementById('urlOverlay').innerText = 'Profile';
    } else {
        // Capitalize and display the full path, like 'Profile / Basic Details'
        const capitalizedFirstSegment = segments[segments.length - 2].charAt(0).toUpperCase() + segments[segments.length - 2].slice(1);

        // If the last segment has underscores, format it (e.g., "basic_details" -> "Basic Details")
        const formattedText = lastSegment
            .split('_')                // Split by underscores
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))  // Capitalize each word
            .join(' ');                // Join with spaces

        // If the URL has multiple path segments, display the first segment followed by the last formatted segment
        const formattedPath = capitalizedFirstSegment + ' / ' + formattedText;
        document.getElementById('urlOverlay').innerText = formattedPath;
    }
});
document.addEventListener("DOMContentLoaded", function() {
    // Get the current page's URL
    const currentUrl = window.location.href;

    // Extract the path and check if there are query parameters
    const urlPath = currentUrl.split('?')[0];  // Split by '?' to ignore query parameters

    // Extract the path segments
    const segments = urlPath.split('/');
    const lastSegment = segments[segments.length - 1];

    // Check for specific cases: /login and /register
    if (lastSegment === 'login') {
        document.getElementById('urlOverlay').innerText = 'Login';
    } else if (lastSegment === 'register') {
        document.getElementById('urlOverlay').innerText = 'Register';
    } else {
        // Check for the specific case of '/user/profile/9'
        if (segments.length === 4 && segments[2] === 'profile' && !isNaN(lastSegment)) {
            // If the URL is specifically '/user/profile/ID', only show 'Profile'
            document.getElementById('urlOverlay').innerText = 'Profile';
        } else {
            // Capitalize and display the full path, like 'Profile / Basic Details'
            const capitalizedFirstSegment = segments[segments.length - 2].charAt(0).toUpperCase() + segments[segments.length - 2].slice(1);

            // If the last segment has underscores, format it (e.g., "basic_details" -> "Basic Details")
            const formattedText = lastSegment
                .split('_')                // Split by underscores
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))  // Capitalize each word
                .join(' ');                // Join with spaces

            // If the URL has multiple path segments, display the first segment followed by the last formatted segment
            const formattedPath = capitalizedFirstSegment + ' / ' + formattedText;
            document.getElementById('urlOverlay').innerText = formattedPath;
        }
    }
});
</script>

@auth
<style>
@keyframes gradientAnimation {
  0% { background-position: 0% center; }
  50% { background-position: 100% center; }
  100% { background-position: 0% center; }
}
</style>
<p style="text-align: center; background: linear-gradient(to right, #60B5FF, #007BFF); background-size: 200% auto; animation: gradientAnimation 5s linear infinite; color: white; padding: 10px;"> Make it easier for others to find you by completing your profile today!</p>
@endauth

 


@php
    // Routes that are linked in the common user sidebar
    $routesWithSidebarLink = [
        'search.create',
        'view_profile.create',
        'basic_details.index',
        'religious_details.create',
        'family_details.create',
        'astronomy_details.create',
        'educational_details.create',
        'occupation_details.create',
        'contact_details.create',
        'life_partner.create',
        'user_packages.create',
        'profiles.view_interested',
        'profiles.view_favorite',
    ];
@endphp

            <div class="container-fluid my-3">
                <div class="row justify-content-center">
                    {{-- Main content column --}}
                    <div class="col-12 {{ (Auth::check() && request()->routeIs($routesWithSidebarLink)) ? 'col-lg-8' : 'col-lg-12' }}">
                        {{ $slot }}
                    </div>

                    {{-- Sidebar column --}}
                    @auth
                        @if (request()->routeIs($routesWithSidebarLink))
                            <div class="col-lg-1 d-none d-lg-block">
                                <x-common.usersidebar />
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
  

        <!-- Footer Start -->
        
        {{-- <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">                            

                <div class="row g-5 justify-content-center">
                    <div class="col-lg-3 text-start">
                         
                        {!! $footer1->description !!}
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="footer-item">
                            <h4 class="mb-4 text-white">Marath Vivah Mandal, Dombivli</h4>
                            <p class="text-white">Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here 
                            </p>
                             <p>{!! $footer2->description !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 text-end">
                        {!! $footer3->description !!}

                    </div>
                </div>
            </div>
        </div> --}}
       

        <!-- Footer End -->

          <!-- Footer Start -->
          <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-3 text-start">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Quick Links</h4>
                            <a href="/" class="btn-link">Home</a>
                            <a href="/terms-and-conditions" class="btn-link">Terms and Conditions</a>
                            <a href="/privacy-policy" class="btn-link">Privacy Policy</a>
                            <a href="/disclaimer" class="btn-link">Disclaimer</a>
                            {{-- <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="footer-item">
                            <h4 class="mb-4 text-white">Aditya Matrimony</h4>
                            <p class="text-white">Aditya Matrimony is a community-driven platform dedicated to facilitating matrimonial alliances within the community, focusing on cultural heritage and tradition. We offer a personalized, respectful approach to matchmaking, helping individuals and families find compatible life partners.
                            </p>
                            {{-- <div class="btn-link d-flex justify-content-center">
                                <a href="#" class="btn  btn-light btn-light-outline-0 me-2">Register</a>
                                <a href="#" class="btn  btn-light btn-light-outline-0 me-2">Login</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 text-end">
                        <div class="footer-item d-flex flex-column">

                            <h4 class="my-4 text-white">Contact Us</h4>
                            <a href="/contact-us" class="booking-link">
                                <em>&nbsp;</em>
                                Aditya Matrimony, Dombivli
                              </a>
                            <a href="tel:+919320717501" class="btn-link"><em class="fas fa-phone text-secondary me-2">&nbsp;</em>+91 9320717501</a>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.3576948151513!2d73.08635869999999!3d19.223236699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7be1e49e1cd0b%3A0x4665e488ad316e80!2sMaratha%20Mandir%20Hall!5e0!3m2!1sen!2sin!4v1739423879005!5m2!1sen!2sin" width="270" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->

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
                        <span class=>Aditya Matrimony | Developed By <a href="https://sanmisha.com" target="_blank">Sanmisha Technologies</a></span>
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
       
        {{-- <script src="lib/wow/wow.min.js"></script> --}}
        {{-- <script src="lib/easing/easing.min.js"></script> --}}
        {{-- <script src="lib/waypoints/waypoints.min.js"></script> --}}
        {{-- <script src="lib/lightbox/js/lightbox.min.js"></script> --}}

        <script src="{{ asset('assets/user/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('assets/user/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/user/lib/lightbox/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('assets/user/lib/easing/easing.min.js') }}"></script>

        <!-- Template Javascript -->
        {{-- <script src="js/main.js"></script> --}}
        <script src="{{ asset('assets/user/js/main.js') }}"></script>

        <script src="/assets/js/alpine-collaspe.min.js"></script>
        <script src="/assets/js/alpine-persist.min.js"></script>
        <script defer src="/assets/js/alpine-ui.min.js"></script>
        <script defer src="/assets/js/alpine-focus.min.js"></script>
        <script defer src="/assets/js/alpine.min.js"></script>
        <script src="/assets/js/custom.js"></script>

    </body>

<!-- Mobile Sidebar - New Design -->
<div id="mobileSidebar" class="mobile-sidebar">
<style>
        /* Create a fixed-size placeholder for the logo to stabilize the layout */
        .navbar-brand {
            position: relative;
            width: 90px;
            height: 65px; /* Match navbar height to prevent layout shifts */
        }

        /* Position the logo absolutely and center it within the placeholder */
        .logo-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 90px !important;
            width: 90px !important;
        }

        /* Adjust placeholder and logo for larger screens */
        @media (min-width: 992px) {
            .navbar-brand {
                 width: 100px;
            }
            .logo-img {
                height: 100px !important;
                width: 100px !important;
            }
        }
    </style>
    <!-- Sidebar Header -->
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
        <div class="mobile-sidebar-primary-nav" style="background: linear-gradient(to right, #60B5FF, #007BFF);">
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

<script>
    function toggleMobileSidebar() {
        document.getElementById('mobileSidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    // Function to handle logout confirmation from sidebar
    function confirmSidebarLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6', // Standard blue
            cancelButtonColor: '#d33',    // Standard red
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'No, cancel!',
            customClass: {
                popup: 'swal2-popup-zindex' // Ensure SweetAlert is above sidebar overlay
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('sidebar-logout-form').submit();
            }
        });
    }

    // Function to handle logout confirmation from bottom sidebar button
    function confirmBottomSidebarLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'No, cancel!',
            customClass: {
                popup: 'swal2-popup-zindex'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bottom-sidebar-logout-form').submit();
            }
        });
    }

    // Optional: Close sidebar if a non-button link is clicked
    document.querySelectorAll('.mobile-sidebar .sidebar-links a').forEach(link => {
        // Check if it's not a button and not a form submission trigger
        if (!link.classList.contains('btn') && link.getAttribute('onclick') === null && link.closest('form') === null) {
            link.addEventListener('click', (event) => {
                const sidebar = document.getElementById('mobileSidebar');
                if (sidebar.classList.contains('open')) {
                    const href = link.getAttribute('href');
                    // Only toggle if it's a real navigation link, not a JS action or an anchor on the same page
                    if (href && href !== '#' && !href.toLowerCase().startsWith('javascript:') && !href.startsWith('#')) {
                        toggleMobileSidebar();
                    }
                }
            });
        }
    });
</script>
<style>
/* Ensure SweetAlert is above sidebar and overlay */
.swal2-container {
  z-index: 1060 !important;
}
</style>
</html>
