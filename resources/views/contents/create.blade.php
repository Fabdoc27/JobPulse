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
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <form action="{{ route('page.store') }}" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                @csrf
                <input type="hidden" name="page_name" value="{{ $page }}">

                <div class="preview ratio ratio-16x9 mb-4">
                    <img id="featuredImageDisplay" class="my-3 d-block rounded img-fluid"
                        src="{{ $pageContent->img_url ?? asset('assets/images/dummy_placeholder.png') }}"
                        alt="Banner Image">
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" class="form-control" name="img" id="featuredImage">
                    @error('img')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title"
                        value="{{ old('title', $pageContent->title ?? '') }}">
                    @error('title')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" class="form-control" rows="6" name="description">{{ old('description', $pageContent->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @if ($page === 'about')
                    <div class="mb-3">
                        <label class="form-label">Company History</label>
                        <textarea type="text" class="form-control" rows="6" name="history">{{ old('history', $pageContent->history ?? '') }}</textarea>
                        @error('history')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Our Vision</label>
                        <textarea type="text" class="form-control" rows="6" name="vision">{{ old('vision', $pageContent->vision ?? '') }}</textarea>
                        @error('vision')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <script>
        document.getElementById("featuredImage").addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                document.querySelector("#featuredImageDisplay").src = reader.result;
                featuredImageDisplay.classList.remove("hidden");
            });
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
