@extends('layout.master')

@section('title')
    <title>Job Pulse | Companies</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="text-center m-0">{{ session('success') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Search Field  --}}
        <div class="col-md-3 offset-md-6">
            <form action="{{ route('companies.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        {{-- Sort Dropdown  --}}
        <div class="col-md-3">
            <form action="{{ route('companies.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <select name="sort" class="form-select">
                        <option value="">Sort by status</option>
                        <option value="active" {{ request('sort') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('sort') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Sort</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Company Cards  --}}
    <div class="row">
        @foreach ($companies as $company)
            {{-- Confirmation Modal --}}
            <div class="col-md-12">
                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this company?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form id="deleteForm" action="{{ route('company.destroy', $company->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Confirmation Modal --}}

                <div class="card mb-3 shadow p-3">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <img class="rounded" src="{{ asset('uploads/' . $company->img_url) }}"
                                style="width: 150px; height:100px;" alt="{{ $company->name }}">
                        </div>
                        <div class="col-md-5">
                            <h5 class="card-title">{{ ucwords($company->name) }}</h5>
                            <p class="card-text fw-semibold">Status: {{ ucwords($company->status) }}</p>
                        </div>
                        <div class="col-md-5 d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('company.show', $company->id) }}" class="btn btn-primary">View</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmationModal">Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination Links --}}
        <div class="mt-3">
            {{ $companies->links() }}
        </div>
    </div>
@endsection
