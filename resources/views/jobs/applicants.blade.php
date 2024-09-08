@extends('layout.master')

@section('title')
    <title>Job Pulse | Applicants</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <h3 class="mb-3 ms-1">Applicants for {{ $job->title }}</h3>

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

    @foreach ($applicants as $applicant)
        <div class="card mb-3 shadow p-3">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-8">
                    <h3 class="fs-20">{{ ucwords($applicant->name) }}</h3>

                    <p class="mt-1 mb-2 fw-semibold">Status : {{ ucwords($applicant->pivot->status) }}</p>
                    <p class="mt-1 mb-2 fw-semibold">Apply Date: {{ $applicant->pivot->created_at->format('d-m-y') }}</p>
                    <p class="mt-1 mb-2 fw-semibold">Skills :
                        @foreach ($applicant->skills as $skill)
                            <span class="badge bg-primary fs-6">{{ ucwords($skill) }}</span>
                        @endforeach
                    </p>
                </div>
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <button class="btn btn-secondary me-2" data-bs-toggle="modal"
                        data-bs-target="#previewModal{{ $applicant->id }}">
                        Details
                    </button>
                    <form action="{{ route('job.selection') }}" method="POST">
                        @csrf
                        <input type="hidden" name="candidate_id" value="{{ $applicant->id }}">
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        @if ($user->role === 'company')
                            @if ($applicant->pivot->status == 'applied')
                                <button type="submit" name="select" class="btn btn-success me-1">
                                    Select
                                </button>
                                <button type="submit" name="reject" class="btn btn-danger">
                                    Reject
                                </button>
                            @elseif ($applicant->pivot->status == 'selected')
                                <button type="button" class="btn btn-outline-success">
                                    Selected
                                </button>
                            @elseif ($applicant->pivot->status == 'rejected')
                                <button type="button" class="btn btn-outline-danger">
                                    Rejected
                                </button>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- Candidate Modal --}}
        <div class="modal fade" id="previewModal{{ $applicant->id }}" tabindex="-1" aria-labelledby="previewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="previewModalLabel">Preview Profile</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <img src="{{ $applicant->img_url ? asset('uploads/' . $applicant->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                        class="rounded" style="max-width: 150px" alt="candidate_image">
                                </div>
                                <div class="mb-3">
                                    <h6>Name</h6>
                                    <p>{{ $applicant->name ?? '' }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6>Email</h6>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6>Phone</h6>
                                    <p>{{ $applicant->phone ?? '' }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6>Address</h6>
                                    <p>{{ $applicant->address ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="mt-3">Education History</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Degree</th>
                                        <th>Institution</th>
                                        <th>Score</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->educationHistories ?? [] as $educationHistory)
                                        <tr>
                                            <td>{{ $educationHistory->degree ?? '' }}</td>
                                            <td>{{ $educationHistory->institution ?? '' }}</td>
                                            <td>{{ $educationHistory->score ?? '' }}</td>
                                            <td>{{ $educationHistory->start_date ?? '' }}</td>
                                            <td>{{ $educationHistory->end_date ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mt-3">Work Experience</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicant->workExperiences ?? [] as $workExperience)
                                        <tr>
                                            <td>{{ $workExperience->job_title ?? '' }}</td>
                                            <td>{{ $workExperience->company ?? '' }}</td>
                                            <td>{{ $workExperience->start_date ?? '' }}</td>
                                            <td>{{ $workExperience->end_date ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h6 class="mt-3">Skills</h6>
                        <div class="mb-3">
                            @foreach ($applicant->skills ?? [] as $skill)
                                <span class="badge bg-primary fs-12 me-1">{{ ucwords($skill) }}</span>
                            @endforeach
                        </div>

                        <div class="d-flex gap-5">
                            <div class="mb-3">
                                <h6>Current Salary</h6>
                                <p>{{ $applicant->current_salary ?? '' }}</p>
                            </div>

                            <div class="mb-3">
                                <h6>Expected Salary</h6>
                                <p>{{ $applicant->expected_salary ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center ">
                        <button type="button" class="btn btn-primary w-25" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Candidate Modal --}}
    @endforeach
    <div class="mt-3">
        {{ $applicants->links() }}
    </div>
@endsection
