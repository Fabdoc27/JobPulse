@extends('layout.master')

@section('title')
    <title>Job Pulse | Dashboard</title>
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
    @if ($user->role === 'owner')
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4>Active Companies</h4>
                        <h2>{{ $data['activeCompanies'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4>Inctive Companies</h4>
                        <h2>{{ $data['inactiveCompanies'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4>Total Jobs Posted</h4>
                        <h2>{{ $data['totalJobs'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($user->role === 'company')
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4>Jobs Posted</h4>
                        <h2>{{ $data['jobsPosted'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($user->role === 'candidate')
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4>Jobs Applied</h4>
                        <h2>{{ $data['jobsApplied'] }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
