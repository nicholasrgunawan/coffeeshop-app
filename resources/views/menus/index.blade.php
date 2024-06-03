<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Flash Coffee - Menus</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-klassy-cafe.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
     <!-- ***** Header Area Start ***** -->
     <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <div class="d-flex mt-3"> <!-- Add mt-3 class for margin-top -->
                                <img src="assets/images/logo.png" class="w-50" alt="Logo">
                            </div>
                            
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                        <li class="scroll-to-section"><a href="#about">About</a></li>
                        <li class="scroll-to-section"><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li class="scroll-to-section"><a href="{{ route('menus.index') }}">Menu</a></li>
                        <li class="scroll-to-section"><a href="{{ route('reservation.step.one') }}">Make
                                Reservation</a></li> 
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Content Start ***** -->
    <section class="section" id="offers">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Flash Week</h6>
                        <h2>This Week’s Special Offers</h2>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
                
                    @foreach ($menus as $menu)
                        <div class="col-lg-3 mb-5">
                            <div class="max-w-xs mx-auto mb-2 rounded-lg shadow-lg"
                                 style="height: 400px; display: flex; flex-direction: column; justify-content: center;">
                                <img class="object-cover object-center" src="{{ Storage::url($menu->image) }}"
                                     alt="Menu Image">
                                <div class="px-6 py-4 text-center">
                                    <h4 class="text-xl font-semibold text-black hover:text-red-500">
                                        {{ $menu->name }}
                                    </h4>
                                    <p class="leading-normal text-gray-700 py-1">{{ $menu->description }}</p>
                                    <span class="text-lg text-green-600 font-bold">${{ $menu->price }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </section>    
    
    
    <!-- ***** Main Content End ***** -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                            <ul class="social-icons">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/logo.png" alt=""></a>
                    </div>
                </div> --}}
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© 2022 FLASH COFFEE - ALL RIGHTS RESERVED</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
