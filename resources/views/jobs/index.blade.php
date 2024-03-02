@extends('layout.master')

@section('title')
    <title>Job Pulse | Jobs</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Owner --}}
    @if ($user->role === 'owner')
        <div class="row">
            <div class="col-md-3 offset-md-6">
                {{-- Search Field  --}}
                <form action="{{ route('jobs.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by title">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                {{-- Sort Dropdown  --}}
                <form action="{{ route('jobs.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <select name="sort" class="form-select">
                            <option value="">Sort by status</option>
                            <option value="active" {{ request('sort') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('sort') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary">Sort</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12 py-2">
                    <span>Sort By Category</span>
                    <div class="mt-2 mb-2 d-flex flex-wrap">
                        @foreach ($jobCategories as $category)
                            <div class="me-3">
                                <a href="{{ route('jobs.index', ['category' => $category]) }}"
                                    class="btn btn-primary d-inline-block fs-12">{{ ucwords($category) }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @foreach ($jobs as $job)
            @include('jobs.deleteModal')
            <div class="row">
                <div class="card mb-3 shadow p-3">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-8">
                            <h4 class="d-inline m-0">{{ ucwords($job->title) }}</h4>
                            <span class="badge bg-success ms-2 fs-6">{{ ucwords($job->location) }}</span>
                            <p class="mt-1 mb-2 fw-semibold">Status : {{ ucwords($job->status) }}</p>
                            <p class="mt-1 mb-2 fw-semibold">Posted On : {{ $job->created_at->format('d-m-y') }}</p>
                            @foreach ($job->skills as $skill)
                                <span class="badge bg-primary fs-6">{{ ucwords($skill) }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('jobs.applicants', ['id' => $job->id]) }}" class="btn btn-info">
                                Applied({{ $job->appliedCount() }})
                            </a>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center gap-2">
                            <div>
                                <a href="{{ route('jobs.show', $job->id) }}" class="d-inline-block">
                                    <i style="font-size: 28px; color:black" class="bx bx-show"></i>
                                </a>
                            </div>
                            <div>
                                <a href="#" class="btn d-inline-block open-modal" data-bs-toggle="modal"
                                    data-bs-target="#deleteJobModal" data-job-id="{{ $job->id }}">
                                    <i class="bx bx-trash" style="font-size: 28px; color: black"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Company --}}
    @if ($user->role === 'company')
        @if ($jobs->isEmpty())
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <span class="text-dark">You haven't posted a job yet.</span>
            </div>
        @else
            @foreach ($jobs as $job)
                @if ($job->company_id == $user->companyDetails->id)
                    @include('jobs.deleteModal')
                    <div class="card mb-3 shadow p-3">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-8">
                                <h4 class="d-inline m-0">{{ ucwords($job->title) }}</h4>
                                <span class="badge bg-success ms-2 fs-6">{{ ucwords($job->location) }}</span>
                                <p class="mt-1 mb-1 fw-semibold">Posted On : {{ $job->created_at->format('d-m-y') }}</p>
                                <p class="mb-2 fw-semibold">Status : {{ ucwords($job->status) }}</p>
                                @foreach ($job->skills as $skill)
                                    <span class="badge bg-primary fs-6">{{ ucwords($skill) }}</span>
                                @endforeach
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('jobs.applicants', ['id' => $job->id]) }}" class="btn btn-info">
                                    Applied({{ $job->appliedCount() }})
                                </a>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center gap-2">
                                <div>
                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn d-inline-block">
                                        <i style="font-size: 28px; color:black" class="bx bx-show"></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="d-inline-block">
                                        <i style="font-size: 28px; color:black" class="bx bx-edit"></i>
                                    </a>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                        data-bs-target="#deleteJobModal">
                                        <i class="bx bx-trash" style="font-size: 28px ; color:black"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">Create Job</a>
    @endif

    {{-- Candidate --}}
    @if ($user->role === 'candidate')
        @if ($jobs->isEmpty())
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <span class="text-dark">You haven't applied on a job yet.</span>
            </div>
        @else
            @foreach ($jobs as $job)
                <div class="row">
                    <div class="card mb-3 shadow p-3">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-10">
                                <h3 class="d-inline m-0">{{ ucwords($job->title) }}</h3>
                                <span class="badge bg-success ms-2 fs-6">
                                    {{ ucwords($job->location) }}
                                </span>
                                <p class="mt-2 mb-2 fw-semibold fs-15">
                                    Status : {{ ucwords($job->pivot->status) }}
                                </p>
                                <p class="mt-2 mb-1 fw-semibold fs-15"> Skills :
                                    @foreach ($job->skills as $skill)
                                        <span class="badge bg-primary fs-6">{{ ucwords($skill) }}</span>
                                    @endforeach
                                </p>
                            </div>

                            <div class="col-md-2 d-flex justify-content-start align-items-center gap-2">
                                <div>
                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info d-inline-block">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endif

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $jobs->appends(request()->query())->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.open-modal').forEach(item => {
                item.addEventListener('click', event => {
                    const jobId = item.getAttribute('data-job-id');
                    document.getElementById('jobIdInput').value = jobId;
                });
            });
        });
    </script>
@endsection
