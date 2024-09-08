@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | Jobs</title>
@endsection

@section('page-content')
    <section>
        @if ($jobContent)
            <div class="container-fluid position-relative rounded-bottom"
                style="background-image: url('{{ asset('pages/' . $jobContent->img_url) }}'); background-size: cover; background-position: top center; background-repeat: no-repeat; width: 100%; height: 500px;">

                {{-- Overlay --}}
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50 rounded-bottom"></div>

                {{-- Content --}}
                <div class="row position-relative z-index-1">
                    <div class="col-md-12 ms-5 w-50">
                        <h3 class="text-white fs-1 mb-0" style="margin-top: 4rem">{{ $jobContent->title }}</h3>
                        <p class="text-white fs-16 mt-3">{{ $jobContent->description }}</p>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <section>
        <div class="container">
            <div class="row g-0 d-flex justify-content-between align-items-center">
                <h3 class="text-center my-4">All Jobs</h3>
                <div class="col-md-9 py-2 ">
                    <div class="mt-2 mb-2 d-flex flex-wrap">
                        @foreach ($jobCategories as $category)
                            <div>
                                <a href="{{ route('jobs', ['category' => $category]) }}"
                                    class="btn btn-primary d-inline-block fs-12 me-3">{{ ucwords($category) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- Search Field  --}}
                <div class="col-md-3">
                    <form action="{{ route('jobs') }}" method="GET">
                        <div class="input-group border border-dark-subtle border-1 rounded">
                            <input type="text" name="search" class="form-control" placeholder="Search by Title...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($jobs->isNotEmpty())
                @foreach ($jobs as $job)
                    <div class="card mb-3 shadow p-3">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-8">
                                <h4 class="d-inline m-0">{{ ucwords($job->title) }}</h4>
                                <span class="badge bg-success ms-2 fs-6">{{ ucwords($job->location) }}</span>
                                <p class="mt-1 mb-1 fw-semibold">Comapny : {{ ucwords($job->company->name) }}</p>
                                <p class="mt-1 mb-2 fw-semibold">Posted On : {{ $job->created_at->format('d-m-y') }}</p>
                                @foreach ($job->skills as $skill)
                                    <span class="badge bg-primary fs-6">{{ ucwords($skill) }}</span>
                                @endforeach
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center gap-2">
                                <div>
                                    <a href="{{ route('jobs.details', $job) }}" class="d-inline-block btn btn-info">
                                        View
                                    </a>
                                </div>
                                <div>
                                    <p class="text-center btn btn-secondary m-0">
                                        ৳ {{ $job->salary }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Pagination Links --}}
            <div class="mt-3">
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection
