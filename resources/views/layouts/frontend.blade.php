<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dropdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- style  responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
</head>

<body>
    <header>
        <div class="container">
            <a href="/" class="main-logo"><img src="{{ asset('assets/images/main-logo.png') }}"></a>
            <div id="nav-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="mobile-menu width100">
                <div id="nav-icon" class="close-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/about') ? 'active' : '' }}" href="#about">About</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/contact') ? 'active' : '' }}" href="#contact">Contact</a>
                        </li>
                    </ul>
                </nav>
                @auth
                <div class="header-btn profile-wrp">
                    <span class="user-box">
                        <span class="user-wpr">
                            <span class="user-icon">
                                <img src="{{ asset('assets/images/user-icon.svg') }}" alt="user-icon">
                            </span>
                            <span class="user-name">{{Auth::user()->firstname . ' ' . Auth::user()->lastname}}</span>
                            <span class="user-arrow"><img src="{{ asset('assets/images/user-arrow.svg') }}"
                                    alt="user-arrow"></span>
                        </span>
                        <ul class="profile">
                            <li><a href="/lms">LMS</a></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </span>
                </div>
                @endauth
                @guest
                <div class="header-btn">
                    <a href="/register" class="btn-primary bgclr-wit textclr-green border2">Register for a TB course</a>
                    <a href="/login" class="btn-secondary bgclr-green textclr-wit">Login</a>
                </div>
                @endguest
            </div>
        </div>
    </header>

    @yield('content')
    <footer>
        <div class="container flex flex-justify-between flex-items-center">
            <div class="footer-logo">
                <a href="index.php" class="main-logo"><img src="{{ asset('assets/images/main-logo.png') }}"></a>
                <a href="index.php"><img src="{{ asset('assets/images/together-logo.png') }}"></a>
            </div>
            <div class="footer-bottom">
                <p>© 2020 Copyright National Tuberculosis Control Programme – Pakistan.</p>
                <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.dropdown.js') }}"></script>
    </footer>
</body>

</html>