@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | About Us</title>
@endsection

@section('page-content')
    @if ($aboutContent)
        <section>
            <div class="container-fluid position-relative rounded-bottom mb-3"
                style="background-image: url('{{ asset('pages/' . $aboutContent->img_url) }}'); background-size: cover; background-position: top center; background-repeat: no-repeat; width: 100%; height: 500px;">

                {{-- Overlay --}}
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50 rounded-bottom"></div>

                {{-- Content --}}
                <div class="row position-relative z-index-1">
                    <div class="col-md-12 ms-5 w-50">
                        <h3 class="text-white fs-1 mb-0" style="margin-top: 4rem">{{ $aboutContent->title }}</h3>
                        <p class="text-white fs-16 mt-3">{{ $aboutContent->description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <h2>Company History</h2>
                        <p>{{ $aboutContent->history }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <h2>Our Vision</h2>
                        <p>{{ $aboutContent->vision }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section>
        @if ($topCompanies)
            <div class="container">
                <div class="row">
                    <h2 class="text-center my-4">Companies Belive In Us</h2>
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
@endsection
