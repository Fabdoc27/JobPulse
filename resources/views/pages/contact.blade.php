@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | Contact Us</title>
@endsection

@push('custom_css')
    <style>
        .custom-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255,
                    255,
                    255,
                    0.7);
            z-index: 9999;
            display: none;
        }

        .loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .loader-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
@endpush

@section('page-content')
    {{-- Preloader --}}
    <div id="customLoader" class="custom-loader">
        <div class="loader-overlay"></div>
        <div class="loader-content">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <section>
        @if ($contactContent)
            <div class="container-fluid position-relative rounded-bottom mb-3"
                style="background-image: url('{{ asset('pages/' . $contactContent->img_url) }}'); background-size: cover; background-position: top center; background-repeat: no-repeat; width: 100%; height: 500px; margin-bottom: 0.8rem;">

                {{-- Overlay --}}
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50 rounded-bottom"></div>

                {{-- Content --}}
                <div class="row position-relative z-index-1">
                    <div class="col-md-12 ms-5 w-50">
                        <h3 class="text-white fs-1 mb-0" style="margin-top: 4rem">{{ $contactContent->title }}</h3>
                        <p class="text-white fs-16 mt-3">{{ $contactContent->description }}</p>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <section>
        <div class="container py-5">
            <div class="row">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="text-center m-0">{{ session('error') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="text-center m-0">{{ session('success') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-6">
                    <div class="card w-75 shadow">
                        <div class="card-body">
                            <h3 class="card-title fst-italic mb-3">Contact Info</h3>
                            <p class="card-text fs-15 fw-medium">Address : 23, Kazi Nazrul Islam Ave, Dhaka </p>
                            <p class="card-text fs-15 fw-medium">Phone : 01 234 56789</p>
                            <p class="card-text fs-15 fw-medium">Email : jobpulse@info.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-3 shadow-lg p-3">
                        <div class="card-body">
                            <h3 class="card-title fst-italic mb-3">Get In Touch</h3>
                            <form id="contactForm" action="{{ route('visitor.mail') }}" method="POST">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="form-floating border border-dark-subtle border-1 rounded  mb-3">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter your name">
                                        <label>Your Name</label>
                                    </div>
                                    <div class="form-floating border border-dark-subtle border-1 rounded  mb-3">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter your email">
                                        <label>Email Address</label>
                                    </div>
                                    <div class="form-floating border rounded border-dark-subtle border-1 mb-3">
                                        <input type="text" name="subject" class="form-control"
                                            placeholder="Enter your subject">
                                        <label>Subject</label>
                                    </div>
                                    <div class="form-floating border border-dark-subtle border-1 rounded mb-3">
                                        <textarea class="form-control" name="message" placeholder="Enter your message" style="height: 120px"></textarea>
                                        <label>Message</label>
                                    </div>
                                </div>
                                <button type="submit" class="d-block w-25 mx-auto btn btn-info">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        @if ($topCompanies)
            <div class="container">
                <div class="row">
                    <h2 class="text-center mb-4">Companies Belive In Us</h2>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            @foreach ($topCompanies as $company)
                                <div class="mx-3 d-flex align-items-center">
                                    @if ($company->img_url)
                                        <img class="rounded object-fit-cover"
                                            src="{{ asset('uploads/' . $company->img_url) }}"
                                            style="height:150px; width:250px;" alt="{{ $company->name }}">
                                    @else
                                        <img class="rounded object-fit-cover"
                                            src="{{ asset('assets/images/dummyLogo.png') }}"
                                            style="height:150px; width:250px;" alt="Placeholder Image">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <script>
        function showCustomLoader() {
            document.getElementById('customLoader').style.display = 'block';
        }

        function hideCustomLoader() {
            document.getElementById('customLoader').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('contactForm').addEventListener('submit', function() {
                showCustomLoader();
            });
        });
    </script>
@endsection
