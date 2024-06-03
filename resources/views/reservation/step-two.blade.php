
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Flash Coffee - Reservation</title>

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

   


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets/images/klassy-logo.png') }}" alt="Klassy Cafe HTML Template">

                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>
                            <li class="scroll-to-section"><a href="{{ route('categories.index') }}">Category</a></li>
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

    <div class="flex min-h-screen items-center bg-gray-50">
        <div class="mx-auto h-full max-w-4xl flex-1 rounded-lg bg-white shadow-xl">
          <div class="flex flex-col md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
              <img class="h-full w-full object-cover" src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790__340.jpg" alt="Image" />
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
              <div class="w-full">
                <h3 class="mb-4 text-xl font-bold text-blue-600">Make Reservation</h3>
                <div class="w-full rounded-full bg-gray-200">
                  <div class="w-100 p-1 text-center text-xs font-medium leading-none text-blue-100 bg-blue-600 rounded-full">
                    Step 2</div>
                </div>
                <form method="POST" action="{{ route('reservation.store.step.two') }}">
                  @csrf
                  
                  <div class="sm:col-span-6">
                      <label for="table_id" class="block text-sm font-medium text-gray-700"> Table </label>
                      <div class="mt-1">
                          <select id="table_id" name="table_id" 
                          class="form-multiselect block w-full mt-1 @error('table_id') border-red-500 @enderror">
                              @foreach ($tables as $table)
                                  <option value="{{ $table->id }}"@selected($table->id == $reservation->table_id)>
                                    {{ $table->name }} 
                                    ({{$table->guest_number}} Guests)</option>
                              @endforeach
                          </select>
                          @error('table_id')
                              <div class="text-red-500">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="d-flex justify-content-center">
                    <a href="{{ route('reservation.step.one') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white mr-4 text-center">Previous</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white text-center">Make Reservation</button>
                </div>
                
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>


                  
      

    <!-- ***** Footer Start ***** -->
    <footer class="footer mt-6">
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
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/white-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Copyright Klassy Cafe Co.
                            <br>Design: TemplateMo
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer End ***** -->

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

