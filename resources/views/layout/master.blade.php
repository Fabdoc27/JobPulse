<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    @yield('title')
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Md Ashraful Karim" name="author" />

    {{-- App favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    {{-- Bootstrap Css --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Icons Css --}}
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- App Css --}}
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- Custom Css --}}
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    {{-- page wrapper start --}}
    <div id="layout-wrapper">

        @include('components.header')
        @yield('sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col p-3">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('components.footer')
    </div>

    {{-- libs --}}
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    {{-- Layout config Js --}}
    <script src="{{ asset('assets/js/layout.js') }}"></script>

    {{-- apexcharts --}}
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    {{-- Vector map --}}
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    {{-- Swiper slider js --}}
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    {{-- Dashboard init  --}}
    <script src="{{ asset('assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    {{-- App js  --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
