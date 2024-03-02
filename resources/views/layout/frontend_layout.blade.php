<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('page-title')
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('custom_css')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a href="{{ route('homepage') }}" class="fs-3 fst-italic py-3 d-inline-block">
                    <span class="fw-bold w-100 px-2"
                        style=" background: linear-gradient(to right, #ff0057, #8a3ab9);
                        -webkit-background-clip: text;
                    background-clip: text;
                    color: transparent;
                    ">
                        Job Pulse
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-16">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" aria-current="page" href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" aria-current="page" href="{{ route('about') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" aria-current="page" href="{{ route('jobs') }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" aria-current="page" href="{{ route('blogs') }}">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" aria-current="page"
                                href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-center align-items-center">
                    @auth
                        <div class="d-flex">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary d-inline-block ms-2">Dashboard</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary d-inline-block ms-2">Logout</button>
                            </form>
                        </div>
                    @endauth
                    @guest
                        <div>
                            <a href="{{ route('candidate.login') }}" class="btn btn-primary d-inline-block ms-2">Login</a>
                            <a href="{{ route('candidate.register') }}"
                                class="btn btn-primary d-inline-block ms-2">Register</a>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    @yield('page-content')

    <footer>
        <p class="text-center py-5 fs-16 bg-light">© {{ date('Y') }} Job Pulse | All rights reserved | Designed &
            Developed
            by
            Ashraful Karim</p>
    </footer>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </script>
</body>

</html>
