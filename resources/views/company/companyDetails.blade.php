@extends('layout.master')

@section('title')
    <title>Job Pulse | Company Details</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p class="text-center m-0">{{ session('success') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow px-5 py-3">
                @if ($company->img_url)
                    <img src="{{ asset('uploads/' . $company->img_url) }}" style="max-width: 100px" alt="Company Image"
                        class="mb-3">
                @else
                    <img src="{{ asset('assets/images/users/user-dummy-img.jpg') }}" style="max-width: 100px"
                        alt="Default Image" class="mb-3">
                @endif

                <p>Name: {{ $company->name ? $company->name : '' }}</p>
                <p>Email: {{ $company->email ? $company->email : '' }}</p>
                <p>Status: {{ $company->status ? $company->status : '' }}</p>
                <p>Phone: {{ $company->phone ? $company->phone : '' }}</p>
                <p>Address: {{ $company->address ? $company->address : '' }}</p>

                <form action="{{ route('company.status', $company->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="statusDropdown" class="form-label">Change Status</label>
                        <select class="form-select" id="statusDropdown" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
@endsection
