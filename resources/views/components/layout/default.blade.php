<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Aditya Matrimony</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <link rel="icon" href="{{asset('assets/user/img/favicon.png')}}">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;500;600&family=Petit+Formal+Script&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        {{-- <link href="lib/animate/animate.min.css" rel="stylesheet"> --}}
         {{-- <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> --}}
        <link href="{{ asset('assets/user/lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/user/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

       

        <!-- Customized Bootstrap Stylesheet -->
        {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}
        <link href="{{ asset('assets/user/css/bootstrap.min.css') }}" rel="stylesheet">


        <!-- Template Stylesheet -->
        {{-- <link href="css/style.css" rel="stylesheet"> --}}
        <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet">

    </head>

    <body data-bs-spy="scroll" data-bs-target="#navBar" id="weddingHome">

        <!-- Navbar start -->
        <div class="container-fluid sticky-top px-0">
            <div class="container-fluid">
                <div class="container px-0">
                    <nav class="navbar navbar-light navbar-expand-xl" id="navBar">
                        <a href="#" class="navbar-brand">
                            <img src="{{asset('assets/user/img/logo.png')}}" class="img-fluid" style="height: 90px;">
                        </a>
                        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="fa fa-bars text-primary"></span>
                        </button>
                        <div class="collapse navbar-collapse py-3" id="navbarCollapse">
                            <div class="navbar-nav mx-auto border-top">
                                <a href="#" class="nav-item nav-link active">Hasdasome</a>
                                <a href="#" class="nav-item nav-link">asd</a>
                                <a href="#" class="nav-item nav-link">Success Stories</a>
                                <a href="#" class="nav-item nav-link">Contact Us</a>
                                
                            </div>
                            @auth
                            <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                                <a href="{{ route('profiles.update_password') }}" class="btn btn-sm btn-primary py-1 px-3 ms-3 text-white">
                                    Update Password
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                            <button type="submit" class="btn btn-primary btn-primary-outline-0 py-2 px-4 ms-4">Logout</button>
                        </form>
                            @else
                                <a href="{{route('register')}}" class="btn btn-primary btn-primary-outline-0 py-2 px-4 ms-4">Register</a>
                                <a href="{{route('login')}}" class="btn btn-primary btn-primary-outline-0 py-2 px-4 ms-4">Login</a>
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
                        <img src="{{asset('assets/user/img/carousel-1.jpg')}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption myslider">
                            <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
                                <div class="d-inline-block border-end-0 border-start-0 border-secondary p-2 mb-3" style="border-style: double;">
                                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Text will come here </p>
                                </div>
                                <h1 class="display-1 text-capitalize text-white mb-3">Aditya <em class="fa fa-heart text-primary">&nbsp;</em>Matrimony</h1>
                                <div class="d-inline-block border-end-0 border-start-0 border-secondary p-2 mb-3" style="border-style: double;">
                                    <p class="myp h4 text-white  fw-bold mb-0" style="letter-spacing: 3px;">Text will come  here</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn btn-primary btn-primary-outline-0 py-md-3 px-5 py-1 px-2" href="#">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item myslider">
                        <img src="{{asset('assets/user/img/carousel-2.jpg')}}" class="img-fluid" alt="Image">
                        <div class="carousel-caption myslider">
                            <div class="p-3 mx-auto animated zoomIn" style="max-width: 900px;">
                                <div class="d-inline-block border-end-0 border-start-0 border-secondary p-2 mb-3" style="border-style: double;">
                                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Text will come here </p>
                                </div>
                                <h2 class="display-1 text-capitalize text-white mb-3">Aditya Matrimony</h2>
                                <div class="d-inline-block border-end-0 border-start-0 border-secondary p-2 mb-3" style="border-style: double;">
                                    <p class="myp h4 text-white fw-bold mb-0" style="letter-spacing: 3px;">Dombivli </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn btn-primary btn-primary-outline-0  py-md-3 px-5 py-1 px-2" href="#">Login</a>
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

          {{-- here --}}
          {{-- {{ $slot }} --}}
          <div class="container">
            <!-- Yield the sidebar here -->
            @yield('sidebar')
    
            <!-- Yield the main content here -->
            @yield('content')
        </div>

       

        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-3 text-start">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Quick Links</h4>
                            <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a>
                            <a href="#" class="btn-link"> Link Name</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="footer-item">
                            <h4 class="mb-4 text-white">Marath Vivah Mandal, Dombivli</h4>
                            <p class="text-white">Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here Text will come here 
                            </p>
                            @auth
                            <div class="btn-link d-flex justify-content-center">
                                <a href="{{route('logout')}}" class="btn  btn-light btn-light-outline-0 me-2">Logosadut</a>
                            @else
                                <a href="{{route('register')}}" class="btn  btn-light btn-light-outline-0 me-2">  Register</a>
                                <a href="{{route('login')}}" class="btn  btn-light btn-light-outline-0 me-2">  Login</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                    <div class="col-lg-3 text-end">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Follow Us</h4>
                            <a href="#" class="btn-link"> Faceboock</a>
                            <a href="#" class="btn-link"> Instagram</a>
                            <h4 class="my-4 text-white">Contact Us</h4>
                            <a href="#" class="btn-link"><em class="fas fa-envelope text-secondary me-2">&nbsp;</em> info@eabc.com</a>
                            <a href="#" class="btn-link"><em class="fas fa-phone text-secondary me-2">&nbsp;</em>+91 12345 67890</a>
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
                        <span class="text-light">Aditya Matrimony
                        | Developed By <a href="https://sanmisha.com" target="_blank">Sanmisha Technologies</a></span>
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

    </body>

</html>