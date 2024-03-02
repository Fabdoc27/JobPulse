@extends('layout.master')

@section('title')
    <title>Job Pulse | Update Job</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        <input type="hidden" name="company_id" value="{{ $user->companyDetails->id }}">

        <div class="row d-flex justify-content-center ">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $job->title ?? '') }}">
                    @error('title')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category">
                        @foreach ($jobCategories as $category)
                            <option value="{{ $category }}"
                                {{ old('category', $job->category ?? '') == $category ? 'selected' : '' }}>
                                {{ ucwords($category) }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <select class="form-select" name="location">
                        @foreach (['on-site', 'remote'] as $location)
                            <option value="{{ $location }}"
                                {{ old('location', $job->location ?? '') == $location ? 'selected' : '' }}>
                                {{ ucwords($location) }}
                            </option>
                        @endforeach
                    </select>
                    @error('location')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control " value="{{ ucwords($job->status ?? '') }}" disabled
                        readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Skills (add skills by comma )</label>
                    <input type="text" class="form-control" name="skills"
                        value="{{ old('skills', implode(', ', $job->skills ?? [])) }}">
                    @error('skills')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Salary</label>
                    <input type="number" class="form-control" name="salary"
                        value="{{ old('salary', $job->salary ?? '') }}">
                    @error('salary')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" class="form-control" name="deadline"
                        value="{{ old('deadline', $job->deadline ?? '') }}">
                    @error('deadline')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" class="form-control" rows="6" name="description">{{ old('description', $job->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
@endsection
