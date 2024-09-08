@extends('layout.master')

@section('title')
    <title>Job Pulse | Blogs</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    <div class="row">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                @csrf
                <div class="preview ratio ratio-16x9 mb-4">
                    <img id="featuredImageDisplay" class="my-3 d-block rounded img-fluid"
                        src="{{ asset('blogs/' . ($blog->img_url ?? 'assets/images/dummy_placeholder.png')) }}"
                        alt="Blog Image">
                </div>
                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" class="form-control" name="img" id="featuredImage">
                    @error('img')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title"
                        value="{{ old('title', $blog->title ?? '') }}">
                    @error('title')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Tags (add tags by comma )</label>
                    <input type="text" class="form-control" name="tags"
                        value="{{ old('skills', implode(', ', $blog->tags ?? [])) }}">
                    @error('tags')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label class="form-label">
                        Description (press Enter to add a line break )
                    </label>
                    <textarea type="text" class="form-control" rows="10" name="description">{{ old('description', $blog->description ?? '') }}</textarea>
                    @error('description')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Blog</button>
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
