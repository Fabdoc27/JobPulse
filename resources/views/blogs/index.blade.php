@extends('layout.master')

@section('title')
    <title>Job Pulse | Blogs</title>
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

    @if ($blogs->isEmpty())
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <span class="text-dark">You haven't posted a Blog yet.</span>
        </div>
    @else
        <div class="row">
            <div class="col-md-4 offset-md-8">
                <form action="{{ route('blogs.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by title or tags">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($blogs as $blog)
            @include('blogs.deleteBlogModal')
            <div class="card mb-3 shadow p-3">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-8">
                        <h4 class="d-inline m-0">{{ ucwords($blog->title) }}</h4>

                        <p class="mt-1 mb-1 fw-semibold">Posted On : {{ $blog->created_at->format('d-m-y') }}</p>

                        @foreach ($blog->tags as $tags)
                            <span class="badge bg-primary fs-6">{{ ucwords($tags) }}</span>
                        @endforeach
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center gap-2">
                        <div>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn d-inline-block">
                                <i class="ri-eye-line" style="font-size: 28px; color:black"></i>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn d-inline-block">
                                <i style="font-size: 28px; color:black" class="bx bx-edit"></i>
                            </a>
                        </div>
                        <div>
                            <a href="#" class="btn d-inline-block open-modal" data-blog-id="{{ $blog->id }}"
                                data-bs-toggle="modal" data-bs-target="#deleteBlogModal">
                                <i class="bx bx-trash" style="font-size: 28px ; color:black"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create Blog</a>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $blogs->appends(request()->query())->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.open-modal').forEach(item => {
                item.addEventListener('click', event => {
                    const blogId = item.getAttribute('data-blog-id');
                    document.getElementById('blogIdInput').value = blogId;
                });
            });
        });
    </script>
@endsection
