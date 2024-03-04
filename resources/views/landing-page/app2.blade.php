<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }}</title>

     <!-- General CSS Files -->
     <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
         integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/components.css">

    @stack('customStyle')

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body class="layout-2">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="{{ asset('assets/img/landing-page/logo-2.png') }}" style="height: 35px;"
                            alt="">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active mr-4">
                                <a class="nav-link text-primary" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary mr-4" href="{{ url('/all-jobs') }}">Lowongan
                                    Pekerjaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary mr-4" href="{{ url('/contact') }}">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="{{ url('/list-about') }}">About Us</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @if (!auth()->user())
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary text-primary mr-2"
                                    href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-warning text-white"
                                    href="{{ route('register') }}">Daftar</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user text-primary">
                                    @if (Auth::user()->profile && Auth::user()->profile->foto != '')
                                        <img alt="image"
                                            src="{{ Storage::url(Auth::user()->profile->foto) }}"
                                            class="rounded-circle mr-1" style="width: 35px; height: 35px;">
                                    @else
                                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                            class="rounded-circle mr-1" style="width: 35px; height: 35px;">
                                    @endif
                                    <div class="d-sm-none d-lg-inline-block">
                                        Hai, {{ auth()->user()->name }}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                                        <i class="far fa-user"></i> Profile
                                    </a>
                                    @if (auth()->user()->hasRole('Pencari Kerja'))
                                    <a href="{{ route('bookmark.index') }}" class="dropdown-item has-icon">
                                        <i class="far fa-bookmark"></i> Bookmark
                                    </a>
                                    @endif
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="dropdown-item has-icon text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            {{-- <footer class="main-footer">
                @include('landing-page.footer2')
            </footer> --}}
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KyZXEAg3QhqLMpG8r+Y9w1R0Za8W60MTLPSw8vm+COA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw6f+ua5q4PaEhL8r+paN1fhb/6IqE6HfY0NlgP9cfw5a/c8b9TI5+9xSTBQ5" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/js/page/modules-sweetalert.js"></script>

    <!-- Template JS Files -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        // Inisialisasi dropdown
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            // Additional styling using script
            $('.dropdown-username').css('font-weight', 'bold');
            $('.dropdown-menu .dropdown-item').hover(function() {
                $(this).css('background-color', '#f8f9fa').css('color', '#007bff');
            }, function() {
                $(this).css('background-color', '').css('color', '');
            });
        });
    </script>
    @stack('customScript')
</body>

</html>
