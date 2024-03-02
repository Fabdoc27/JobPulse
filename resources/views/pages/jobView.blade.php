@extends('layout.frontend_layout')

@section('page-title')
    <title>Job Pulse | Home</title>
@endsection

@section('page-content')
    <section>
        <div class="container pb-3">
            <div class="row py-4">
                <h3 class="text-center mb-4">Job Details</h3>

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
                    <div class="mb-3">
                        <h4 class="fst-italic">Title</h4>
                        <p class="m-0 fs-14">{{ $job->title }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Category</h4>
                        <p class="m-0 fs-14">{{ ucwords($job->category) }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Company</h4>
                        <p class="m-0 fs-14">{{ $job->company->name }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Posted On :</h4>
                        <p class="m-0 fs-14">{{ $job->created_at->format('d-m-y') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <h4 class="fst-italic">Salary</h4>
                        <p class="m-0 fs-14">{{ $job->salary }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Skills</h4>
                        @foreach ($job->skills as $skill)
                            @if (is_string($skill))
                                <p class="badge bg-info mb-0 me-1 fs-14">{{ ucwords($skill) }}</p>
                            @endif
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Location</h4>
                        <p class="m-0 badge bg-success fs-14">{{ ucwords($job->location) }}</p>
                    </div>

                    <div class="mb-3">
                        <h4 class="fst-italic">Deadline</h4>
                        <p class="m-0 fs-14">{{ (new DateTime($job->deadline))->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <h4 class="fst-italic">Description</h4>
                        <p class="m-0 fs-14">{{ $job->description }}</p>
                    </div>
                </div>
            </div>

            @if ($isApplied)
                <button class="btn btn-success" disabled>Applied</button>
            @else
                <form action="{{ route('job.apply') }}" method="POST">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <button type="submit" class="btn btn-primary">Apply Now</button>
                </form>
            @endif
        </div>
    </section>
@endsection
