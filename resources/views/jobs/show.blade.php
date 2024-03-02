@extends('layout.master')

@section('title')
    <title>Job Pulse | Job Details</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2 card shadow-lg px-5 py-4">
            <div class="mb-3">
                <h5>Title</h5>
                <p class="m-0 fs-14">{{ $job->title }}</p>

            </div>
            <div class="mb-3">
                <h5>Category</h5>
                <p class="m-0 fs-14">{{ ucwords($job->category) }}</p>
            </div>
            <div class="mb-3">
                <h5>Description</h5>
                <p class="m-0 fs-14">{{ $job->description }}</p>
            </div>
            <div class="mb-3">
                <h5>Skills</h5>
                @foreach ($job->skills as $skill)
                    @if (is_string($skill))
                        <p class="badge bg-info mb-0 me-1 fs-14">{{ ucwords($skill) }}</p>
                    @endif
                @endforeach
            </div>
            <div class="mb-3">
                <h5>Salary</h5>
                <p class="m-0 fs-14">{{ $job->salary }}</p>
            </div>
            <div class="mb-3">
                <h5>Location</h5>
                <p class="m-0 badge bg-success fs-14">{{ ucwords($job->location) }}</p>
            </div>
            <div class="mb-3">
                <h5>Deadline</h5>
                <p class="m-0 fs-14">{{ (new DateTime($job->deadline))->format('d-m-Y') }}</p>
            </div>

            @if ($user->role === 'owner')
                <form action="{{ route('jobs.updateStatus') }}" method="POST">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" style="width: 15rem">
                            <option value="active" {{ $job->status == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ $job->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            @endif
        </div>
    </div>
@endsection
